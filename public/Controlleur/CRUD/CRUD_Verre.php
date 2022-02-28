<?php 
include "../MyPDO.php";
include "../../Vue/verres.php";
include "../connexion.php";
include "../../Modele/EntiteG07_Verre.php";
ini_set('display_errors','on');
function getDebutHTML(): string {
return "<!DOCTYPE html>
<html>
<head>
<meta charset="."'utf-8'".">
<meta http-equiv="."'X-UA-Compatible'"." content="."'IE=edge'".">
<meta name="."'viewport'"." content="."width=device-width, initial-scale=1".">
<link rel="."'stylesheet'"." href="."'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'"." integrity="."'sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T'"." crossorigin="."'anonymous'".">
<link rel="."'stylesheet'"." href="."'../../css/Verre_Ingredient.css'".">
<title>Verre</title>
</head>
<body class='bg-img4'>
<link rel="."'stylesheet'"." href="."'https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css'".">
   <script defer src="."'https://use.fontawesome.com/releases/v5.3.1/js/all.js'"."></script>
   <section class="."'hero is-full'".">
     &nbsp;
       
          

<div class='conteneur1'>
<div class='d1'>
</div>
</div>
        
        
         &nbsp;

   </section>
   <section>
   <center>
   <nav class='navbar is-success is-fixed-top' role='navigation' aria-label='main navigation'>
 <div class='navbar-brand'>

   <a class='navbar-item' href='index.php'>
     <img src='../../images/logo.jpeg' width='112' height='28'>
   </a>
 </div>

 <div id='navbarBasicExample' class='navbar-menu'>
   <div class='navbar-start'>
   <a class='navbar-item' href='../index.php'>
   Accueil
 </a>
 <a class='navbar-item' href='CRUD_boissons.php'>
   Boissons
 </a>
 <a class='navbar-item' href='CRUD_Cocktails.php'>
   Cocktails
 </a>
 <a class='navbar-item' href='CRUD_commande.php'>
   Commandes
 </a>
 <a class='navbar-item'  href='CRUD_etape.php'>
   Etapes
 </a>
 <a class='navbar-item'  href='CRUD_Ingredient.php'>
   Ingrédients
 </a>
 <a class='navbar-item'  href='CRUD_Ustensiles.php'>
  Ustensiles
</a>
<a class='navbar-item'  href='CRUD_Verre.php'>
Verres
</a>
     </div>
       </div>
       </nav>

   </section>

   &nbsp;
   <center><h1 id='titre'>Liste des verres</h1></center>&nbsp;
";
}

