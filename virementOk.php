<?php
if (isset($_POST['retour'])){
    header('Location: consulter.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    


<?php
if ($_GET['id']==1){
    ?>
<div id ="container">
        <form method="post">
            <h1>Le virement à bien été effectuer</h1>
            <input type="submit" value="Consulter son solde" id="submit" name="retour">
        </form>
    </div>
    <?php
}
if ($_GET['id']==2){
    ?>
<div id ="container">
        <form method="post">
            <h1>Le virement à bien été effectuer à une personne d'une autre banque</h1>
            <input type="submit" value="Consulter son solde" id="submit" name="retour">
        </form>
    </div>
    <?php
}
?>


</body>
</html>