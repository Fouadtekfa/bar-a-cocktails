document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('retour').addEventListener('click', function(){
        if(document.getElementById('insertContainer').style.display == 'block'){
            document.getElementById('informationEntite').style.display = 'block';
            document.getElementById('insertContainer').style.display = 'none';
        } else {
            document.location.href = '../';
        }
    });

    document.getElementById('btnAjouter').addEventListener('click', function(){

        document.getElementById('informationEntite').style.display = 'none';
        document.getElementById('insertContainer').style.display = 'block';
    });


    let elements = document.getElementsByClassName("etapes-btn");


    let functionEtapes = function() {

    };

    for (let i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', functionEtapes, false);
    }


});