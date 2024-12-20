<?php

require_once('Class/Class.php');
$bdd= new PDO('mysql:host=localhost;dbname=banque;charset=utf8','root','');
$accountManager=new Gestionnaire_Compte($bdd);
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['virement'])){
    header('Location: virement.php');
}
if (isset($_POST['historique'])){
    header('Location: historique.php');
}
if(isset($_POST['cloture'])){
    $accountManager->cloturerCompte($_SESSION['proprietaire']->getId());
    header('Location: acceuil.php');
}

$_SESSION['soldeActuel']=$accountManager->afficher_compte($_SESSION['proprietaire']->getId())['solde'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id ="container">
        <form method='post'>
            <h2>numero de compte : <?php echo $_SESSION['proprietaire']->getId();?></h2>
            <h2>iban : <?php echo$accountManager->afficher_compte($_SESSION['proprietaire']->getId())['IBAN'];?></h2>
            <h1>Solde : <?php echo$accountManager->afficher_compte($_SESSION['proprietaire']->getId())['solde'];?></h1>
            <input type="submit" value="faire un virement" id="submit" name="virement">
            <input type="submit" value="consulter historique" id="submit" name="historique">
            <input type="submit" value="Cloturer le compte" id="submit" name="cloture">
        </form>
    </div>
</body>
</html>