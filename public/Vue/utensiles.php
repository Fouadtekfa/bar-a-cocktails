<?php
require_once "../imports.php";
require_once "../Modele/EntiteUtensile.php";
$myPDO = $_ENV['myPdo'];
$myPDO->setNomTable('Utensile');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/cocktails.css">
        <title>Cocktail</title>
    </head>
    <h1>Ustensiles</h1>
        <div class="arrow" id="retour">
        <img src="../images/retour.png" alt="retour" class="retour">
        </i>
        </div>
<body>
<?php
if (isset($_GET['u_id'])){ 
    $utensile = $myPDO->get('u_id', $_GET['u_id']);
?>
    <div class="insertContainer" id="insertUpdateContainer">
        <form id="updateUtensileForm"  method="get" action="../Controlleur/CRUD/CRUD_Utensiles.php" name="action" >
            <input type="text" name="action" value="modifierUtensile" hidden>
            <div class="form-group">
                <input type="text" class="form-control" id="u_id" name="u_id" hidden placeholder="Nom de l'utensile" value="<?php echo $utensile->getUId() ?>" >
                <label for="name" class="rowsInformation">Nom de l'utensile</label>
                <input type="text" class="form-control" id="u_nom" name="u_nom" placeholder="Nom de l'utensile" value="<?php echo $utensile->getUNom() ?>">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>

    </div>

<?php } else {
    $myPDO->initPDOS_selectAll();
    $va =  $myPDO->getAll();
    ?>
    <div id="informationEntite">
        <div class="buttonContainer">
            <button type="button" class="btn btn-primary" id="btn_ajouter">Ajouter</button>
        </div>
    <div class="tableContainer">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom</th>
                    <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($va as $valeur){  ?>
                            <tr>
                                <th scope="row"><?php echo $valeur->getUId() ?></th>
                                    <td class="rowsInformation"><?php echo $valeur->getUNom()?></input></td>
                                <td class="td_buttons_actions"><a href="?u_id=<?php echo $valeur->getUId()?>"><button type="button" class="btn btn-warning etapes-btn">Editer</button></a></td>
                                <td class="td_buttons_actions"><button type="button" class="btn btn-danger">Supprimer</button></td>
                            </tr>
                        <?php } ?>    
            </tbody>
        </table>    
    </div>
    </div>

    <div class="insertContainer" style="display: none" id="insertContainer">
        <form id="addUtensileForm"  method="get" action="../Controlleur/CRUD/CRUD_Utensiles.php" name="action" value="2" >
            <input type="text" name="action" value="insererUtensile" hidden>
            <div class="form-group">
                <label for="name" class="rowsInformation">Nom de l'utensile</label>
                <input type="text" class="form-control" id="name" name="nom" placeholder="Nom de l'utensile">
            </div>
            <button type="submit" class="btn btn-primary">Ajout</button>
        </form>

    </div>

<?php 
} 
?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/utensiles.js"></script>

</body>
</html>