function getFinHTML(): string {
    return "
   </body>
   <!-- Footer -->
   <footer style='background-color:rgba(2, 2, 2, 0.575);' class="."'text-center text-lg-start text-wight'".">
     <!-- Section: Social media -->
     <section
       class="."'d-flex justify-content-center justify-content-lg-between p-4 border-bottom'"."
     >
       <!-- Left -->
       <div class="."'me-5 d-none d-lg-block text-primary'".">
         <span>Réseau sociaux</span>
       </div>
       <!-- Left -->
   
       <!-- Right -->
       <div >
         <a href="."''"." class="."'me-4 text-reset'".">
           <i><img src='../../images/Face.png'></i>
         </a>
         <a href="."''"." class="."'me-4 text-reset'".">
           <i><img src='../../images/Twitter.png'></i>
         </a>
         <a href="."''"." class="."'me-4 text-reset'".">
         <i><img src='../../images/Insta.png'></i>
         </a>
         <a href="."''"." class="."'me-4 text-reset'".">
         <i><img src='../../images/What.png'></i>
       </a>
         <a href="."''"." class="."'me-4 text-reset'".">
           <i><img src='../../images/Gitlab.png'></i>
         </a>
         <a href="."''"." class="."'me-4 text-reset'".">
         <i><img src='../../images/Github.png'></i>
         </a>
        
        
       </div>
       <!-- Right -->
     </section>
     <!-- Section: Social media -->
   
     <!-- Section: Links  -->
     <section class="."''".">
       <div class="."'container text-center text-md-start mt-5'".">
         <!-- Grid row -->
         <div class="."'row mt-3'".">
           <!-- Grid column -->
           <div class="."'col-md-3 col-lg-4 col-xl-3 mx-auto mb-4'".">
             <!-- Content -->
             <h6 class="."'text-white text-uppercase fw-bold mb-4'".">
               <i class="."'fas fa-gem me-3'"."></i>Bar à coktail
             </h6>
             <p class='text-info'>
               Site Internet qui représente un bar à coktail ainsi que ces différents composants
             </p>
           </div>
           <!-- Grid column -->
   
           <!-- Grid column -->
           <div class="."' col-md-2 col-lg-2 col-xl-2 mx-auto mb-4'".">
             <!-- Links -->
             <h6 class="."' text-white text-uppercase fw-bold mb-4'".">
               Logiciel et langages utilisé
             </h6>
             <p class='text-info'>
               <a href="."'#!'"." class="."'text-reset'".">Php</a>
             </p>
             <p class='text-info'>
               <a href="."'#!'"." class="."'text-reset'".">Html</a>
             </p>
             <p class='text-info'>
               <a href="."'#!'"." class="."'text-reset'".">Css</a>
             </p>
             <p class='text-info'>
               <a href="."'#!'"." class="."'text-reset'".">Boostrap</a>
             </p>
             <p class='text-info'>
               <a href="."'#!'"." class="."'text-reset'".">Bulma</a>
             </p>
           </div>
           <!-- Grid column -->
   
           <!-- Grid column -->
           <div class="."'col-md-3 col-lg-2 col-xl-2 mx-auto mb-4'".">
             <!-- Links -->
             <h6 class="."' text-white text-uppercase fw-bold mb-4'".">
               Membres du group
             </h6>
             <p class='text-info'>
               <a href="."'#!'"." class="."'text-reset'".">Nadia Hariri</a>
             </p>
             <p class='text-info'>
               <a href="."'#!'"." class="."'text-reset'".">Fouad Tekfa</a>
             </p>
             <p class='text-info'>
               <a href="."'#!'"." class="."'text-reset'".">Lamia Sasaoud</a>
             </p>
             <p class='text-info'>
               <a href="."'#!'"." class="."'text-reset'".">à remplir</a>
             </p>
           </div>
           <!-- Grid column -->
   
           <!-- Grid column -->
           <div class="."'col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4'".">
             <!-- Links -->
             <h6 class="."' text-white text-uppercase fw-bold mb-4'".">
               Contact
             </h6>
             <p class='text-info'><i class="."'fas fa-home me-3'"."></i>Université le havre </p>
             <p class='text-info'>
               <i class="."'fas fa-envelope me-3'"."></i>
               email_exemple@gmail.com
             </p>
             <p class='text-info'><i class="."'fas fa-phone me-3'"."></i> Téléphone 1</p>
             <p class='text-info'><i class="."'fas fa-print me-3'"."></i> Téléphone 2</p>
           </div>
           <!-- Grid column -->
         </div>
         <!-- Grid row -->
       </div>

</html>
";
}
session_start();

    // initialisation de la connexion via l'instance de MyPDO
$myPDOVerre = new MyPDO('mysql', $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd'], 'G07_Verre');

    // initialisation du générateur de vues HTML
$vue = new \bar\verres();

    // initialisation des chaînes à afficher
$contenu = "";
$message = "";

        $nbverre = $myPDOVerre->getCountValue();
        $message .= "<center><p class='title is-4' id='titre2'>La table G07_Verre contient ".$nbverre." enregistrements.</p></center>&nbsp\n";
        $contenu .="<div class='columns'>
        <div class='column is-1 '>
        </div>
        <div class='column '>
        <a href='../CRUD/Formulaire/formulaire.php?action=create' class='Arriere'>
        <input class='button is-fullwidth is-black is-outlined' type='submit' name='envoi' id='titr' value='Ajouter Verre'  />
        </a>
        </div>
        <div class='column is-1'>
        </div>
        </div> 
        ";
    

    // récupération et affichage de la liste des ecuries avec liens vers édition/suppresion

$lesverres = $myPDOVerre->getAll();
$contenu .= $vue->getAllVerre($lesverres);
echo getDebutHTML();
echo $message;
echo $contenu;
echo getFinHTML();

?>