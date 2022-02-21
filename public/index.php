<?php
session_start();
session_unset();
require_once "imports.php";
require_once "getDebutHtml.html";
?>

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
    <?php

require_once "getFinHtml.html";
?>
    