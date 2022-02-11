document.addEventListener('DOMContentLoaded', function () {
    
    document.getElementById('cocktails').addEventListener('click', function(){
        document.location.href = './Vue/cocktails.php?action=selectionnerTable&table_name=Cocktail"';
    });

    document.getElementById('boissons').addEventListener('click', function(){
        document.location.href = './boissons.php';
    });

    document.getElementById('ingredients').addEventListener('click', function(){
        document.location.href = './ingredients.php';
    });

    document.getElementById('commandes').addEventListener('click', function(){
        document.location.href = './commandes.php';
    });

    document.getElementById('utensiles').addEventListener('click', function(){
        document.location.href = './utensiles.php';
    });

    document.getElementById('verres').addEventListener('click', function(){
        document.location.href = './verres.php';
    });

});