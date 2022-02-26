<?php

namespace bar;
class vueBoissons {

    public function getDebutHTML() : string {
        $corps =    '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                            <link rel="stylesheet" href="../../css/style.css">
                            <link rel="stylesheet" href="../../css/boissons.css">
                            <title>Cocktail</title>
                        </head>
                        <h1>Boissons</h1>
                        <div class="arrow" id="retour">
                        <img src="../../images/retour.png" alt="retour" class="retour" onclick="history.back()">
                        </i>
                        </div>                
                    <body>';
        return $corps;
    }

    public function getHTMLUpdate(array  $boisson) : string {
        $corps = "";

        $corps .=    '<div class="insertContainer" id="insertUpdateContainer">'.
            '<form id="updateBoissonForm"  method="get" name="action" >'.
            '<input type="text" name="action" value="modifier" hidden>
                                    <div class="form-group">';
        foreach ($boisson as $col => $val) {
            if (is_array($val)) {
                $hide = "";
                if($col == 'b_id') $hide = 'hidden';
                $corps.='       <label for="name" class="rowsInformation" '.$hide.'>'.$val['titre'].'</label>
                                        <input type='.$val['type'].' class="form-control" '.$hide.'  id="b_id" name="'.$col.'" placeholder="Nom de la boisson" value="'.$val['default'].'" >';

                //<input type="text" class="form-control" id="u_nom" name="u_nom" placeholder="Nom de lutensile" value="'.$val['default'].'">
            }
        }
        $corps.='            </div>
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </form>
                            </div>';

        return $corps;
    }

    public function getHTMLTable($va) : string {
        $corps = '<div id="informationEntite">
                    <div class="buttonContainer">
                        <form id="insererBoissonFormButton"  method="post" action="?action=insererBoisson">
                        <button type="submit" class="btn btn-primary" id="btn_ajouter">Ajouter</button>
                        </form>
                    </div>
                    <div class="tableContainer">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Avec ou sans Alcool</th>
                                    <th scope="col">Quantité stockee</th>

                                    <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>';

        foreach ($va as $valeur){
            if ($valeur instanceof EntiteBoisson) {

                $corps.= '          <tr>
                                    <th scope="row">'. $valeur->getBId() .'</th>
                                    <td class="rowsInformation">'. $valeur->getBNom() . '</input></td>
                                    <td class="td_buttons_actions"><a href="?action=modifierBoisson&b_id='.$valeur->getBId().'">
                                    <button type="button" class="btn btn-warning etapes-btn">Editer</button></a></td>
                                    <td class="td_buttons_actions">
                                    <a href="?action=suppression&b_id='.$valeur->getBId().'">
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
                    <form id="addBoissonForm"  method="get" action="CRUD_boissons.php" name="action" value="2" >
                        <input type="text" name="action" value="insererBoisson" hidden>
                        <div class="form-group">
                            <label for="name" class="rowsInformation">Nom de la boisson</label>
                            <input type="text" class="form-control" id="name" name="nom" placeholder="Nom de la boisson">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajout</button>
                    </form>
                </div>';

        return $corps;
    }

}