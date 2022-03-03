<?php

namespace bar;
class vueInegredients {

    public function getDebutHTML($title, $lienRetour) : string {
        $corps =    '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                            <link rel="stylesheet" href="../../css/style.css">
                            <link rel="stylesheet" href="../../css/utensiles.css">
                            <title>'.$title.'</title>
                        </head>
                        <h1>INGREDIENTS</h1>
                        <div class="arrow" id="retour">
                        <a href="'.$lienRetour.'"><img src="../../images/retour.png" alt="retour" class="retour" ></a>
                        </i>
                        </div>                
                    <body>';
        return $corps;
    }

    public function getHTMLUpdate(array  $ingredient) : string {
        $corps = "";

        $corps .=    '<div class="insertContainer" id="insertUpdateContainer">'.
            '<form id="updateUtensileForm"  method="get">'.
            '<div class="form-group">';
        foreach ($ingredient as $col => $val) {
            if (is_array($val)) {
                $hide = "";
                if($col == 'i_id') $hide = 'hidden';
                $corps.='       <label for="name" class="rowsInformation" '.$hide.'>'.$val['titre'].'</label>
                                        <input type='.$val['type'].' class="form-control" '.$hide.'  id="i_id" name="'.$col.'" placeholder="Type de Verre" value="'.$val['default'].'" >';


            }
        }
        $corps.='            </div>
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </form>
                            </div>';

        return $corps;
    }

    public function getHTMLALL($va) : string {

        $corps = '<div id="informationEntite">
                    <div class="buttonContainer">
                        <form id="insererUtensileFormButton"  method="post" action="?action=creat">
                        <button type="submit" class="btn btn-primary" id="btn_ajouter">Ajouter</button>
                        </form>
                    </div>
                    <div class="tableContainer">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">NOM Ingredient</th>
                                    <th scope="col">Type Ingredient</th>
                                    <th scope="col">stocke qte Ingredient</th>
                                    <th scope="col">stocke unites Ingredient</th>
                                    <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>';

        foreach ($va as $valeur){
            if ($valeur instanceof EntiteIngredient) {

                $corps.= '          <tr>
                                    <th scope="row">'. $valeur->getIId() .'</th>
                                    <td class="rowsInformation">'. $valeur->getINom() . '</td>
                                    <td class="rowsInformation">'. $valeur->getIType() . '</td>
                                    <td class="rowsInformation">'. $valeur->getIQteStockee() . '</td>
                                    <td class="rowsInformation">'. $valeur->getIUniteStockee() . '</td>
                                    
                                    <td class="td_buttons_actions"><a href="?action=update&i_id='.$valeur->getIId().'">
                                    <button type="button" class="btn btn-warning etapes-btn">Editer</button></a></td>
                                    <td class="td_buttons_actions">
                                    <a href="?action=delete&i_id='.$valeur->getIId().'">
                                    <button type="button" class="btn btn-danger">Supprimer</button></a></td>
                                </tr>';
            }
        }

        $corps.= '      </tbody>
                       </table>    
                    </div>
                </div> ';
        return $corps;
    }

    public function getHTMLInsert() : string {
        $corps = '<div class="insertContainer" id="insertContainer">
                    <form id="addUtensileForm"  method="post" action="CRUD_Ingredient.php">
                        <div class="form-group">
                            <label for="name" class="rowsInformation">Nom Ingredient</label>
                            <input type="text" class="form-control" id="name" name="nom" placeholder="Nome Ingredient">
                            <label for="name" class="rowsInformation">Type Ingredient</label>
                            <input type="text" class="form-control" id="name" name="type" placeholder="Type Ingredient">
                            <label for="name" class="rowsInformation">Quantite stocke</label>
                            <input type="number" class="form-control" id="name" name="Quantite" placeholder="Quantite Ingredient">
                            <label for="name" class="rowsInformation">unite</label>
                            <input type="text" class="form-control" id="name" name="unite" placeholder="ex:/g">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajout</button>
                    </form>
                </div>';

        return $corps;
    }

}