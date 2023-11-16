<?php
require_once('classCompte.php');
$bdd= new PDO('mysql:host=localhost;dbname=banque;charset=utf8','root','');
$accountManager=new Gestionnaire_Compte($bdd);
$account=new Compte(['id'=>"1",'IBAN'=>234343534,'solde'=>123]);
$accountManager->ajouter_compte($account);



?>