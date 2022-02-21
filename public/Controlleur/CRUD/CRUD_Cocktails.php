<?php

require_once "../../imports.php";
require_once "../../Modele/EntiteCocktail.php";
include "../../Vue/cocktails.php";


try {
    $myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'cocktail');
    //echo "CONNEXION!" ;
}catch (PDOException $e){
    echo "Il y a eu une erreur : " .$e->getMessage() ;
}
// Initialisation de notre vue Cocktail
$vue = new  bar\VueCocktail();

// Initialisation de chaines
$contenu = "";
$idElem = "";
$etat="";
if (isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'read': {
            $myPDO->initPDOS_selectAll();
            $va =  $myPDO->getAll();
            /*
            foreach ($va as $var){
                echo $var->getCNom();
            }
            */
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLAll($va);
            break;
        }
        case 'insererCocktail': {
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLInsert();
            $_SESSION['etat'] = 'creation';



            break;
        }
        case 'modifierUtensile': {
            $nbUtensiles = $myPDO->getCountValue();
            $contenu = array(
                "u_id" => $_GET['nom'],
                "u_nom" => $_GET['nom']
            );

            $_SESSION['etat'] = 'modification';
            break;
        }
    }
}

if (isset($_SESSION['etat'])) {
    switch ($_SESSION['etat']) {
        case 'creation':
            $etat.="creation";

            if(isset($_GET['nom'])&&isset($_GET['cat'])&&isset($_GET['prix'])){
                $insert = array(
                    "c_id" => "null",
                    "c_nom" => $_GET['nom'],
                    "c_cat"=>$_GET['cat'],
                    "c_prix"=>$_GET['prix']
                );
                $myPDO->insert($insert);
                $myPDO->initPDOS_selectAll();
                $va =  $myPDO->getAll();
                $contenu='';
                $contenu.=$vue->getDebutHTML();
                $contenu.= $vue->getHTMLAll($va);

            }

            $_SESSION['etat'] = 'créé';

            break;

    }
}
echo $contenu;
require "../../getFinHtml.html";

?>

