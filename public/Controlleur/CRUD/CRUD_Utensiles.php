<?php 
require_once "../../imports.php";
require_once "../../Modele/EntiteUtensile.php";
include "../../Vue/utensiles.php";

//Initialisation de connexion
try {
    $myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'Utensile');
    echo "CONNEXION!" ;
}catch (PDOException $e){
    echo "Il y a eu une erreur : " .$e->getMessage() ;
}


// Initialisation de notre vue Utensiles
$vue = new  bar\vueUtensiles();

//$myPDO->initPDOS_selectAll();
//$va =  $myPDO->getAll();

// Initialisation de chaines
$contenu = "";
$idElem = "";
$etat="";

if (isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'viewUtensile': {
            $myPDO->initPDOS_selectAll();
            $va =  $myPDO->getAll();
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLTable($va);
            break;        
        }

        case 'insererUtensile': {
            $nbUtensiles = $myPDO->getCountValue();

            $contenu = array(
                "u_id" => 'null',
                "u_nom" => $_GET['nom']
            );
            
            $_SESSION['etat'] = 'creation';
            break;        
        }

        case 'modifierUtensile': {
            $nbUtensiles = $myPDO->getCountValue();
            $idElem = 'u_id';
            $contenu = array(
                "u_id" => $_GET['u_id'],
                "u_nom" => $_GET['u_nom']
            );
            $_SESSION['etat'] = 'modification';
            break;        
        }
        case 'suppression': {
            $idElem = array(
                "u_id" => $_GET['u_id']
            );
            
            $_SESSION['etat'] = 'supprimer';
            break;        
        }
    }
} 

if (isset($_SESSION['etat'])) {
    switch ($_SESSION['etat']) {
        case 'creation': {
            $etat.="creation";
            $myPDO->insert($contenu);
            $_SESSION['etat'] = 'créé';
            ?> <script>  document.location.href = '../../Vue/utensiles.php';  </script> <?php
            break;
        }

        case 'modification': {
            $etat.="modification";
            $myPDO->update($idElem, $contenu);
            $_SESSION['etat'] = 'modifie';
            ?> <script>  document.location.href = '../../Vue/utensiles.php';  </script> <?php
            break;
        }

        case 'supprimer': {
            $etat.="modification";
            $myPDO->delete($idElem);
            $_SESSION['etat'] = 'supprime';
            ?> <script>  document.location.href = '../../../Vue/utensiles.php';  </script> <?php
            break;
        }

    }
}

echo $contenu;
require "../../getFinHtml.html";
    

?>
