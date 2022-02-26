<?php
session_start();
require_once "../MyPDO.php";
require_once "../connexion.php";
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

if(!isset($_SESSION['etat']) && !isset($_GET['action'])) {
    $_GET['action'] = 'read';

}

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
        case 'create': {

            //insererCocktail
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLInsert();
            $_SESSION['etat'] = 'creation';



            break;
        }
        case 'update':

            $cocktail = $myPDO->get('c_id', $_GET['c_id']);
            $contenu.=$vue->getDebutHTML();
            $contenu.=$vue->getHTMLUpdate(array(
                'c_id'=>array('balise'=>'input', 'type'=>'text','default'=> $cocktail->getCId(), 'titre' => 'id'),
                'c_nom'=>array('balise'=>'input', 'type'=>'text','default'=>$cocktail->getCNom(), 'titre' => 'Nom de cocktail'),
                "c_cat"=>array('balise'=>'select', 'type'=>'text','default'=>$cocktail->getCCat(), 'titre' => 'cat'),
                "c_prix"=>array('balise'=>'input', 'type'=>'int','default'=>$cocktail->getCPrix(), 'titre' => 'prix'),
            ));
            $_SESSION['etat'] = 'modification';

            break;



        case 'delete': {
            $etat.="modification";
            $idElem = array(
                "c_id" => $_GET['c_id']
            );
            $myPDO->delete($idElem);
            $_SESSION['etat'] = 'supprime';

            $myPDO->initPDOS_selectAll();
            $va =  $myPDO->getAll();
            $contenu="";
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLAll($va);
            $_SESSION['etat'] = 'supprimer';
            break;
        }
    }
}else if (isset($_SESSION['etat'])) {
    switch ($_SESSION['etat']) {
        case 'creation':
            $etat .= "creation";

            if (isset($_GET['nom']) && isset($_GET['cat']) && isset($_GET['prix'])) {
                $insert = array(
                    "c_id" => "null",
                    "c_nom" => $_GET['nom'],
                    "c_cat" => $_GET['cat'],
                    "c_prix" => $_GET['prix']
                );
                $myPDO->insert($insert);
                $myPDO->initPDOS_selectAll();
                $va = $myPDO->getAll();
                $contenu = '';
                $contenu .= $vue->getDebutHTML();
                $contenu .= $vue->getHTMLAll($va);

            }

            $_SESSION['etat'] = 'créé';

            break;
        case 'modification':
        {
            $etat .= "modification";
            $idElem = 'c_id';
            //echo $_GET['c_nom'];
            if (isset( $_GET['c_id']) && isset($_GET['c_nom']) && isset($_GET['c_cat']) && isset($_GET['c_prix'])) {

                $update = array(
                    "c_id" => $_GET['c_id'],
                    "c_nom" => $_GET['c_nom'],
                    "c_cat" => $_GET['c_cat'],
                    "c_prix" => $_GET['c_prix']

                );

                $myPDO->update($idElem, $update);

                $myPDO->initPDOS_selectAll();
                $va = $myPDO->getAll();
                $contenu = "";
                $contenu .= $vue->getDebutHTML();
                $contenu .= $vue->getHTMLAll($va);
            }

            $_SESSION['etat'] = 'modifie';
            break;
        }
        case 'supprimer':{
            $_SESSION['etat'] = 'supprime';

            break;
        }
        case 'créé':
        case 'modifie' :
        case 'supprime' :
            $myPDO->initPDOS_selectAll();
            $va = $myPDO->getAll();
            $contenu .= $vue->getDebutHTML();
            $contenu .= $vue->getHTMLAll($va);
            break;
    }
}

echo $contenu;
require "../../getFinHtml.html";

?>

