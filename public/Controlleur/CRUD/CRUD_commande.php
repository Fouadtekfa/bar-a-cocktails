<?php
session_start();
require_once "../MyPDO.php";
require_once "../connexion.php";
require_once "../../Modele/EntiteCommande.php";
include "../../Vue/commandes.php";

//Initialisation de connexion
try {
    $myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'Commande');
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

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'read':
        {
            $myPDO->initPDOS_selectAll();
            $va = $myPDO->getAll();
            $contenu .= $vue->getDebutHTML();
            $contenu .= $vue->getHTMLTable($va);
            break;
        }

        case 'inserer':
        {
            $contenu .= $vue->getDebutHTML();
            $contenu .= $vue->getHTMLInsert();
            $_SESSION['etat'] = 'creation';
            break;
        }
        case 'modifier':
        {
            $commande = $myPDO->get('com_id', $_GET['com_id']);
            $contenu .= $vue->getDebutHTML();
            $contenu .= $vue->getHTMLUpdate(array(
                'com_id' => array('balise'=>'input', 'type' => 'text', 'default' => $commande->getComId(), 'titre' => 'id'),
                'com_numTable' => array('balise'=>'input', 'type' => 'text', 'default' => $commande->getComNumTable(), 'titre' => 'Numero table'),


            ));

            $_SESSION['etat'] = 'modification';
            break;
        }
        case 'suppression':
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

    }
} else if (isset($_SESSION['etat']))
    switch ($_SESSION['etat']) {
        case 'creation': {
            $etat.="creation";
            $insert = "";


            if(isset($_GET['com_numTable'])) {
                $insert = array(
                    "com_id" => 'null',
                    "com_numTable" => $_GET['com_numTable']


                );

                $myPDO->insert($insert);
                $myPDO->initPDOS_selectAll();
                $va =  $myPDO->getAll();
                $contenu="";
                $contenu.=$vue->getDebutHTML();
                $contenu.= $vue->getHTMLTable($va);
            } else {
                $_SESSION['Action'] = 'read' ;
            }

            $_SESSION['etat'] = 'cree';
            break;
        }

        case 'modification': {
            $etat.="modification";
            $nbCommande = $myPDO->getCountValue();

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
        case 'cree':
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
