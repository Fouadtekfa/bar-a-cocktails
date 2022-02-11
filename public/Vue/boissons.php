<?php 

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
    <h1>Boissons</h1>
    <div class="arrow" id="retour">
    <img src="../images/retour.png" alt="retour" class="retour">
    </i>
    </div>
    <div class="tableContainer">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">col1</th>
                    <th scope="col">col2</th>
                    <th scope="col">col3</th>
                    <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    for($i = 0 ; $i <= 5 ; $i++) { ?>

                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-primary">Ajouter</button></td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-warning">Editer</button></td>
                            <td class="td_buttons_actions"><button type="button" class="btn btn-danger">Supprimer</button></td>
                        </tr>
                    
                        <?php } ?>
            </tbody>
        </table>    
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/boissons.js"></script>

</body>
</html>