<?php

require_once "../../imports.php";
require_once "../../Modele/EntiteBoisson.php";
$myPDO = $_ENV['myPdo'];
$myPDO->setNomTable('Boisson');
$contenu = "";
$etat="";
if (isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'insererBoisson': {
            $nbBoisson = $myPDO->getCountValue();
            echo $nbBoisson;
            echo  $_GET['nom'];
            $alcool = false;
            if($_GET['estAlcoolise'] == 'on') {
                $alcool = true;
            }
            $contenu = array(
                "b_id" => "null",
                "b_nom" => $_GET['nom'],
                "b_type" =>$_GET['type'],
                "b_estAlcoolise" => $alcool,
                "b_qteStockee"=> $_GET['qteStockee']

            );
            ?><p><?php echo $alcool ?></p><?php

            $_SESSION['etat'] = 'creation';
            break;
        }
        case 'modifierBoisson': {
            $nbUtensiles = $myPDO->getCountValue();
            $contenu = array(
                "b_id" => "null",
                "b_nom" => $_GET['nom'],
                "b_type" =>$_GET['type'],
                "b_estAlcoolise" => $_GET['estAlcoolise'],
                "b_qteStockee"=> $_GET['qteStockee']
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
            ?> <script>  document.location.href = '../../Vue/boissons.php';  </script> <?php
            break;

    }
}


?>
<p><?php foreach($contenu as $value) {
        echo $value;
    }

    echo $etat?></p>