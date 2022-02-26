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
                        <form id="insererBoissonFormButton"  method="post" action="?action=inserer">
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
                $alcool = 'oui';
                if($valeur->getBEstAlcoolise() == '0'){
                    $alcool = 'non';
                }
                $corps.= '          <tr>
                                    <th scope="row">'. $valeur->getBId() .'</th>
                                    <td class="rowsInformation">'. $valeur->getBNom() . '</input></td>
                                    <td class="rowsInformation">'. $valeur->getBType() . '</input></td>
                                    <td class="rowsInformation">'. $alcool . '</input></td>
                                    <td class="rowsInformation">'. $valeur->getBQteStockee() . '</input></td>

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
                    <form id="addBoissonForm"  method="get" action="CRUD_boissons.php">
                        <div class="form-group">
                            <label for="name" class="rowsInformation">Nom de la boisson</label>
                            <input type="text" class="form-control" id="name" name="nom" placeholder="Nom de la boisson">
                            <label for="name" class="rowsInformation">Type de la boisson</label>
                            <select type="text" id="b_type" name="b_type" class="form-control" >
                                <option value="Eau">Eau</option>
                                <option value="Jus">Jus</option>
                                <option value="Alcool">Alcool</option>
                                <option value="Liqueur">Liqueur</option>
                                <option value="Sirop">Sirop</option>
                                <option value="Lait">Lait</option>
                                <option value="Soda">Soda</option>
                            </select>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="1" checked/>
                              <label class="form-check-label" for="flexCheckChecked">Est Alcoolise</label>
                            </div>
                            <label for="b_qteStockee" class="rowsInformation">Quantité stocké</label>
                            <input type="number" class="form-control" id="b_qteStockee" name="b_qteStockee" placeholder="Quantité">
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Ajout</button>
                    </form>
                </div>';

        return $corps;
    }

}