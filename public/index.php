<?php
require_once "imports.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Cocktail</title>
</head>
<body>
    <h1>Bar à Cocktail</h1>

    <div class="contentContainer">
        <div class="produit cocktailContainer" id="cocktails">
            <div class="imageContainer imgCocktail">
            </div>
            <!--<a href="Vue/ho.php?action=selectionnerTable&table_name=Cocktail"> -->
            <div class="titleContainer">
                <h2>Cocktails</h2>
            </div>
            <!-- </a> -->
        </div>
        <div class="produit boissonContainer" id="boissons">
            <div class="imageContainer imgBoisson">
            </div>
            <div class="titleContainer">
                <h2>Boissons</h2>
            </div>
        </div>
        <div class="produit ingredientContainer" id="ingredients">
            <div class="imageContainer imgIngredient">
            </div>
            <div class="titleContainer">
                <h2>Ingredients</h2>
            </div>
        </div>
        <div class="produit commandeContainer" id="commandes">
            <div class="imageContainer imgCommande">
            </div>
            <div class="titleContainer">
                <h2>Commande</h2>
            </div>
        </div>
        <div class="produit utensilesContainer" id="utensiles">
            <div class="imageContainer imgUtensiles">
            </div>
            <div class="titleContainer">
                <h2>Ustensiles</h2>
            </div>
        </div>
        <div class="produit verreContainer" id="verres">
            <div class="imageContainer imgVerre">
            </div>
            <div class="titleContainer">
                <h2>Verres</h2>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/fonctions.js"></script>
</body>
</html>