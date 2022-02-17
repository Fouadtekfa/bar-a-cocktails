<?php 

require_once "../../imports.php";
require_once "../../Modele/EntiteUtensile.php";
$myPDO = $_ENV['myPdo'];
$myPDO->setNomTable('Utensile');
$contenu = "";
$etat="";
if (isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'insererUtensile': {
            $nbUtensiles = $myPDO->getCountValue();
            echo $nbUtensiles;
            echo  $_GET['nom'];
                        
            $contenu = array(
                "u_id" => "null",
                "u_nom" => $_GET['nom']
            );

            $_SESSION['etat'] = 'création';
            break;        
        }
    }
} 

if (isset($_SESSION['etat'])) {
    switch ($_SESSION['etat']) {
        case 'création':
            $etat.="creation";
            $myPDO->insert($contenu);
            $_SESSION['etat'] = 'créé';
            ?> <script>  document.location.href = '../../Vue/utensiles.php';  </script> <?php
            break;

    }
}
    

?>
<p><?php foreach($contenu as $value) {
        echo $value;
    }
    
    echo $etat?></p>