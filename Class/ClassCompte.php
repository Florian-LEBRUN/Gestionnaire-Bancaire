<?php
class Compte {
    private $id;
    private $solde;
    private $IBAN;

    public function __construct(array $data){
        $this->hydrate($data);
    }

    public function getId(){
        return $this->id;
    }

    public function getSolde(){
        return $this->solde;
    }

    public function getIBAN(){
        return $this->IBAN;
    }

    public function setId($id){
        $id=(int)$id;
        if ($id>0){
            $this->id=$id;
        }
    }

    public function setSolde($solde){
        $solde=(float)$solde;
        $this -> solde=$solde;
    }

    public function setIBAN($IBAN){
        $this->IBAN = $IBAN;
    }

    public function hydrate(array $data){
        foreach ($data as $key => $valeur){
            $methode = 'set'.ucfirst($key);
            if (method_exists($this,$methode)){
                $this->$methode($valeur);
            }
        }
    }
}

class Gestionnaire_Compte{
    private $_bdd;

    public function __construct($bdd){
        $this->setBDD($bdd);
    }
    
}

?>