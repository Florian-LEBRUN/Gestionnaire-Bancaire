<?php
require_once('Class/Class.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['virement'])){
    header('Location: virement.php');
}
$bdd= new PDO('mysql:host=localhost;dbname=banque;charset=utf8','root','');
$accountManager=new Gestionnaire_Compte($bdd);
$_SESSION['soldeActuel']=$accountManager->afficher_compte($_SESSION['proprietaire']->getId())['solde'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
        </form>
    </div>
</body>
</html>