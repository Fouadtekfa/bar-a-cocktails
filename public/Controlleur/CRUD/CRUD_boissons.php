<?php

require_once "../../imports.php";
require_once "../../Modele/EntiteBoisson.php";
include "../../Vue/boissons.php";

//Initialisation de connexion
try {
    $myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'Boisson');
    //echo "CONNEXION!" ;
}catch (PDOException $e){
    echo "Il y a eu une erreur : " .$e->getMessage() ;
}


// Initialisation de notre vue Boissons
$vue = new  bar\vueBoissons();

// Initialisation de chaines
$contenu = "";
$idElem = "";
$etat="";

if (isset($_GET['action']))
    switch ($_GET['action']) {
        case 'read': {
            $myPDO->initPDOS_selectAll();
            $va =  $myPDO->getAll();
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLTable($va);
            break;
        }

        case 'inserer': {
            $contenu.=$vue->getDebutHTML();
            $contenu.= $vue->getHTMLInsert();
            $_SESSION['etat'] = 'creation';
            break;
        }

        case 'modifier': {
            $boisson = $myPDO->get('b_id', $_GET['b_id']);
            $contenu.=$vue->getDebutHTML();


            $contenu .= $vue->getHTMLUpdate(array(
                'b_id'=>array('type'=>'text','default'=> $boisson->getBId(), 'titre' => 'id'),
                'b_nom'=>array('type'=>'text','default'=>$boisson->getBNom(), 'titre' => 'Nom de la boisson'),
                'b_type'=>array('type'=>'text','default'=>$boisson->getBType(), 'titre' => 'type de la boisson'),
                'b_estAlcoolise'=>array('type'=>'text','default'=>$boisson->getBEstAlcoolise(), 'titre' => 'Avec ou sans alcool'),
                'b_qteStockee'=>array('type'=>'text','default'=>$boisson->getBQteStockee(), 'titre' => 'quantité des boissons stockée'),

            ));

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
                    "b_id" => 'null',
                    "b_nom" => $_GET['nom'],
                    'b_type' =>$_GET['type'],
                    'b_estAlcoolise'=>$_GET['Avec ou sans alcool'],
                    'b_qteStockee'=>$_GET['Quantité']

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

            $idElem = 'b_id';
            if(isset($_GET['b_id']) && isset($_GET['b_nom']) && isset($_GET['b_type']) && isset($_GET['b_estAlcoolise']) && isset($_GET['b_qteStockee'])) {
                $update = array(
                    "b_id" => $_GET['b_id'],
                    "b_nom" => $_GET['b_nom'],
                    'b_type' =>$_GET['b_type'],
                    'b_estAlcoolise'=>$_GET['b_estAlcoolise'],
                    'b_qteStockee'=>$_GET['b_qteStockee']
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
                "b_id" => $_GET['b_id']
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
