<?php
require_once "imports.php";
require_once "getDebutHtml.html";
?>

<h1>Bar à Cocktail</h1>

<div class="contentContainer">
    <div class="produit cocktailContainer" id="cocktails">
        <a class="prin" href="../public/Controlleur/CRUD/CRUD_Cocktails.php?action=read">
            <div class="imageContainer imgCocktail">
            </div>
            <!--<a href="Vue/ho.php?action=selectionnerTable&table_name=Cocktail"> -->
            <div class="titleContainer">
                <h2>Cocktails</h2>
            </div>
        </a>
    </div>


    <div class="produit boissonContainer" id="boissons">
        <a class="prin" href="../public/Controlleur/CRUD/CRUD_boissons.php?action=read">
            <div class="imageContainer imgBoisson">
            </div>
            <div class="titleContainer">
                <h2>Boissons</h2>
            </div>
        </a>
    </div>


    <div class="produit ingredientContainer" id="ingredients">
        <a class="prin" href="../public/Controlleur/CRUD/CRUD_Ingredient.php?action=read">
            <div class="imageContainer imgIngredient">
            </div>
            <div class="titleContainer">
                <h2>Ingredients</h2>
            </div>
        </a>
    </div>



    <div class="produit commandeContainer" id="commandes">
        <a class="prin" href="../public/Controlleur/CRUD/CRUD_commande.php?action=read">
            <div class="imageContainer imgCommande">
            </div>
            <div class="titleContainer">
                <h2>Commandes</h2>
            </div>
        </a>
    </div>



    <div class="produit utensilesContainer" id="utensiles">
        <a class="prin" href="../public/Controlleur/CRUD/CRUD_Ustensiles.php?action=read">
            <div class="imageContainer imgUtensiles">
            </div>
            <div class="titleContainer">
                <h2>Ustensiles</h2>
            </div>
        </a>
    </div>



    <div class="produit verreContainer" id="verres">
        <a class="prin" href="../public/Controlleur/CRUD/CRUD_Verres.php?action=read">
            <div class="imageContainer imgVerre">
            </div>
            <div class="titleContainer">
                <h2>Verres</h2>
            </div>
    </div>
    </a>
</div>
<?php

require_once "getFinHtml.html";
?>
