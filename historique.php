<link rel="stylesheet" type="text/css" href="test2.css">
<table>
<tr>
        <th>Montant</th>
        <th>Date</th>
        <th>Emeteur</th>
        <th>Recepteur</th>
    </tr>
<?php
require_once('Class/Class.php');
if (!isset($_SESSION)) {
    session_start();
}
$bdd = new PDO('mysql:host=localhost;dbname=banque','root','');
$transactionManager=new Gestionnaire_Transaction($bdd);
$accountManager=new Gestionnaire_Compte($bdd);

$donnees = $transactionManager->historiqueTrans($accountManager->recuperer_iban($_SESSION['proprietaire']->getId())['IBAN']);

for ($i = 0; $i < count($donnees); $i++) {
            ?>
                <tr>
                    <th><?php echo $donnees[$i]->getMontant();?></th>
                    <th><?php echo $donnees[$i]->getDate();?></th>
                    <th><?php echo $donnees[$i]->getEmeteur();?></th>
                    <th><?php echo $donnees[$i]->getRecepteur();?></th>
                </tr>
<?php
}
?></table><?php
?>