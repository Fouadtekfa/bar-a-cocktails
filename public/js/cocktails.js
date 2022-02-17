document.addEventListener('DOMContentLoaded', function () {
    
    document.getElementById('retour').addEventListener('click', function(){
        document.location.href = '../';
    });

    let elements = document.getElementsByClassName("etapes-btn");

    let functionEtapes = function() {
        document.location.href = '../';
    };

    for (let i = 0; i < elements.length; i++) {
        console.log(elements[i]);
        elements[i].addEventListener('click', functionEtapes, false);
    }
});