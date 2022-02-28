<?php

namespace bar;
class verres
{


    public function getHTMLVerre(EntiteG07_Verre $verre): string
    {

        $ch ="<h1 class='text-center font-weight-bold text-white'>Information sur l'identifiant rechercher </h1>";
        $ch .="<div class='container '>";
        $ch .="<div class='row'>";
        $ch .="<div class='col'>";
        $ch .="</div>";
        $ch .="<div class='col'>";
        $ch .="<table class='table'>";
        $ch .="<div class='columns'><div class='column is- '></div><div class='column '>";
        $ch .="<thead class='thead-dark'>";
        $ch .="<tr >";
        $ch .="<th class='text-center'>v_id</th>";
        $ch .="<th class='text-center'>v_type</th>";
        $ch .="</tr></thead><tbody>";
        $ch .= "<tr class='table-primary text-center'>";
        $ch .= "<th class='text-center'>".$verre->getVId()."</th>";
        $ch .= "<th class='text-center'>".$verre->getVType()."</th>";
        $ch .= "</tr>";
        $ch .= "</tbody></table>";
        $ch .= "</div>";
        $ch .= "<div class='col'>";
        $ch .= "</div></div></div>";
        return $ch;

       

    }

    
    public function getFormulaireVerre(array $assoc): string
    {
      $ch ="<div class='container '>";
      $ch .="<div class='row'>";
      $ch .="<div class='col'>";
      $ch .="</div>";
      $ch .="<div class='col'>";
      $ch .= "<div class='box text-success ' id='box4' id='titre2'>";
      $ch .= " <form action='".$_SERVER['PHP_SELF']."' method='GET'>\n";
        $i=0;
        foreach ($assoc as $col => $val) {
            if (is_array($val)) {
              if($i==0){
                $ch .= "<input class='input  mt-3 mb-3 ' name='$col' type='hidden' value='".$val['default']."'/>\n";
              }else
                $ch .= "$col : <input class=' input mt-3 mb-3' name='$col' type='".$val['type']
                                  ."' value='".$val['default']."'/>\n";
            }
            else{

                $ch .= "$col : <input class='input text-danger  mt-3 mb-3' type='$val' name='$col' />\n";
              }
                ++$i;
        }


          $ch .= "<center><input class='button is-danger bg-success is-outlined' type='submit' name='Valider' value='Sauvegarder'/></center>";
          $ch .="</div'>";
          


          $ch .="</form>";
          $ch .=" </div>";
          $ch .="</div>";
         $ch .="<div class='col'>";
         $ch .="</div>";
         $ch .="</div>";
         $ch .="</div>";
         return $ch;
         }


    public function getAllVerre(array $tabEntiteG07_Verre): string
    {
        $ch = "";
        foreach ($tabEntiteG07_Verre as $verres) {
            $ch.="";
            if ($verres instanceof EntiteG07_Verre) {
                $id=$verres->getVId();
                $nom=$verres->getVType();
                $ch.="<div class='box' id='box4'>";
                $ch.="<center>";
                $ch .= "<img id='ronger' src='../../images/verres/$id.jpg'>";
                $ch .= "<h1 class='text-primary mt-3 mb-3'>v_id</h1>".$id."<br>";
                $ch .= "<h1 class='text-primary mt-3 mb-3'>v_type</h1>".$nom."<br>";
                $ch .= "<a href='../CRUD/Formulaire/formulaire.php?action=update&v_id=".$id."'><input class='button is-fullwidth has-background-info is-white is-outlined  mt-3 mb-3' type='submit' name='envoi' value='Modifier' /></a>";
                $ch .= "<a href='../CRUD/Formulaire/formulaire.php?action=delete&v_id=".$id."'><input class='button is-fullwidth has-background-danger is-white is-outlined mt-3 mb-3' type='submit' name='envoi' value='Supprimer' /></a>";
                $ch.="</div>";
            }
            $ch .= "</center>\n";
        }
        return $ch;
    }



}
?>