<?php
if (isset($_POST["s'inscrire"])){
    header('Location: inscription.php');
}
if (isset($_POST['seconnecter'])){
    header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id ="container">
        <form method='post'>
            <input type="submit" value="Inscription" id="submit" name="s'inscrire">
            <input type="submit" value="Connexion" id="submit" name="seconnecter">
        </form>
    </div>
</body>
</html>