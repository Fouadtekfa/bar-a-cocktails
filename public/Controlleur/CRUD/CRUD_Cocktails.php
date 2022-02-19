<?php

require_once "../../imports.php";
require_once "../../Modele/EntiteCocktail.php";
$myPDO = $_ENV['myPdo'];
$myPDO->setNomTable('Cocktail');
$contenu = "";
$etat="";
if (isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'insererCocktail': {
            $nbCocktail = $myPDO->getCountValue();
            echo $nbCocktail;
            echo  $_GET['nom'];

            $contenu = array(
                "c_id" => "null",
                "c_nom" => $_GET['nom'],
                "c_cat"=>$_GET['cat'],
                "c_prix"=>$_GET['prix']
            );

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
            $myPDO->insert($contenu);
            $_SESSION['etat'] = 'créé';
            ?> <script>  document.location.href = '../../Vue/cocktails.php';  </script> <?php
            break;

    }
}


?>
<p><?php foreach($contenu as $value) {
        echo $value;
    }

    echo $etat?></p>
