<?php
class Transaction {
    private $id;
    private $montant;
    private $date;
    private $emeteur;
    private $recepteur;

    public function getId(){
        return $this->id;
    }

    public function getMontant(){
        return $this->montant;
    }

    public function getDate(){
        return $this->date;
    }

    public function getEmeteur(){
        return $this->emeteur;
    }

    public function getRecepteur(){
        return $this->recepteur;
    }


    public function setId($id){
        $id=(int)$id;
        if($id>0){
            $this->id=$id;
        }
    }

    public function setMontant($montant){
        $montant=(int)$montant;
        if($montant>0){
            $this->montant=$montant;
        }
    }


    public function setDate($date){
        if(is_string($date)){
            $this->date=$date;
        }
    }

    public function setEmeteur($emeteur){
        $emeteur = (int)$emeteur;
        if($emeteur>0){
            $this->emeteur=$emeteur;
        }
    }

    public function setRecepteur($recepteur){
        $recepteur = (int)$recepteur;
        if($recepteur>0){
            $this->recepteur=$recepteur;
        }
    }


    public function __construct(array $data){
        $this->hydrate($data);
    }

    public function hydrate(array $data){
        foreach($data as $key => $valeur){
            $methode = 'set'.ucfirst($key);
            if (method_exists($this,$methode)){
                $this->$methode($valeur);
            }
        }
    }
}

class Gestionnaire_Transaction {
    private $_bdd;

    public function __construct($bdd){
        $this->setBDD($bdd);
    }

    public function setBDD(PDO $bdd){
        $this->_bdd=$bdd;
    }

    public function ajouter_transaction(Transaction $transaction){
        $sql = "INSERT INTO transaction(id, montant, date, emeteur, recepteur) values ('";
        $sql .= addslashes($transaction->getId())."','";
        $sql .= addslashes($transaction->getMontant())."','";
        $sql .= addslashes($transaction->getDate())."','";
        $sql .= addslashes($transaction->getEmeteur())."','";
        $sql .= addslashes($transaction->getRecepteur())."')";
        $this->_bdd->exec($sql);
    }
}

?>