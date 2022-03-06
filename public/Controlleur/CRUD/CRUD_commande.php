<?php
session_start();
require_once "../MyPDO.php";
require_once "../connexion.php";
require_once "../../Modele/EntiteCommande.php";
require_once "../../Modele/EntiteLienCocktailCommande.php";
require_once "../../Modele/EntiteCocktail.php";
include "../../Vue/commandes.php";

//Initialisation de connexion
try {
    $myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'Commande');
    $myPDO_Change = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd']);
    //echo "CONNEXION!" ;
}catch (PDOException $e){
    echo "Il y a eu une erreur : " .$e->getMessage() ;
}


// Initialisation de notre vue Commande
$vue = new  bar\vueCommandes();

// Initialisation de chaines
$contenu = "";
$idElem = "";
$etat="";

if(!isset($_SESSION['etat']) && !isset($_GET['action'])) {
    $_GET['action'] = 'read';
}

if (isset($_GET['action']))
    switch ($_GET['action']) {
        case 'read':
        {
            $myPDO->initPDOS_selectAll();
            $va = $myPDO->getAll();
            $contenu .= $vue->getDebutHTML();
            $contenu .= $vue->getHTMLTable($va);
            break;
        }

        case 'create':
        {
            $title = "Ajouter une commande";
            $lienRetour = 'CRUD_commande.php?action=read';

            // == INGREDIENT CONTENU ==
            $myPDO_Change->setNomTable('cocktail');
            $myPDO_Change->initPDOS_selectAll();
            $cocktails =  $myPDO_Change->getAll();
            // ===================


            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            $contenu .= $vue->getHTMLInsert($cocktails);
            $_SESSION['etat'] = 'creation';
            break;
        }
        case 'update':
        {

            $commande = $myPDO->get('com_id', $_GET['com_id']);
            $title = "Modifier la commande de la table numero ".$commande->getComNumTable();
            $lienRetour = 'CRUD_commande.php?action=read';
            $contenu.=$vue->getDebutHTML($title, $lienRetour);

            // == COMMANDE CONTENU ==
                $myPDO_Change->setNomTable('liencocktailcommande');
                $cocktails =  $myPDO_Change->getAllCocktailsWithRelationCommandes($commande->getComId());
            // ===================

            $commande = array(
                'com_id' => array( 'type' => 'text', 'default' => $commande->getComId(), 'titre' => 'id'),
                'com_numTable' => array( 'type' => 'number', 'default' => $commande->getComNumTable(), 'titre' => 'Numero table')
            );

            $contenu .= $vue->getHTMLUpdate($commande, $cocktails);

            $_SESSION['etat'] = 'modification';
            break;
        }
        case 'delete':
        {
            $etat.="suppression";
            $idElem = array(
                "com_id" => $_GET['com_id']
            );
            $myPDO->delete($idElem);

            $myPDO->initPDOS_selectAll();
            $va =  $myPDO->getAll();
            $contenu="";
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLTable($va);
            $_SESSION['etat'] = 'supprimer';
            break;
        }
        case 'plus':{
                $commande = $myPDO->get('com_id', $_GET['com_id']);
                $titre = "la coomande de la table num " . $commande->getComNumTable();;
                $lienRetour = 'CRUD_commande.php?action=read';
                $contenu .= $vue->getDebutHTML($titre, $lienRetour);


                // == COMMANDES CONTENU ==
                $myPDO_Change->setNomTable('liencocktailcommande');
                $lienCockBoisson =  $myPDO_Change->getCocktailForOneCommande($_GET['com_id']);
                // ===================

                $contenu.=$vue->getHTMLDetails($lienCockBoisson);
                break;
        }

    }
else if (isset($_SESSION['etat']))
    switch ($_SESSION['etat']) {
        case 'creation': {
            $etat.="creation";
            $insert = "";


            if(isset($_POST['com_numTable'])) {
                $insert = array(

                    "com_id" => 'null',
                    "com_numTable" => $_POST['com_numTable']


                );

                $myPDO->insert($insert);
                $idMaxCommande = $myPDO->getIdMax('com_id'); // dernier element insere

                // === AJOUT INGREDIENTS ======
                    // Etablir la table de cocktail liaison ingredients
                    $myPDO_Change->setNomTable('liencocktailcommande');

                    if(isset($_POST['checkCocktailsId']) && isset($_POST['checkCocktails'])) {

                        $cockIDs = $_POST['checkCocktailsId'];
                        $cocktailsquantity = $_POST['checkCocktails'];
                        foreach($cockIDs as $key => $val) {
                            if($cocktailsquantity[$key] > 0){
                                $insert = array(
                                    "c_id" => $val,
                                    "com_id" => $idMaxCommande,
                                    "nbCocktail" => $cocktailsquantity[$key]
                                );
                                $myPDO_Change->insert($insert);
                            }
                        }

                    }
                // ======================



                $myPDO->initPDOS_selectAll();
                $va =  $myPDO->getAll();
                $contenu="";
                $contenu.=$vue->getDebutHTML();
                $contenu.= $vue->getHTMLTable($va);
            } else {
                $_SESSION['Action'] = 'read' ;
            }

            $_SESSION['etat'] = 'créé';
            break;
        }

        case 'modification': {
            $etat.="modification";

            // === AJOUT / SUPPRESSION DES COCKTAILS ======
                $myPDO_Change->setNomTable('liencocktailcommande');

                if(isset($_GET['checkCocktailsId']) && isset($_GET['checkCocktails'])) {

                    $cocktailsIDs = $_GET['checkCocktailsId'];
                    $cocktailsQuantity = $_GET['checkCocktails'];

                    foreach($cocktailsIDs as $key => $val) {
                        $liaisonExists = $myPDO_Change->element2KeysExists('com_id', 'c_id', $_GET['com_id'], $val);
                        if($cocktailsQuantity[$key] > 0){
                            $data = array(
                                "c_id" => $val,
                                "com_id" => $_GET['com_id'],
                                "nbCocktail" => $cocktailsQuantity[$key]
                            );
                            
                            if($liaisonExists > 0) {
                                $myPDO_Change->updateRelation('com_id', 'c_id', $data);
                            } else {
                                $myPDO_Change->insert($data);
                            }

                        } else {
                            if($liaisonExists > 0) {
                                $data = array(
                                    "c_id" => $val,
                                    "com_id" => $_GET['com_id']
                                );
                                $myPDO_Change->delete($data);
                            }
                        }
                    }
                }
            // ======================

            $idElem = 'com_id';
            if(isset($_GET['com_id']) && isset($_GET['com_numTable']) ) {
                $update = array(
                    "com_id" => $_GET['com_id'],
                    "com_numTable" => $_GET['com_numTable']


                );

                $myPDO->update($idElem, $update);

                $myPDO->initPDOS_selectAll();
                $va =  $myPDO->getAll();
                $contenu="";
                $contenu.=$vue->getDebutHTML();
                $contenu.= $vue->getHTMLTable($va);
            }

            $_SESSION['etat'] = 'modifie';
            break;
        }

        case 'supprimer': {
            $_SESSION['etat'] = 'supprime';
            break;
        }
        case 'créé':
        case 'modifie' :
        case 'supprime' :
            $myPDO->initPDOS_selectAll();
            $va =  $myPDO->getAll();
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLTable($va);
            break;

    }
echo $contenu;
require "../../getFinHtml.html";


?>
