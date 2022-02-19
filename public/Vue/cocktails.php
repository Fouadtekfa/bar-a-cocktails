<?php
require_once "../imports.php";
require_once "../Modele/EntiteCocktail.php";
$myPDO = $_ENV['myPdo'];
$myPDO->setNomTable('Cocktail');
$myPDO->initPDOS_selectAll();
$va =  $myPDO->getAll();
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
<body>
    <h1>Cocktails</h1>
    <div class="arrow" id="retour">
    <img src="../images/retour.png" alt="retour" class="retour">
    </i>
    </div>
    <div class="buttonContainer">
        <button type="button" class="btn btn-primary" id="btn_ajouter">Ajouter</button>
    </div>
    <div id="informationEntite">

    <div class="tableContainer">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nous Cocktail </th>
                    <th scope="col"> Catégorie du cocktail</th>
                    <th scope="col">Prix</th>

                    <th scope="col" colspan="4" style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($va as $valeur){  ?>

                        <tr>
                            <th scope="row"><?php echo $valeur->getCId() ?></th>
                            <td><?php echo $valeur->getCNom(); ?></td>
                            <td><?php echo $valeur->getCCat(); ?></td>
                            <td><?php echo $valeur->getCprix(); ?> €</td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-primary etapes-btn">Etapes</button></td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-warning">Editer</button></td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-danger">Supprimer</button></td>
                        </tr>
                    
                        <?php } ?>
            </tbody>
        </table>    
    </div>
    </div>
    <div class="insertContainer" style="display: none" id="insertContainer">
        <form id="addUtensileForm"  method="get" action="../Controlleur/CRUD/CRUD_Cocktails.php" name="action" >
            <input type="text" name="action" value="insererCocktail" hidden>
            <div class="form-group">
                <label for="name">Nom de Cocktail </label>
                <input type="text" class="form-control" id="name" name="nom" placeholder="Nom de Cocktail">
                <label for="cat">catégorie de Cocktail</label>
                <select id="cat" name="cat" class="form-control">
                        <option value="SD">SD</option>
                        <option value="LD">LD</option>
                        <option value="AD">AD</option>
                </select>
                <label for="prix">Prix de Cocktail </label>
                <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix de Cocktail">

            </div>
            <button type="submit" class="btn btn-primary">Ajout</button>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/cocktails.js"></script>

</body>
</html>