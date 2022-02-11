<?php
require_once "../imports.php";
require_once "../Modele/EntiteUtensile.php";
$myPDO = $_ENV['myPdo'];
$myPDO->setNomTable('Utensile');
$myPDO->initPDOS_selectAll();
$va =  $myPDO->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cocktails.css">
    <title>Cocktail</title>
</head>
<body>
    <h1>Utensiles</h1>
    <div class="arrow" id="retour">
    <img src="../images/retour.png" alt="retour" class="retour">
    </i>
    </div>

    <div id="informationEntite">
    <button type="button" class="btn btn-primary" id="btn_ajouter">Ajouter</button>
    <div class="tableContainer">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom</th>
                    <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($va as $valeur){  ?>
                        <tr>
                            <th scope="row"><?php echo $valeur->getUId() ?></th>
                            <td><?php echo $valeur->getUNom() ?></td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-warning">Editer</button></td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-danger">Supprimer</button></td>
                        </tr>
                    
                        <?php } ?>
            </tbody>
        </table>    
    </div>
    </div>

    <div class="insertContainer" style="display: none" id="insertContainer">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/utensiles.js"></script>

</body>
</html>