<?php

namespace bar;
class vueEtapes {

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
                            <title>etapes</title>
                        </head>
                        <h1>ETAPES</h1>
                        <div class="arrow" id="retour">
                        <img src="../../images/retour.png" alt="retour" class="retour" onclick="history.back()">
                        </i>
                        </div>                
                    <body>';
        return $corps;
    }

    public function getHTMLUpdate(array  $etape) : string {
        $corps = "";

        $corps .=    '<div class="insertContainer" id="insertUpdateContainer">'.
            '<form id="updateUtensileForm"  method="get">'.
            '<div class="form-group">';
        foreach ($etape as $col => $val) {
            if (is_array($val)) {
                $hide = "";
                if(($col == 'c_id')||($col=='e_num')) $hide = 'hidden';
                $corps.='       <label for="name" class="rowsInformation" '.$hide.'>'.$val['titre'].'</label>
                                        <input type='.$val['type'].' class="form-control" '.$hide.'  id="e_num" name="'.$col.'" placeholder="" value="'.$val['default'].'" >';

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
                        <form id="insererUtensileFormButton"  method="post" action="?action=create">
                        <button type="submit" class="btn btn-primary" id="btn_ajouter">Ajouter</button>
                        </form>
                    </div>
                    <div class="tableContainer">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">etape numero</th>
                                    <th scope="col">etape numero</th>
                                    <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($va as $valeur){
            if ($valeur instanceof EntiteEtape) {
                $corps.= '          <tr>
                                    <th scope="row">'. $valeur->getCId() .'</th>
                                    <td class="rowsInformation">'. $valeur->getENum() . '</td>
                                      <td class="rowsInformation">'. $valeur->getEDesc() . '</td>
                                    <td class="td_buttons_actions"><a href="?action=create&u_id='.$valeur->getCId().'">
                                    <button type="button" class="btn btn-warning etapes-btn">Editer</button></a></td>
                                    <td class="td_buttons_actions">
                                    <a href="?action=suppression&c_id='.$valeur->getCId().'">
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
                    <form id="addUtensileForm"  method="get" action="./CRUD_etape.php">
                        <div class="form-group">
                            <label for="name" class="rowsInformation">ajouter une etape </label>
                            <input type="text" class="form-control" id="name" name="e_desc" placeholder="description de l etape ">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajout</button>
                    </form>
                </div>';

        return $corps;
    }

}