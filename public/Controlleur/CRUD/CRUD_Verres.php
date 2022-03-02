<?php
session_start();

require_once "../MyPDO.php";
require_once "../connexion.php";
require_once "../../Modele/EntiteVerre.php";
include "../../Vue/verres.php";

//Initialisation de connexion
try {
    $myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'verre');
    //echo "CONNEXION!" ;
}catch (PDOException $e){
    echo "Il y a eu une erreur : " .$e->getMessage() ;
}


// Initialisation de notre vue
$vue = new  bar\vueVerres();

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

            $title = "Verre";
            $lienRetour = "../../";
            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            $contenu.= $vue->getHTMLALL($va);
            break;
        }

        case 'creat': {
            $title = "Ajouter un Verre";
            $lienRetour = 'CRUD_Verre.php?action=read';
            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            $contenu.= $vue->getHTMLInsert();
            $_SESSION['etat'] = 'creation';
            break;
        }

        case 'update': {
            $title = "ajouter un verre";
            $lienRetour = 'CRUD_Verres.php?action=read';
            $verre = $myPDO->get('v_id', $_GET['v_id']);
            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            $contenu .= $vue->getHTMLUpdate(array(
                'v_id'=>array('type'=>'text','default'=> $verre->getVId(), 'titre' => 'id'),
                'v_type'=>array('type'=>'text','default'=>$verre->getVType(), 'titre' => 'Type de Verre'),
            ));


            $_SESSION['etat'] = 'modification';
            break;
        }
        case 'delete': {
            $etat.="suppression";

            $idElem = array(
                "v_id" => $_GET['v_id']
            );

            $myPDO->delete($idElem);
            $_SESSION['etat'] = 'supprime';

            $myPDO->initPDOS_selectAll();
            $va =  $myPDO->getAll();
            $contenu="";
            $title = "Verres";
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
            if(isset($_GET['type'])) {
                $insert = array(
                    "v_id" => 'null',
                    "v_type" => $_GET['type']
                );

                $myPDO->insert($insert);
                $myPDO->initPDOS_selectAll();
                $va =  $myPDO->getAll();
                $contenu="";
                $title = "Verrre";
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
            $nbverre = $myPDO->getCountValue();

            $idElem = 'v_id';
            if(isset($_GET['v_id']) && isset($_GET['v_type'])) {
                $update = array(
                    "v_id" => $_GET['v_id'],
                    "v_type" => $_GET['v_type']
                );

                $myPDO->update($idElem, $update);

                $myPDO->initPDOS_selectAll();
                $va =  $myPDO->getAll();
                $contenu="";
                $title = "Verres";
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
            $title = "Verre";
            $lienRetour = "../../";
            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            $contenu.= $vue->getHTMLALL($va);
            break;

    }
echo $contenu;
require "../../getFinHtml.html";


?>
