<?php
require_once('classCompte.php');
require_once('classPropriétaire.php');
$bdd= new PDO('mysql:host=localhost;dbname=banque;charset=utf8','root','');
$accountManager=new Gestionnaire_Compte($bdd);
$account=new Compte(['id'=>"1",'IBAN'=>234343534,'solde'=>123]);
#$accountManager->ajouter_compte($account);
$proprio= new Proprietaire(['nom'=>"florian",'prenom'=>"Lebrun",
'date_de_naissance'=>"22/11/2003",'tel'=>"0677014633",'mail'=>"florian@gmail.com",
'identifiant'=>"florian",'mdp'=>"azerty"]);
$proprioManager = new Gestionnaire_Proprietaire($bdd);
#$proprioManager->ajouter_proprietaire($proprio);
/*if ($accountManager->connection_compte('florian','azerty')==True){
    echo 'connexion réussi';
} else {
    echo 'echec de la connexion';
}*/
#$account->setSolde(111);
#$accountManager->modifier_solde($account);
echo $accountManager->new_id();
$proprioManager->delete_proprietaire(0);

?>