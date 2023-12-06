<?php
$bdd= new PDO('mysql:host=localhost;dbname=banque;charset=utf8','root','');
require_once('Class/Class.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['connection'])){
    $accountManager=new Gestionnaire_Compte($bdd);
    if ($accountManager->connection_compte($_POST['identifiant'],$_POST["mdp"])==true){
        $proprioManager = new Gestionnaire_Proprietaire($bdd);
        $_SESSION['proprietaire'] = $proprioManager->afficher_proprietaire($_SESSION['id']);
        //header("Location: consulter.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>connection</title>
</head>
<body>
<div id ="container">
        <form method="post">
            <h1>Connection</h1>
            <label>identifiant</label>
            <input type="text" placeholder="identifiant" name="identifiant">
            <label>mot de passe</label>
            <input type="text" placeholder="mot de passe" name="mdp">
            <input type="submit" value="se connecter" id="submit" name="connection">
        </form>
    </div>
</body>
</html>