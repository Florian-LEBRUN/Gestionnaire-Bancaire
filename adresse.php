<?php
require_once('Class/Class.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['inscription_part2'])){
    $bdd= new PDO('mysql:host=localhost;dbname=banque;charset=utf8','root','');
    $proprioManager = new Gestionnaire_Proprietaire($bdd);
    $adresseManager=new Gestionnaire_Adresse($bdd);
    $adresse = new Adresse(['id'=>$_SESSION['proprietaire']->getId(), 'numero'=>$_POST['numero'], 'rue'=>$_POST['rue'], 'codePostal'=>$_POST['codePostal'], 'pays'=>$_POST['pays']]);
    $adresseManager->ajouter_adresse($adresse);
    $proprioManager->ajouter_proprietaire($_SESSION['proprietaire']);
    header('Location: soldeDeBase.php');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
<div id ="container">
        <form method="post">
            <h1>Inscription partie 2 adresse</h1>
            <label>Numero</label>
            <input type="text" placeholder="Numero" name="numero">
            <label>Rue</label>
            <input type="text" placeholder="Rue" name="rue">
            <label>Code Postal</label>
            <input type="text" placeholder="Code Postal" name="codePostal">
            <label>Pays</label>
            <input type="text" placeholder="Pays" name="pays">
            <input type="submit" value="inscription" id="submit" name="inscription_part2">
        </form>
    </div>
</body>
</html>