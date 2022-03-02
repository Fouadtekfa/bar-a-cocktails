document.addEventListener('DOMContentLoaded', function () {
    
    document.getElementById('retour').addEventListener('click', function(){
        document.location.href = '../';
    });

    let elements = document.getElementsByClassName("etapes-btn");

    let functionEtapes = function() {
        document.location.href = '../Vue/etapes.php';
    };

    for (let i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', functionEtapes, false);
    }
    document.getElementById('btn_ajouter').addEventListener('click', function(){
        document.getElementById('informationEntite').style.display = 'none';
        document.getElementById('insertContainer').style.display = 'block';
    });

});
