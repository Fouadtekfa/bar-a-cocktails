<?php
session_start();

require_once "../MyPDO.php";
require_once "../connexion.php";
require_once "../../Modele/EntiteIngredient.php";
include "../../Vue/ingredients.php";

//Initialisation de connexion
try {
    $myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'ingredient');
    //echo "CONNEXION!" ;
}catch (PDOException $e){
    echo "Il y a eu une erreur : " .$e->getMessage() ;
}


// Initialisation
$vue = new  bar\vueInegredients();

// Initialisation de chaines
$contenu = "";
$idElem = "";
$etat="";

if(!isset($_SESSION['etat']) && !isset($_GET['action'])) {
    $_GET['action'] = 'read';
}

if (isset($_GET['action']))
    switch ($_GET['action']) {
        case 'read': {
            $myPDO->initPDOS_selectAll();
            $va =  $myPDO->getAll();

            $title = "Ingredient";
            $lienRetour = "../../";
            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            $contenu.= $vue->getHTMLALL($va);
            break;
        }

        case 'creat': {
            $title = "Ajouter un ingredient";
            $lienRetour = 'CRUD_Ingredient.php?action=read';
            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            $contenu.= $vue->getHTMLInsert();
            $_SESSION['etat'] = 'creation';
            break;
        }

        case 'update': {
            $ingredient = $myPDO->get('i_id', $_GET['i_id']);
            $titre = "Modifier l'ingredient ".$ingredient->getINom();
            $lienRetour = 'CRUD_Ingredient.php?action=read';
            $contenu.=$vue->getDebutHTML($titre, $lienRetour);
            $contenu .= $vue->getHTMLUpdate(array(
                'i_id'=>array('type'=>'text','default'=> $ingredient->getIId(), 'titre' => 'id'),
                'i_nom'=>array('type'=>'text','default'=>$ingredient->getINom(), 'titre' => 'Nom '),
                'i_type'=>array('type'=>'text','default'=>$ingredient->getIType(), 'titre' => 'Type'),
                'i_qteStockee'=>array('type'=>'number','default'=>$ingredient->getIQteStockee(), 'titre' => 'Quantite'),
                'i_uniteStockee'=>array('type'=>'text','default'=>$ingredient->getIUniteStockee(), 'titre' => 'Unite'),
            ));


            $_SESSION['etat'] = 'modification';
            break;
        }
        case 'delete': {
            $etat.="suppression";

            $idElem = array(
                "i_id" => $_GET['i_id']
            );

            $myPDO->delete($idElem);
            $_SESSION['etat'] = 'supprime';

            $myPDO->initPDOS_selectAll();
            $va =  $myPDO->getAll();
            $contenu="";
            $title = "Ingredient";
            $lienRetour = "../../";
            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            $contenu.= $vue->getHTMLALL($va);
            $_SESSION['etat'] = 'supprimer';
            break;
        }
    } else if (isset($_SESSION['etat']))
    switch ($_SESSION['etat']) {
        case 'creation': {
            $etat.="creation";
            $insert = "";

            if (isset($_POST['nom']) && isset($_POST['type']) && isset($_POST['Quantite']) && isset($_POST['unite'])) {
                $insert = array(
                    "i_id" => "null",
                    "i_nom" => $_POST['nom'],
                    "i_type" => $_POST['type'],
                    "i_qteStockee" => $_POST['Quantite'],
                    "i_uniteStockee" => $_POST['unite']
                );

                $myPDO->insert($insert);
                $myPDO->initPDOS_selectAll();
                $va =  $myPDO->getAll();
                $contenu="";
                $title = "Ingredient";
                $lienRetour = "../../";
                $contenu.=$vue->getDebutHTML($title, $lienRetour);
                $contenu.= $vue->getHTMLALL($va);
            } else {
                $_SESSION['Action'] = 'read' ;
            }

            $_SESSION['etat'] = 'créé';
            break;
        }

        case 'modification': {
            $etat.="modification";
            $countingredient = $myPDO->getCountValue();

            $idElem = 'i_id';
            if(isset($_GET['i_id'])&&isset($_GET['i_nom']) && isset($_GET['i_type']) && isset($_GET['i_qteStockee']) && isset($_GET['i_uniteStockee'])) {
                $update = array(
                    "i_id"=>$_GET['i_id'],
                    "i_nom" => $_GET['i_nom'],
                    "i_type" => $_GET['i_type'],
                    "i_qteStockee" => $_GET['i_qteStockee'],
                    "i_uniteStockee" => $_GET['i_uniteStockee']
                );

                $myPDO->update($idElem, $update);

                $myPDO->initPDOS_selectAll();
                $va =  $myPDO->getAll();
                $contenu="";
                $title = "Ingredient";
                $lienRetour = "../../";
                $contenu.=$vue->getDebutHTML($title, $lienRetour);
                $contenu.= $vue->getHTMLALL($va);
            }

            $_SESSION['etat'] = 'modifie';

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
            $title = "Ingredient";
            $lienRetour = "../../";
            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            $contenu.= $vue->getHTMLALL($va);
            break;

    }
echo $contenu;
require "../../getFinHtml.html";


?>
