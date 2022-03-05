<?php

namespace bar;
class vueCommandes {

public function getDebutHTML($titre = "Commandes", $lienRetour = "../../"): string{
    $res = '<!DOCTYPE html>
            <html lang="en">
            <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                    <link rel="stylesheet" href="../../css/style.css">
                    <link rel="stylesheet" href="../../css/cocktails.css">
                    <title>Cocktails</title>
                </head>
                 <h1>'.$titre.'</h1>
                    <div class="arrow" id="retour">
                    <a href="'.$lienRetour.'"><img src="../../images/retour.png" alt="retour" class="retour" ></a>
                    </i>
                    </div>
                <body>';
    return $res;
}

    public function getHTMLUpdate(array  $commandes) : string {
        $corps = "";

        $corps .=    '<div class="insertContainer" id="insertUpdateContainer">'.
            '<form id="updateCommandeForm"  method="get">'.
            '<div class="form-group">';
        foreach ($commandes as $col => $val) {
            if (is_array($val)) {
                $hide = "";
                if($col == 'com_id') $hide = 'hidden';
                $corps.='       <label for="name" class="rowsInformation" '.$hide.'>'.$val['titre'].'</label>
                                        <input type='.$val['type'].' class="form-control" '.$hide.'  id="com_id" name="'.$col.'" placeholder="numéro commande" value="'.$val['default'].'" >';

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
                        <form id="insererCommandeFormButton"  method="post" action="?action=create">
                        <button type="submit" class="btn btn-primary" id="btn_ajouter">Ajouter</button>
                        </form>
                    </div>
                    <div class="tableContainer">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Numéro table</th>
                                    <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>';

        foreach ($va as $valeur){
            if ($valeur instanceof EntiteCommande) {

                $corps.= '          <tr>
                                    <th scope="row">'. $valeur->getComId() .'</th>
                                    <td class="rowsInformation">'. $valeur->getComNumTable() . '</td>
                                     <td class="td_buttons_actions"><a href="?action=plus&com_id='.$valeur->getComId().'">
                                    <button type="button" class="btn">Voir la commande</button></a></td> 
                                    <td class="td_buttons_actions"><a href="?action=update&com_id='.$valeur->getComId().'">
                                    <button type="button" class="btn btn-warning etapes-btn">Editer</button></a></td>
                                    <td class="td_buttons_actions">
                                    <a href="?action=delete&com_id='.$valeur->getComId().'">
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
    public function getHTMLDetails( $boissons)  {
        $corps= '';
    foreach($boissons as $key => $value){
            //echo 'hol';

            echo '<br> id :'.$value['c_id'];
            echo '<br> nom : '.$value['nom'];
            echo '<br> prix : '.$value['prix'];
            echo '<br> qte : '.$value['nb'];
            echo '<br> id com : '.$value['nb'];
            echo '<br> table : '.$value['com_numTable'];
            $corps.='<div class="form-check form-check_Entitiy col-4">
                                <label class="form-check-label" for="b_qteBoisson">
                                        '.$value['nom'] .'
                                </label> <br>
                                <input type="number" class="form-control quantity" id="b_qteBoisson" name="checkBoissons[]" placeholder="'.$value['prix'].' euros" disabled>
                                </div>';

        }
            /*for($i = 0 ; $i <= count($comandeCocktail) ; $i++){
                echo 'hhh';
                echo $comandeCocktail[$i]['id'];
            }*/
        //echo var_dump($comandeCocktail['id'][0]);
        //foreach ($comandeCocktail as $col => $va) {
         //   echo $col;
        //}
        //$corps = "";
        /*$idCocktail = '';
        $corps .= '<div class="insertContainer" id="insertUpdateContainer">
                    <div class="form-group">';
        echo 'jiji';
        foreach ($comandeComplete as $val) {
            echo "hollaaa";
            $corps .= '<label for="name" class="rowsInformation">' . $val['c_nom'] . '</label>
                      <input  type="text" class="form-control"  name="nom" value="' . $val['c_nom'] . '" disabled>';
        }*/
        return $corps .= '</div></div>';
    }

    public function getHTMLInsert() : string {
        $corps = '<div class="insertContainer" id="insertContainer">
                    <form id="addUtensileForm"  method="get" action="./CRUD_commande.php">
                        <div class="form-group">
                            <label for="name" class="rowsInformation">Numéro commande</label>
                            <input type="text" class="form-control" id="name" name="com_numTable" placeholder="numéro de la table">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajout</button>
                    </form>
                </div>';

        return $corps;
    }

}