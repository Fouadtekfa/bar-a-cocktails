<?php

namespace bar;

class VueCocktail
{

    public function getDebutHTML(): string
    {
        $res = '<!DOCTYPE html>
            <html lang="en">
            <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                    <link rel="stylesheet" href="../../css/style.css">
                    <link rel="stylesheet" href="../../css/cocktails.css">
                    <title>Cocktail</title>
                </head>
                 <h1>Cocktails</h1>
                    <div class="arrow" id="retour">
                    <img src="../../images/retour.png" alt="retour" class="retour" onclick="history.back()">
                    </i>
                    </div>
                <body>';
        return $res;
}
public function getHTMLUpdate(array  $cocktaile) : string {
    $res=   '    <div class="insertContainer" id="insertUpdateCocktail">
            <form id="updateCocktailForm"  method="get" action="../Controlleur/CRUD/CRUD_Cocktails.php" name="action" >
                <input type="text" name="action" value="modifierCocktail" hidden>
                <div class="form-group">
                    <input type="text" class="form-control" id="c_id" name="c_id" hidden placeholder="Nom de Cocktail" value="'. $cocktaile->getCId() .'" >
                    <label for="name" class="rowsInformation">Nom de lutensile</label>
                    <input type="text" class="form-control" id="c_nom" name="c_nom" placeholder="Nom de Cocktail" value="'.$cocktaile->getCNom() .'">
                    <label for="cat">catégorie de Cocktail</label>
                    <select id="cat" name="cat" class="form-control">
                        <option value="'.$cocktaile->getCCat().'">SD</option>
                        <option value="'.$cocktaile->getCCat() .'">LD</option>
                        <option value="'.$cocktaile->getCCat().'">AD</option>
                    </select>
                    <label for="prix">Prix de Cocktail </label>
                    <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix de Cocktail"value="'. $cocktaile->getCPrix().' " >

                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>

        </div>';


    return $res;
}
    public function getHTMLAll($va) : string {
        $res='
        
                 <div class="buttonContainer">
          <form id="insererCocktailFormButton"  method="post" action="?action=insererCocktail">
        <button type="submit" class="btn btn-primary" id="btn_ajouter">Ajouter</button>
        </form>
    </div>
    <div id="informationEntite">

    <div class="tableContainer">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nous Cocktail </th>
                    <th scope="col"> Catégorie du cocktail</th>
                    <th scope="col">Prix</th>

                    <th scope="col" colspan="4" style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($va as $valeur){
            $res.='
                        <tr>
                            <th scope="row">'. $valeur->getCId().' </th>
                            <td>'.$valeur->getCNom() .'</td>
                            <td>'. $valeur->getCCat().'</td>
                            <td>'. $valeur->getCprix().' €</td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-primary etapes-btn">Etapes</button></td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-warning">Editer</button></td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-danger">Supprimer</button></td>
                        </tr> ';

                        }
    $res .='        </tbody>
        </table>    
    </div>
    </div>
        ';
        return $res;
    }
    public function getHTMLInsert() : string {
        $res=' <div class="insertContainer"  id="insertContainer">
        <form id="addUtensileForm"  method="get" name="action" >
            <input type="text" name="action" value="insererCocktail" hidden>
            <div class="form-group">
                <label for="name">Nom de Cocktail </label>
                <input type="text" class="form-control" id="name" name="nom" placeholder="Nom de Cocktail">
                <label for="cat">catégorie de Cocktail</label>
                <select id="cat" name="cat" class="form-control">
                        <option value="SD">SD</option>
                        <option value="LD">LD</option>
                        <option value="AD">AD</option>
                </select>
                <label for="prix">Prix de Cocktail </label>
                <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix de Cocktail">

            </div>
            <button type="submit" class="btn btn-primary">Ajout</button>
        </form>

    </div>
        ';


        return $res;
    }


}

?>

