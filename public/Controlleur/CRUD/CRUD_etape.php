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
    $myPDO_Change = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd']);
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
        
        case 'create': {
                // Obtenir le cocktail de l'etape
                $myPDO_Change->setNomTable('cocktail');
                $cocktail = $myPDO_Change->get('c_id', $_GET['c_id']);
                $titre = "Ajout d'une etape pour " . $cocktail->getCNom(); 
                
                $lienRetour = 'CRUD_etape.php?action=read&c_id='.$_GET['c_id'];
                
                $contenu.=$vue->getDebutHTML($titre, $lienRetour);
                $contenu.= $vue->getHTMLInsert($cocktail);
                $_SESSION['etat'] = 'creation';
            break;
        }

        case 'update': {
            $etape = $myPDO->getElement2Keys('c_id', 'e_num', $_GET['c_id'], $_GET['e_num']);
            

            // Obtenir le cocktail de l'etape
            $myPDO_Change->setNomTable('cocktail');
            $cocktail = $myPDO_Change->get('c_id', $_GET['c_id']);

            $titre = "Modifier une etape pour " . $cocktail->getCNom(); 
            
            $lienRetour = 'CRUD_etape.php?action=read&c_id='.$_GET['c_id'];
            
            $contenu.=$vue->getDebutHTML($titre, $lienRetour);

            $etapeArray = array(
                'c_id'=>array('type'=>'text','default'=> $etape->getCId(), 'titre' => 'id cocktail'),
                'e_num'=>array('type'=>'text','default'=> $etape->getENum(), 'titre' => 'id etape'),
                'e_desc'=>array('type'=>'text','default'=>$etape->getEDesc(), 'titre' => 'Nom de l utensile'),
            );
            $contenu .= $vue->getHTMLUpdate($etapeArray);

            
            $_SESSION['etat'] = 'modification';

             break;
        }
        
        case 'suppression' : {
            $etat.="suppression";
                
            $idElem = array(
                    "c_id" => $_GET['c_id'],
                    "e_num" => $_GET['e_num']
                );
            
            $myPDO->delete($idElem);

        }

        default: {
            $etapesForCocktail =  $myPDO->getSpecific('c_id', $_GET['c_id']);
            $myPDO_Change->setNomTable('cocktail');
            $cocktail = $myPDO_Change->get('c_id', $_GET['c_id']);
            $titre = "ETAPES DU " . $cocktail->getCNom();
            $lienRetour = "CRUD_Cocktails.php?action=read";
            $contenu.=$vue->getDebutHTML($titre, $lienRetour);
            $contenu.= $vue->getHTMLTable($etapesForCocktail);
            break;
        }

    }
} else if (isset($_SESSION['etat'])){
        switch ($_SESSION['etat']) {
            case 'creation': {
                $etat.="creation";
                
                $insert = "";
                $max = $myPDO->getIdMaxENumFromCocktail('e_num', $_POST['c_id']);
                $max++;
                if(isset($_POST['e_desc'])) {
                    $insert = array(
                        "c_id"=>  $_POST['c_id'],
                        "e_num" => $max,
                        "e_desc" => $_POST['e_desc']
                    );
                    
                    $myPDO->insert($insert);
                    
                    $myPDO_Change->setNomTable('cocktail');
                } else {
                    $_SESSION['Action'] = 'read' ;
                }
                 
                 //$_SESSION['etat'] = 'créé';
                 
                 // Vue finale
                 $myPDO_Change->setNomTable('cocktail');
                 $cocktail = $myPDO_Change->get('c_id', $_POST['c_id']);
                 $titre = "Ajout d'une etape pour " . $cocktail->getCNom(); 
                 $lienRetour = 'CRUD_etape.php?action=read&c_id='.$_POST['c_id'];
                 $contenu=$vue->getDebutHTML($titre, $lienRetour);
                 $msg = "Etape ajouté";
                 $contenu.= $vue->getHTMLInsert($cocktail, $msg);
                 $_SESSION['etat'] = 'creation';
                break;
            }

            case 'modification' : { 
                
                $etat.="modification";
                if(isset($_POST['c_id']) && isset($_POST['e_num']) && isset($_POST['e_desc'])) {
                    
                    $update = array(
                        "c_id" => $_POST['c_id'],
                        "e_num" => $_POST['e_num'],
                        "e_desc" => $_POST['e_desc']
                    );

                    $myPDO->updateRelation('c_id', 'e_num',  $update);
                    
                    
                }
                //$_SESSION['etat'] = 'modifie';
            

                // Vue finale                
                $etape = $myPDO->getElement2Keys('c_id', 'e_num', $_GET['c_id'], $_GET['e_num']);
                $myPDO_Change->setNomTable('cocktail');
                $cocktail = $myPDO_Change->get('c_id', $_GET['c_id']);
                $titre = "Modifier une etape pour " . $cocktail->getCNom(); 
                $lienRetour = 'CRUD_etape.php?action=read&c_id='.$_GET['c_id'];
                $contenu.=$vue->getDebutHTML($titre, $lienRetour);
                
                $etapeArray = array(
                    'c_id'=>array('type'=>'text','default'=> $etape->getCId(), 'titre' => 'id cocktail'),
                    'e_num'=>array('type'=>'text','default'=> $etape->getENum(), 'titre' => 'id etape'),
                    'e_desc'=>array('type'=>'text','default'=>$etape->getEDesc(), 'titre' => 'Nom de l utensile'),
                );
                $msg = "Etape modifié";
                $contenu .= $vue->getHTMLUpdate($etapeArray, $msg);
            }
            
        }
}

echo $contenu;
require "../../getFinHtml.html";


?>