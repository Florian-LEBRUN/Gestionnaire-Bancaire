<?php
class Transaction {
    private $_id;
    private $_montant;
    private $_date;
    private $_emeteur;
    private $_recepteur;

    public function getId(){
        return $this->_id;
    }

    public function getMontant(){
        return $this->_montant;
    }

    public function getDate(){
        return $this->_date;
    }

    public function getEmeteur(){
        return $this->_emeteur;
    }

    public function getRecepteur(){
        return $this->_recepteur;
    }


    public function setId($id){
        $id=(int)$id;
        if($id>0){
            $this->_id=$id;
        }
    }

    public function setMontant($montant){
        $montant=(int)$montant;
        if($montant>0){
            $this->_montant=$montant;
        }
    }


    public function setDate($date){
        if(is_string($date)){
            $this->_date=$date;
        }
    }

    public function setEmeteur($emeteur){
        if(is_string($emeteur)){
            $this->_emeteur=$emeteur;
        }
    }

    public function setRecepteur($recepteur){
        if(is_string($recepteur)){
            $this->_recepteur=$recepteur;
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

    public function ajouter_transaction($montant,$date, $emeteur, $recepteur){
        $sql = "INSERT INTO transaction(montant, date, emeteur, recepteur) values ($montant,'$date' ,'$emeteur', '$recepteur')";
        $this->_bdd->exec($sql);
    }

    public function historiqueTrans($IBAN){
        $sql = "SELECT * From transaction WHERE emeteur='$IBAN' or recepteur='$IBAN' ORDER BY date DESC";
        
        $request = $this->_bdd->query($sql);
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $list[]= new transaction($data);
        }
        return $list;
    }
}

?>