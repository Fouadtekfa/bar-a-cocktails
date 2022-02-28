<?php
session_start();
require_once "../MyPDO.php";
require_once "../connexion.php";
require_once "../../Modele/EntiteCocktail.php";
require_once "../../Modele/EntiteBoisson.php";
require_once "../../Modele/EntiteLienCocktailBoisson.php";
require_once "../../Modele/EntiteUstensile.php";
require_once "../../Modele/EntiteLienCocktailUstensile.php";
include "../../Vue/cocktails.php";



try {
    $myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'cocktail');
    $myPDO_Change = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd']);
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
            $title = "Cocktails";
            $lienRetour = "../../";
            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            $contenu.= $vue->getHTMLAll($va);
            break;
        }
        case 'create': {
            $title = "Ajout un Cocktail";
            $lienRetour = 'CRUD_Cocktails.php?action=read';
            $contenu.=$vue->getDebutHTML($title, $lienRetour);
            
            
            // == BOISSON CONTENU ==
               $myPDO_Change->setNomTable('boisson');
                $myPDO_Change->initPDOS_selectAll();
                $boissons =  $myPDO_Change->getAll();
            // ===================
            
            // == USTENSILE CONTENU ==
               $myPDO_Change->setNomTable('ustensile');
                $myPDO_Change->initPDOS_selectAll();
                $ustensiles =  $myPDO_Change->getAll();
            // ===================


            $contenu.= $vue->getHTMLInsert($boissons, $ustensiles);
            $_SESSION['etat'] = 'creation';
            break;
        }
        case 'update':

            $cocktail = $myPDO->get('c_id', $_GET['c_id']);
            $title = "Modifier ". $cocktail->getCNom();
            $lienRetour = 'CRUD_Cocktails.php?action=read';
            $contenu.=$vue->getDebutHTML($title, $lienRetour);

            // == BOISSON CONTENU ==
            $myPDO_Change->setNomTable('boisson');
            $myPDO_Change->initPDOS_selectAll();
            $boissons =  $myPDO_Change->getAll();
            $myPDO_Change->setNomTable('liencocktailboisson');
            $lienCockBoisson =  $myPDO_Change->getSpecific('c_id', $_GET['c_id']);

            // ===================

            $contenu.=$vue->getHTMLUpdate(array(
                'c_id'=>array('balise'=>'input', 'type'=>'text','default'=> $cocktail->getCId(), 'titre' => 'id'),
                'c_nom'=>array('balise'=>'input', 'type'=>'text','default'=>$cocktail->getCNom(), 'titre' => 'Nom de cocktail'),
                "c_cat"=>array('balise'=>'select', 'type'=>'text','default'=>$cocktail->getCCat(), 'titre' => 'cat'),
                "c_prix"=>array('balise'=>'input', 'type'=>'int','default'=>$cocktail->getCPrix(), 'titre' => 'prix'),
            ), $boissons, $lienCockBoisson);
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
        case 'details': {

            $cocktail = $myPDO->get('c_id', $_GET['c_id']);
            $contenu.=$vue->getDebutHTML();

            // == BOISSON CONTENU ==
            $myPDO_Change->setNomTable('liencocktailboisson');
            $lienCockBoisson =  $myPDO_Change->getBoissonsForOneCocktail( $_GET['c_id']);
            // ===================
            
            // == USTENSILES CONTENU ==
            $myPDO_Change->setNomTable('liencocktailustensile');
            $lienCockUstensiles =  $myPDO_Change->getUstensilesForOneCocktail( $_GET['c_id']);            
            // ===================

            $contenu.=$vue->getHTMLDetails(array(
                'c_id'=>array('balise'=>'input', 'type'=>'text','default'=> $cocktail->getCId(), 'titre' => 'id'),
                'c_nom'=>array('balise'=>'input', 'type'=>'text','default'=>$cocktail->getCNom(), 'titre' => 'Nom de cocktail'),
                "c_cat"=>array('balise'=>'select', 'type'=>'text','default'=>$cocktail->getCCat(), 'titre' => 'cat'),
                "c_prix"=>array('balise'=>'input', 'type'=>'int','default'=>$cocktail->getCPrix(), 'titre' => 'prix'),
            ), $lienCockBoisson, $lienCockUstensiles);
            $_SESSION['etat'] = 'modification';

            break;
        }
        
    }
}else if (isset($_SESSION['etat'])) {
    echo "mm";
    switch ($_SESSION['etat']) {
        case 'creation':
            $etat .= "creation";
            
            if (isset($_POST['nom']) && isset($_POST['cat']) && isset($_POST['prix'])) {
                $insert = array(
                    "c_id" => "null",
                    "c_nom" => $_POST['nom'],
                    "c_cat" => $_POST['cat'],
                    "c_prix" => $_POST['prix']
                );

                $myPDO->insert($insert);
                $idMaxCocktails = $myPDO->getIdMax('c_id'); // dernier element insere
                
                // === AJOUT BOISSONS ======
                    // Recuperer les boissons (s'il y en a)
                    if(isset($_POST['checkBoissons']) && isset($_POST['checkBoissonsId'])) {
                        $nomBoissons = $_POST['checkBoissons'];
                        $boissonsId = $_POST['checkBoissonsId'];
                        // Etablir la table de cocktail liaison boisson
                        $myPDO_Change->setNomTable('liencocktailboisson');
                        $i = 0;

                        for ($i=0; $i < count($boissonsId); $i++) { 
                            if($nomBoissons[$i] > 0){
                                //echo 'c_id : ' . $idMaxCocktails . ' b_id : ' .  $boissonsId[$i] . ' quantite :'. $nomBoissons[$i];
                                //echo '<br>';
                                $insert = array(
                                    "c_id" => $idMaxCocktails,
                                    "b_id" => $boissonsId[$i],
                                    "qteBoisson" => $nomBoissons[$i]
                                );
                                $myPDO_Change->insert($insert);
                            }
                        }

                    }
                // ======================
                // === AJOUT USTENSILES ======
                    // Recuperer les ustensiles (s'il y en a)
                    
                    if(isset($_POST['checkUstensilesId'])) {
                        
                        $ustensilesIdSelectionnes = $_POST['checkUstensilesId'];
                        
                        // Etablir la table de cocktail liaison boisson
                        $myPDO_Change->setNomTable('liencocktailustensile');
                        
                        $i = 0;
                        foreach($ustensilesIdSelectionnes as $ust) {
                            $insert = array(
                                "c_id" => $idMaxCocktails,
                                "u_id" => $boissonsId[$i],
                            );
                            $myPDO_Change->insert($insert);
                            $i++;
                        }
                    }
                // ======================
       
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

            // ====== POUR BOISSONS =========
             // Recuperer les boissons (s'il y en a)
             if(isset($_POST['checkBoissons']) && isset($_POST['checkBoissonsId'])) {
                $nomBoissons = $_POST['checkBoissons'];
                $boissonsId = $_POST['checkBoissonsId'];
                
                // Etablir la table de cocktail liaison boisson
                $myPDO_Change->setNomTable('liencocktailboisson');
                $lienCockBoisson =  $myPDO_Change->getSpecific('c_id', $_POST['c_id']);                

                for ($i=0; $i < count($nomBoissons); $i++) { 
                    
                    if($nomBoissons[$i] > 0) {
                        // Si l'element existe dans la table 
                        $exist = false;
                        
                        for ($j=0; $j < count($lienCockBoisson); $j++) {
                            //echo $boissonsId[$i] .' == '. $lienCockBoisson[$j]->getBId() .'<br>';
                            if($boissonsId[$i] == $lienCockBoisson[$j]->getBId()) {
                                $exist = true;
                                break;
                            } else {
                                $exist = false;
                            } 
                        } 
                        
                        if($exist == true ) {
                            //echo "modifier <br>";
                            $update = array(
                                "c_id" => $_POST['c_id'],
                                "b_id" => $boissonsId[$i],
                                "qteBoisson" => $nomBoissons[$i]
                            );
                           $myPDO_Change->updateRelation('c_id', 'b_id', $update);
                        } else {
                            //echo "ajouter <br>";
                            //   echo 'c_id : ' . $_POST['c_id']. ' b_id : ' .  $boissonsId[$i] . ' quantite :'. $nomBoissons[$i];
                            //echo '<br>';
                            //echo $boissonsId[$i]  . '<br>';
                            $insert = array(
                                "c_id" => $_POST['c_id'],
                                "b_id" => $boissonsId[$i],
                                "qteBoisson" => $nomBoissons[$i]
                            );
                            $myPDO_Change->insert($insert);
                        }
                        
                        
                    }
                }

            }
            // ==============================

            if (isset( $_POST['c_id']) && isset($_POST['c_nom']) && isset($_POST['c_cat']) && isset($_POST['c_prix'])) {
                $update = array(
                    "c_id" => $_POST['c_id'],
                    "c_nom" => $_POST['c_nom'],
                    "c_cat" => $_POST['c_cat'],
                    "c_prix" => $_POST['c_prix']

                );

                $myPDO->update('c_id', $update);
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

