<?php
class Transaction {
    private $id;
    private $montant;
    private $type;
    private $date;
    private $idUser;

    public function getId(){
        return $this->id;
    }

    public function getMontant(){
        return $this->montant;
    }

    public function getType(){
        return $this->type;
    }

    public function getDate(){
        return $this->date;
    }

    public function getIdUser(){
        return $this->idUser;
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

    public function setType($type){
        if(is_string($type)){
            $this->type=$type;
        }
    }

    public function setDate($date){
        if(is_string($date)){
            $this->date=$date;
        }
    }

    public function setIdUser($idUser){
        $idUser=(int)$idUser;
        if($idUser>0){
            $this->idUser=$idUser;
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
}

?>