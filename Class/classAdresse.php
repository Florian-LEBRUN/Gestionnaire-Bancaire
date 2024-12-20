<?php
class Adresse {
    private $id;
    private $numero;
    private $rue;
    private $codePostal;
    private $pays;

    public function getId(){
        return $this->id;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function getRue(){
        return $this->rue;
    }

    public function getCodePostal(){
        return $this->codePostal;
    }

    public function getPays(){
        return $this->pays;
    }

    public function setId($id){
        $id = (int)$id;
        if ($id>0){
            $this->id=$id;
        }
    }

    public function setNumero($numero){
        $numero = (int)$numero;
        if ($numero>0){
            $this->numero=$numero;
        }
    }

    public function setRue($rue){
        if(is_string($rue)){
            $this->rue=htmlspecialchars($rue);
        }
    }

    public function setCodePostal($codePostal){
        $codePostal=(int)$codePostal;
        if ($codePostal>0){
            $this->codePostal=$codePostal;
        }
    }

    public function setPays($pays){
        if (is_string($pays)){
            $this->pays=htmlspecialchars($pays);
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

class Gestionnaire_Adresse {
    private $_bdd;

    public function __construct($bdd){
        $this->setBDD($bdd);
    }

    public function setBDD(PDO $bdd){
        $this->_bdd=$bdd;
    }

    public function ajouter_adresse(Adresse $adresse){
        $sql = "INSERT INTO adresse (id, numero, rue, codePostal, pays) values ('";
        $sql .= addslashes($adresse->getId())."','";
        $sql .= addslashes($adresse->getNumero())."','";
        $sql .= addslashes($adresse->getRue())."','";
        $sql .= addslashes($adresse->getCodePostal())."','";
        $sql .= addslashes($adresse->getPays())."')";
        $this->_bdd->exec($sql);
    }

    public function delete_adresse($id){
        $sql = "DELETE FROM adresse WHERE id=".$id;
        $request = $this->_bdd->query($sql);
        $request->fetch();
    }
}

?>