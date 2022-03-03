<?php
session_start();
require_once "../MyPDO.php";
require_once "../connexion.php";
require_once "../../Modele/EntiteCocktail.php";
require_once "../../Modele/EntiteBoisson.php";
require_once "../../Modele/EntiteLienCocktailBoisson.php";
require_once "../../Modele/EntiteUstensile.php";
require_once "../../Modele/EntiteLienCocktailUstensile.php";
require_once "../../Modele/EntiteIngredient.php";
require_once "../../Modele/EntiteLienCocktailIngredient.php";
require_once "../../Modele/EntiteVerre.php";
require_once "../../Modele/EntiteLienCocktailVerre.php";

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

            // == INGREDIENT CONTENU ==
            $myPDO_Change->setNomTable('ingredient');
            $myPDO_Change->initPDOS_selectAll();
            $ingredient =  $myPDO_Change->getAll();
            // ===================
            // == Verres CONTENU ==
            $myPDO_Change->setNomTable('verre');
            $myPDO_Change->initPDOS_selectAll();
            $verre =  $myPDO_Change->getAll();
            // ===================


            $contenu.= $vue->getHTMLInsert($boissons, $ustensiles, $ingredient,$verre);
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

            // == USTENSILES CONTENU ==
            $myPDO_Change->setNomTable('liencocktailustensiles');
            $ustensiles =  $myPDO_Change->getAllUstensilesWithRelationCocktail();
            // ===================

            //=======VERRES CONTENU===========
            $myPDO_Change->setNomTable('liencocktailverre');
            $verre=$myPDO_Change->getAllVerresWithRelationCocktail();
            //===================

            // == INGREDIENT CONTENU ==
            $myPDO_Change->setNomTable('liencocktailingredient');
            $ingredients =  $myPDO_Change->getAllIngredientsWithRelationCocktails($cocktail->getCId());
            // ===================


            $cocktail = array(
                'c_id'=>array('balise'=>'input', 'type'=>'text','default'=> $cocktail->getCId(), 'titre' => 'id'),
                'c_nom'=>array('balise'=>'input', 'type'=>'text','default'=>$cocktail->getCNom(), 'titre' => 'Nom de cocktail'),
                "c_cat"=>array('balise'=>'select', 'type'=>'text','default'=>$cocktail->getCCat(), 'titre' => 'cat'),
                "c_prix"=>array('balise'=>'input', 'type'=>'int','default'=>$cocktail->getCPrix(), 'titre' => 'prix'),
            );

            $contenu.=$vue->getHTMLUpdate($cocktail, $boissons, $lienCockBoisson, $ustensiles, $ingredients,$verre);
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
            $titre = "Details du cocktail " . $cocktail->getCNom();
            $lienRetour = 'CRUD_Cocktails.php?action=read';
            $contenu.=$vue->getDebutHTML($titre, $lienRetour);

            // == BOISSON CONTENU ==
            $myPDO_Change->setNomTable('liencocktailboisson');
            $lienCockBoisson =  $myPDO_Change->getBoissonsForOneCocktail( $_GET['c_id']);
            // ===================

            // == USTENSILES CONTENU ==
            $myPDO_Change->setNomTable('liencocktailustensile');
            $lienCockUstensiles =  $myPDO_Change->getUstensilesForOneCocktail( $_GET['c_id']);
            // ===================

            // == INGREDIENTS CONTENU ==
            $myPDO_Change->setNomTable('liencocktailingredient');
            $ingredients =  $myPDO_Change->getIngredientForOneCocktail( $_GET['c_id']);
            // ===================
            // ========= Verre CONTENU ========
            $myPDO_Change->setNomTable('liencocktailverre');
            $liencocktailverre =  $myPDO_Change->getVerreForOneCocktail( $_GET['c_id']);
            // ===================

            $contenu.=$vue->getHTMLDetails(array(
                'c_id'=>array('balise'=>'input', 'type'=>'text','default'=> $cocktail->getCId(), 'titre' => 'id'),
                'c_nom'=>array('balise'=>'input', 'type'=>'text','default'=>$cocktail->getCNom(), 'titre' => 'Nom de cocktail'),
                "c_cat"=>array('balise'=>'select', 'type'=>'text','default'=>$cocktail->getCCat(), 'titre' => 'cat'),
                "c_prix"=>array('balise'=>'input', 'type'=>'int','default'=>$cocktail->getCPrix(), 'titre' => 'prix'),
            ), $lienCockBoisson, $lienCockUstensiles, $ingredients ,$liencocktailverre);
            $_SESSION['etat'] = 'modification';

            break;
        }

    }
}else if (isset($_SESSION['etat'])) {
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
                            "u_id" => $ust,
                        );
                        $myPDO_Change->insert($insert);
                        $i++;
                    }
                }
                // ======================

                // === AJOUT INGREDIENTS ======

                // Etablir la table de cocktail liaison ingredients
                $myPDO_Change->setNomTable('liencocktailingredient');

                if(isset($_POST['checkIngredientsId']) && isset($_POST['checkIngredients'])) {
                    $ingIDs = $_POST['checkIngredientsId'];
                    $ingquantity = $_POST['checkIngredients'];
                    foreach($ingIDs as $key => $val) {
                        if($ingquantity[$key] > 0){
                            $insert = array(
                                "c_id" => $idMaxCocktails,
                                "i_id" => $val,
                                "qteIngredient" => $ingquantity[$key]
                            );
                            $myPDO_Change->insert($insert);
                        }
                    }

                }
                // ======================
                // === AJOUT VERRES ======

                if(isset($_POST['checkVerreId'])) {

                    $verreIdSelectionnes = $_POST['checkVerreId'];

                    // Etablir la table de cocktail liaison verre
                    $myPDO_Change->setNomTable('liencocktailverre');
                   // $verreId = $_POST['checkVerreId'];

                    $i = 0;
                    foreach($verreIdSelectionnes as $verre) {
                        $insert = array(
                            "c_id" => $idMaxCocktails,
                            "v_id" => $verre,
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
                    $liaisonExists = $myPDO_Change->element2KeysExists('c_id', 'b_id', $_POST['c_id'], $boissonsId[$i]);

                    if($nomBoissons[$i] > 0) {
                        if($liaisonExists) {
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


                    } else if($liaisonExists > 0) {
                        $data = array(
                            "c_id" => $_POST['c_id'],
                            "b_id" => $boissonsId[$i]
                        );
                        $myPDO_Change->delete($data);
                    }
                }

            }
            // ==============================

            // === AJOUT / SUPPRESSION DES USTENSILES ======
            // Recuperer les ustensiles (s'il y en a)
            $myPDO_Change->setNomTable('liencocktailustensile');

            if(isset($_POST['checkUstensilesId'])) {
                $checkList = $_POST['checkUstensilesId'];

                // SUPPRIMER
                $idElem = array(
                    "c_id" => $_POST['c_id'],
                );

                $myPDO_Change->delete($idElem);

                foreach($checkList as $key => $value){
                    $idElem = array(
                        "c_id" => $_POST['c_id'],
                        "u_id" => $value
                    );
                    $myPDO_Change->insert($idElem);
                }
            }
            // ======================

            // === AJOUT / SUPPRESSION DES INGREDIENTS ======
            $myPDO_Change->setNomTable('liencocktailingredient');

            if(isset($_POST['checkIngredientsId']) && isset($_POST['checkIngredients'])) {
                $ingIDs = $_POST['checkIngredientsId'];
                $ingquantity = $_POST['checkIngredients'];

                foreach($ingIDs as $key => $val) {
                    $liaisonExists = $myPDO_Change->element2KeysExists('c_id', 'i_id', $_POST['c_id'], $val);
                    if($ingquantity[$key] > 0){
                        $data = array(
                            "c_id" => $_POST['c_id'],
                            "i_id" => $val,
                            "qteIngredient" => $ingquantity[$key]
                        );
                        if($liaisonExists > 0) {
                            //echo "update <br>";
                            $myPDO_Change->updateRelation('c_id', 'i_id', $data);
                        } else {
                            //echo "insert <br>";
                            $myPDO_Change->insert($data);
                        }

                    } else {
                        if($liaisonExists > 0) {
                            $data = array(
                                "c_id" => $_POST['c_id'],
                                "i_id" => $val
                            );
                            $myPDO_Change->delete($data);
                        }
                    }
                }
            }
            // ======================
            // === AJOUT / SUPPRESSION DES Verres ======
            $myPDO_Change->setNomTable('liencocktailverre');
            $checkL = $_POST['checkVerreId'];
            if(isset($_POST['checkVerreId'])) {

                $checkList = $_POST['checkVerreId'];

                // SUPPRIMER
                $idElem = array(
                    "c_id" => $_POST['c_id'],
                );

                $myPDO_Change->delete($idElem);
                //ajouter
                foreach($checkList as $key => $value){
                    $idElem = array(
                        "c_id" => $_POST['c_id'],
                        "v_id" => $value
                    );
                    $myPDO_Change->insert($idElem);
                }
            }
            // ======================

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

