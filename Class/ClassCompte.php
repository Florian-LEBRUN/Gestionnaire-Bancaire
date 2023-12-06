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

    public function setBDD(PDO $bdd){
        $this->_bdd=$bdd;
    }

    public function ajouter_compte(Compte $compte){
        $sql = "INSERT INTO compte(id, IBAN, Solde) values ('";
        $sql .= addslashes($compte->getId())."','";
        $sql .= addslashes($compte->getIBAN())."','";
        $sql .= addslashes($compte->getSolde())."')";
        $this->_bdd->exec($sql);
    }
    
    public function connection_compte($id,$mdp){
        $sql = "SELECT * from proprietaire WHERE identifiant='".$id."' and mdp='".$mdp."';";
        echo $sql;
        $reponse = $this->_bdd->query($sql);
        
        if ($reponse->rowCount()==0){
            return false;
        } else {
            $reponse=$reponse->fetchAll(PDO::FETCH_ASSOC);
            $reponse= $reponse[0];
            var_dump($reponse);
            //$_SESSION['id'] = $reponse['id'];
            return True;
        }
    }

    public function modifier_solde(Compte $compte){
        $id=$compte->getId();
        $IBAN=$compte->getIBAN();
        $solde=$compte->getSolde();
        $sql ="UPDATE compte SET solde='".$solde."',";
        $sql.= "IBAN='".$IBAN."' ";
        $sql.= "WHERE id=".$id;
        $request = $this->_bdd->query($sql);
    }

    public function new_id(){
        $continuer = True;
        while ($continuer == True){
            $newID=rand(1000000000,9999999999);
            $sql = "SELECT * FROM compte WHERE id=".$newID;
            $reponse = $this->_bdd->query($sql);
            if ($reponse->rowCount()==0){
                $continuer = false;
            }
        }
        return $newID;
    }

    public function afficher_compte($id){
        $sql = "SELECT * FROM compte WHERE id=".$id;
        $solde = $this->_bdd->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        var_dump($solde);
        return $solde;
    }

    public function generateIBAN($id) {
        $countryCode = "FR";
        if (!preg_match('/^[A-Z]{2}$/', $countryCode)) {
            throw new Exception("Invalid country code.");
        }
        $iban = $countryCode . '00' . $id;
        return $iban;
    }
}

?>