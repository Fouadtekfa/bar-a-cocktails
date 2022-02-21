<?php

namespace bar;
class vueUtensiles {

    public function getDebutHTML() : string {
        $corps =    '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                            <link rel="stylesheet" href="../../css/style.css">
                            <link rel="stylesheet" href="../../css/utensiles.css">
                            <title>Cocktail</title>
                        </head>
                    <body>';
        return $corps;
    }

    public function getHTMLUpdate(EntiteUtensile  $utensile) : string {
        $corps =    '<div class="insertContainer" id="insertUpdateContainer">'.
                        '<form id="updateUtensileForm"  method="get" action="../Controlleur/CRUD/CRUD_Utensiles.php" name="action" >'.
                            '<input type="text" name="action" value="modifierUtensile" hidden>
                            <div class="form-group">
                                <input type="text" class="form-control" id="u_id" name="u_id" hidden placeholder="Nom de lutensile" value="'.$utensile->getUId().'" >
                                    <label for="name" class="rowsInformation">Nom de lutensile</label>
                                <input type="text" class="form-control" id="u_nom" name="u_nom" placeholder="Nom de lutensile" value="'.$utensile->getUNom().'">
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>';
        return $corps;
    }

    public function getHTMLTable($va) : string {
        $corps = '<div id="informationEntite">
                    <div class="buttonContainer">
                        <button type="button" class="btn btn-primary" id="btn_ajouter">Ajouter</button>
                    </div>
                    <div class="tableContainer">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>';
    
        foreach ($va as $valeur){  
            $corps.= '          <tr>
                                    <th scope="row">'. $valeur->getUId() .'</th>
                                    <td class="rowsInformation">'. $valeur->getUNom() . '</input></td>
                                    <td class="td_buttons_actions"><a href="?u_id='.$valeur->getUId().'">
                                    <button type="button" class="btn btn-warning etapes-btn">Editer</button></a></td>
                                    <td class="td_buttons_actions">
                                    <a href="../Controlleur//CRUD/CRUD_Utensiles.php?action=suppression&u_id='.$valeur->getUId().'">
                                    <button type="button" class="btn btn-danger">Supprimer</button></a></td>
                                </tr>';
        }
        
        $corps.= '      </tbody>
                       </table>    
                    </div>
                </div> ';
        return $corps;
    }

}