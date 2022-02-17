document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('retour').addEventListener('click', function(){
        document.location.href = '../';
    });

    document.getElementById('btn_ajouter').addEventListener('click', function(){
        document.getElementById('informationEntite').style.display = 'none';
        document.getElementById('insertContainer').style.display = 'block';

    });

});