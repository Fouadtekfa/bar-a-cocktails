<?php 

require_once "../../imports.php";
require_once "../../Modele/EntiteUtensile.php";
$myPDO = $_ENV['myPdo'];
$myPDO->setNomTable('Utensile');
$contenu = "";
$idElem = "";
$etat="";

if (isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'insererUtensile': {
            $nbUtensiles = $myPDO->getCountValue();
            echo $nbUtensiles;
            echo  $_GET['nom'];
                        
            $contenu = array(
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

            ?>            
                <p><?php foreach($contenu as $value) {
                    echo $value;
                }

                echo $etat?></p> <?php
            $_SESSION['etat'] = 'modification';
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
            //$_SESSION['etat'] = 'modifie';
            ?> <script>  document.location.href = '../../Vue/utensiles.php';  </script> <?php
            break;
        }

    }
}
    

?>
