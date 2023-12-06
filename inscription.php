<?php
require_once('Class/Class.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['inscription'])) {
    $bdd= new PDO('mysql:host=localhost;dbname=banque;charset=utf8','root','');
    $accountManager=new Gestionnaire_Compte($bdd);
    $_SESSION['proprietaire']= new Proprietaire(['id'=>$accountManager->new_id(),'nom'=>$_POST['nom'],'prenom'=>$_POST["prenom"],
    'date_de_naissance'=>$_POST["date_de_naissance"],'tel'=>$_POST['tel'],'mail'=>$_POST['mail'],
   'identifiant'=>$_POST["identifiant"],'mdp'=>$_POST['mdp'], ]);
   echo $_SESSION['proprietaire']->getId();
   header("Location: adresse.php");
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
            <h1>Inscription</h1>
            <label>nom</label>
            <input type="text" placeholder="Nom" name="nom">
            <label>prenom</label>
            <input type="text" placeholder="Prenom" name="prenom">
            <label>date de naissance</label>
            <input type="date"  name="date_de_naissance">
            <label>téléphone</label>
            <input type="text" placeholder="téléphone" name="tel">
            <label>E-mail</label>
            <input type="text" placeholder="E-mail" name="mail">
            <label>identifiant</label>
            <input type="text" placeholder="identifiant" name="identifiant">
            <label>mot de passe</label>
            <input type="text" placeholder="mot de passe" name="mdp">
            <input type="submit" value="Poursuivre l'inscription" id="submit" name="inscription">
        </form>
    </div>
</body>
</html>