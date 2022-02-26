<?php

namespace bar;

class VueCocktail {

    public function getDebutHTML(): string{
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
                    <a href="../../"><img src="../../images/retour.png" alt="retour" class="retour" ></a>
                    </i>
                    </div>
                <body>';
        return $res;
    }
    
    public function getHTMLUpdate(array  $cocktaile, $boissons, $lienCockBoisson) : string {
        $corps = "";
        $idCocktail = '';
        $corps .=  '<div class="insertContainer" id="insertUpdateContainer">
                    <form id="updateCocktailForm"  method="post" action="./CRUD_Cocktails.php" >
                    <div class="form-group">';

        foreach ($cocktaile as $col => $val) {
        if (is_array($val)) {
                $hide = "c_id";
                if($col == 'c_id') {
                    $idCocktail = $val['default'];
                    $hide = 'hidden';
                }
                if($val['balise'] == "select") {
                    $selectedSD = $selectedLD = $selectedAD = '';
                    if($val['default'] == 'SD') $selectedSD = "selected";
                    if($val['default'] == 'LD') $selectedLD = "selected";
                    if($val['default'] == 'AD') $selectedAD = "selected";

                    $corps.='<label for="name" class="rowsInformation" '.$hide.'>'.$val['titre'].'</label>
                            <'.$val['balise'].'  type='.$val['type'].' class="form-control" '.$hide.'  name="'.$col.'" value="'.$val['default'].'" >
                                    <option value="SD" '.$selectedSD.'>SD</option>
                                    <option value="LD" '.$selectedLD.'>LD</option>
                                    <option value="AD" '.$selectedAD.'>AD</option> 
                                </select>';
                } else {
                    $corps.='       <label for="name" class="rowsInformation" '.$hide.'>'.$val['titre'].'</label>
        
                                            <'.$val['balise'].'  type='.$val['type'].' class="form-control" '.$hide.'  name="'.$col.'" value="'.$val['default'].'" >';

                }

        }
        }

        $corps.='<label for="boissons">Boissons Utilisées</label>';
        $corps .= '<div class="selectionLiaison"> ';
                for($i = 0; $i < count($boissons) ; $i++){
                    $qteBoisson = '';
                    for($j = 0; $j < count($lienCockBoisson) ; $j++){
                        if($boissons[$i]->getBId() == $lienCockBoisson[$j]->getBId())
                            $qteBoisson =  $lienCockBoisson[$j]->getQteBoisson();    
                    }
                    
                    $corps.='<div class="form-check form-check_Entitiy col-4">   
                            <label class="form-check-label" for="b_qteBoisson">
                                    '.$boissons[$i]->getBNom() .'
                            </label> <br>
                            <input  type="number" class="form-control" hidden  name="checkBoissonsId[]" value="'.$boissons[$i]->getBId().'" >
                            <input type="number" class="form-control quantity" id="b_qteBoisson" name="checkBoissons[]" value="'.$qteBoisson.'" placeholder="'.$boissons[$i]->getBNom().'">
                            </div>';
                }
        $corps.='            </div>
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                    </form>
                                </div>';

        return $corps;
    }

    public function getHTMLDetails(array  $cocktaile, $boissons, $lienCockBoisson) : string {
        $corps = "";
        $idCocktail = '';
        $corps .=  '<div class="insertContainer" id="insertUpdateContainer">
                    <div class="form-group">';

        foreach ($cocktaile as $col => $val) {
            if (is_array($val)) {
                    $hide = "c_id";
                    if($col == 'c_id') {
                        $hide = 'hidden';
                    }
                    
                    $corps.='<label for="name" class="rowsInformation" '.$hide.'>'.$val['titre'].'</label>
                            <input  type='.$val['type'].' class="form-control" '.$hide.'  name="'.$col.'" value="'.$val['default'].'" disabled>';
            }   
        }

        $corps.='<label for="boissons">Boissons Utilisées</label>';
        $corps .= '<div class="selectionLiaison"> ';
                for($i = 0; $i < count($boissons) ; $i++){
                    $qteBoisson = '';
                    for($j = 0; $j < count($lienCockBoisson) ; $j++){
                        if($boissons[$i]->getBId() == $lienCockBoisson[$j]->getBId())
                            $qteBoisson =  $lienCockBoisson[$j]->getQteBoisson();    
                    }
                    if($qteBoisson > 0){
                        $corps.='<div class="form-check form-check_Entitiy col-4">   
                            <label class="form-check-label" for="b_qteBoisson">
                                    '.$boissons[$i]->getBNom() .'
                            </label> <br>
                            <input  type="number" class="form-control" hidden  name="checkBoissonsId[]" value="'.$boissons[$i]->getBId().'" disabled >
                            <input type="number" class="form-control quantity" id="b_qteBoisson" name="checkBoissons[]" placeholder="'.$qteBoisson.' ml" disabled>
                            </div>';
                    }
                    
                }
        $corps.='            </div>
                                </div>';

        return $corps;
    }

    public function getHTMLAll($va) : string {
        $res=' <div class="buttonContainer">
                    <form id="insererCocktailFormButton"  method="post" action="?action=create">
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
                                <th scope="col">Details</th>
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
                                        <td><a href="?action=details&c_id='.$valeur->getCId().'">Voir plus...</a></td>
                                        <form id="insererUtensileFormButton"  method="post" action="../CRUD/CRUD_etape.php?c_id='.$valeur->getCId().'">
                                            <td class="td_buttons_actions"><button type="submit" class="btn btn-primary etapes-btn">Etapes</button></td>
                                        </form>
                                        <td class="td_buttons_actions"><a href="?action=update&c_id='.$valeur->getCId().'">
                                        <button type="button" class="btn btn-warning etapes-btn">Editer</button></a></td>
                                        <td class="td_buttons_actions">
                                        <a href="?action=delete&c_id='.$valeur->getCId().'">
                                        <button type="button" class="btn btn-danger">Supprimer</button></a></td>
                                    </tr> ';
                            }
        $res .='       </tbody>
                 </table>    
               </div>
            </div>
        ';
        return $res;
    }

    public function getHTMLInsert($boissons) : string {
        $res='<div class="insertContainer"  id="insertContainer">
                <form id="addUtensileForm"  method="post" action="./CRUD_Cocktails.php" >
                    <div class="form-group">
                        <label for="name">Nom de Cocktail </label>
                        <input type="text" class="form-control" id="name" name="nom" placeholder="Nom de Cocktail">
                        <label for="cat">catégorie de Cocktail</label>
                        <select type="text" id="cat" name="cat" class="form-control">
                            <option value="SD">SD</option>
                            <option value="LD">LD</option>
                            <option value="AD">AD</option>
                        </select>
                        <label for="prix">Prix de Cocktail </label>
                        <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix de Cocktail">
                        <label for="boissons">Boissons Utilisées</label>
                        <div class="selectionLiaison"> ';
                        foreach($boissons as $boisson){
                        
                            $res.='<div class="form-check form-check_Entitiy col-4">   
                                <label class="form-check-label" for="b_qteBoisson">
                                        '.$boisson->getBNom() .'
                                </label> <br>
                                <input  type="number" class="form-control" hidden  name="checkBoissonsId[]" value="'.$boisson->getBId().'" >
                                <input type="number" class="form-control quantity" id="b_qteBoisson" name="checkBoissons[]" placeholder="'.$boisson->getBNom().'">
                                </div>';
                            }
                    
                            $res.='     </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ajout</button>
                                       </form>
                                    </div>';
        return $res;
    }


}

?>

