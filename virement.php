<?php
require_once('Class/Class.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['virement'])){
    $bdd= new PDO('mysql:host=localhost;dbname=banque;charset=utf8','root','');
    $accountManager=new Gestionnaire_Compte($bdd);
    $transactionManager=new Gestionnaire_Transaction($bdd);
    $ibanEmet=$accountManager->recuperer_iban($_SESSION['proprietaire']->getId())['IBAN'];
    var_dump ($_POST['IBAN']);
    var_dump($accountManager->recuperer_iban($_SESSION['proprietaire']->getId())['IBAN']);
    $transaction = new Transaction(['montant'=>$_POST['montant'], 'date'=>date('d/m/Y'),
    'emeteur'=>$accountManager->recuperer_iban($_SESSION['proprietaire']->getId())['IBAN'],
    'recepteur'=>$_POST['IBAN']]);
    var_dump ($accountManager->recuperer_solde($ibanEmet)['solde']-$_POST['montant']);
    $transactionManager->ajouter_transaction($_POST['montant'], date('d/m/Y'),$accountManager->recuperer_iban($_SESSION['proprietaire']->getId())['IBAN'], $_POST['IBAN'] );
    $accountManager->modifier_solde($ibanEmet,$accountManager->recuperer_solde($ibanEmet)['solde']-$_POST['montant']);
    try {
        $account = $accountManager->afficher_compteByIBAN($_POST['IBAN']);
        var_dump($account);
    } catch (Exception $e){
        header('Location: virementOk.php?id=2');
    }
    echo $accountManager->recuperer_solde($_POST['IBAN']);
    $accountManager->modifier_solde($_POST['IBAN'],$accountManager->recuperer_solde($_POST['IBAN'])['solde']+$_POST['montant']);
    echo $accountManager->recuperer_solde($_POST['IBAN']);
    header('Location: virementOk.php?id=1');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virement</title>
</head>
<body>
<div id ="container">
        <form method='post'>
            <h1>Faire un virement</h1>
            <label>Destinataire</label>
            <input type="text" placeholder="IBAN du destinataire" name="IBAN">
            <label>Montant à créditer</label>
            <input type="int" placeholder="Montant" name="montant">
            <input type="submit" value="Confirmer le virement" id="submit" name="virement">
        </form>
    </div>
</body>
</html>