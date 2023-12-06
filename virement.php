<?php
require_once('Class/Class.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['virement'])){
    $bdd= new PDO('mysql:host=localhost;dbname=banque;charset=utf8','root','');
    $accountManager=new Gestionnaire_Compte($bdd);
    $transactionManager=new Gestionnaire_Transaction($bdd);
    $transaction = new Transaction(['montant'=>$_POST['montant'], 'date'=>date('d/m/Y'),
    'emeteur'=>$accountManager->recuperer_iban($_SESSION['proprietaire']->getId()),
    'recepteur'=>$_POST['IBAN']]);
    $transactionManager->ajouter_transaction($transaction);
    $account = new Compte(['id'=>$_SESSION['proprietaire']->getId(),'IBAN'=>$accountManager->recuperer_iban($_SESSION['proprietaire']->getId()),
    'solde'=>$_SESSION['soldeActuel']-$_POST['montant']]);
    $accountManager->modifier_solde($account);
    try {
        $account = $accountManager->afficher_compteByIBAN($_POST['IBAN']);
    } catch (Exception $e){
        header('Location: virementOk.php?id=2');
    }
    $account = new Compte(['id'=>$account['id'],'IBAN'=>$account['IBAN'],
    'solde'=>$account['solde']+$_POST['montant']]);
    $accountManager->modifier_solde($account);
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