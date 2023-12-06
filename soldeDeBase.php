<?php
require_once("Class/Class.php");
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['soldesub'])){
    $bdd= new PDO('mysql:host=localhost;dbname=banque;charset=utf8','root','');
    $accountManager=new Gestionnaire_Compte($bdd);
    $account=new Compte(['id'=>$_SESSION['proprietaire']->getId(),'IBAN'=>$accountManager->generateIBAN($_SESSION['proprietaire']->getId()),'solde'=>$_POST['solde']]);
    $accountManager->ajouter_compte($account);
    header('Location: consulter.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Définir le solde</title>
</head>
<body>
<div id ="container">
        <form method="post">
            <h1>Définir le solde</h1>
            <input type="int" placeholder="Solde" name="solde">
            <input type="submit" value="définir solde" id="submit" name="soldesub">
        </form>
    </div>
</body>
</html>