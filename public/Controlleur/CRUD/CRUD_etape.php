<?php
session_start();

require_once "../MyPDO.php";
require_once "../connexion.php";
require_once "../../Modele/EntiteEtape.php";
require_once "../../Modele/EntiteCocktail.php";
include "../../Vue/etapes.php";

//Initialisation de connexion
try {
    $myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'etape');
    //echo "CONNEXION!" ;
}catch (PDOException $e){
    echo "Il y a eu une erreur : " .$e->getMessage() ;
}


// Initialisation de notre vue Utensiles
$vue = new  bar\vueEtapes();

// Initialisation de chaines
$contenu = "";
$idElem = "";
$etat="";

if(!isset($_SESSION['etat']) && !isset($_GET['action'])) {
    $_GET['action'] = 'read';
}

//echo $_SESSION['etat'];
if (isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'read': {
            $va =  $myPDO->getSpecific('c_id', $_GET['c_id']);
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLTable($va);
            break;
        }
        case 'create':
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLInsert();
            $_SESSION['etat'] = 'creation';
            break;

    }
}else if (isset($_SESSION['etat'])){
    
        switch ($_SESSION['etat']) {
            case 'creation': {
                /*$etat.="creation";
                $insert = "";
                $max=$myPDO->initPDOS_max($e_num);
                echo $max;
                $max++;*/
            
                if(isset($_GET['e_desc'])) {
                    /*$insert = array(
                        "c_id"=>"null",
                        "e_num" =>$max,
                        "e_desc" => $_GET['e_desc']
                    );
            
                    $myPDO->insert($insert);
                    $va =  $myPDO->getSpecific('c_id', $_GET['c_id']);
                    $contenu="";
                    $contenu.=$vue->getDebutHTML();
                    $contenu.= $vue->getHTMLTable($va)*/;
                } else {
                    $_SESSION['Action'] = 'read' ;
                }
                $_SESSION['etat'] = 'créé';

                break;
            }
            
            case 'créé':
                    $va =$myPDO->getSpecific('c_id', $_GET['c_id']);
                    $contenu="";
                    $contenu.=$vue->getDebutHTML();
                    $contenu.= $vue->getHTMLTable($va);
                    break;
        }
}





echo $contenu;
require "../../getFinHtml.html";


?>