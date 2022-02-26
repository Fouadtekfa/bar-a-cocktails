<?php
session_start();

require_once "../MyPDO.php";
require_once "../connexion.php";
require_once "../../Modele/EntiteEtape.php";
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
//echo $_GET['c_id'];
if (isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'read': {
            //echo 'je';
            //$myPDO->initPDOS_selectAll();
            //$va =  $myPDO->getAll();
            //echo 'hhhh';
            //echo  $_GET['c_id'];
            //echo 'id ' .  $_GET['c_id'];
            //echo 'holiq';
            $va = $myPDO->getById('c_id', $_GET['c_id']);
            //echo 'hhh';
            $va =  $myPDO->getAllById('c_id', $_GET['c_id']);

            $va =  $myPDO->getSpecific('c_id', $_GET['c_id']);
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLTable($va);
            break;
        }





    }
}

echo $contenu;
require "../../getFinHtml.html";


?>