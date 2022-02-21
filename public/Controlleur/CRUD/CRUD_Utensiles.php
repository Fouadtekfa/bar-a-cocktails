<?php 
require_once "../../imports.php";
require_once "../../Modele/EntiteUtensile.php";
include "../../Vue/utensiles.php";

//Initialisation de connexion
try {
    $myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'Utensile');
    //echo "CONNEXION!" ;
}catch (PDOException $e){
    echo "Il y a eu une erreur : " .$e->getMessage() ;
}


// Initialisation de notre vue Utensiles
$vue = new  bar\vueUtensiles();

// Initialisation de chaines
$contenu = "";
$idElem = "";
$etat="";

if (isset($_GET['action'])) 
    switch ($_GET['action']) {
        case 'viewUtensile': {
            $myPDO->initPDOS_selectAll();
            $va =  $myPDO->getAll();
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLTable($va);
            break;        
        }

        case 'insererUtensile': {
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLInsert();
            $_SESSION['etat'] = 'creation';
            break;        
        }

        case 'modifierUtensile': {
            $utensile = $myPDO->get('u_id', $_GET['u_id']);
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLUpdate($utensile);
            $_SESSION['etat'] = 'modification';
            break;        
        }
        case 'suppression': {
            $_SESSION['etat'] = 'supprimer';
            break;        
        }
} 

if (isset($_SESSION['etat']))
        switch ($_SESSION['etat']) {
            case 'creation': {
                $etat.="creation";
                $insert = "";
                if(isset($_GET['nom'])) {
                    $insert = array(
                        "u_id" => 'null',
                        "u_nom" => $_GET['nom']
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
                
                $_SESSION['etat'] = 'créé';
                break;
            }

            case 'modification': {
                $etat.="modification";
                $nbUtensiles = $myPDO->getCountValue();
                
                $idElem = 'u_id';
                if(isset($_GET['u_id']) && isset($_GET['u_nom'])) {
                    $update = array(
                        "u_id" => $_GET['u_id'],
                        "u_nom" => $_GET['u_nom']
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
                $etat.="modification";
                
                $idElem = array(
                    "u_id" => $_GET['u_id']
                );
                $myPDO->delete($idElem);
                $_SESSION['etat'] = 'supprime';
                
                $myPDO->initPDOS_selectAll();
                $va =  $myPDO->getAll();
                $contenu="";
                $contenu.=$vue->getDebutHTML();
                $contenu.= $vue->getHTMLTable($va);
                $_SESSION['etat'] = 'supprime';

                break;
            }
            case 'créé': 
                        break;

    }
echo $contenu;
require "../../getFinHtml.html";
    

?>
