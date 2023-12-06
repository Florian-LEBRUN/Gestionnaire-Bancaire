<?php
class Proprietaire{
    private $id;
    private $nom;
    private $prenom;
    private $date_de_naissance;
    private $tel;
    private $mail;
    private $identifiant;
    private $mdp;
    
    public function __construct(array $data){
        $this ->hydrate($data);
    }

    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getDate_de_naissance(){
        return $this->date_de_naissance;
    }

    public function getTel(){
        return $this->tel;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getIdentifiant(){
        return $this->identifiant;
    }

    public function getMdp(){
        return $this->mdp;
    }

    public function setId($id){
        $id = (int)$id;
        if ($id>0) {
            $this->id = $id;
        }
    }

    public function setNom($nom){
        if (is_string($nom)){
            $this->nom = htmlspecialchars($nom);
        }
    }

    public function setPrenom($prenom){
        if (is_string($prenom)){
            $this->prenom=$prenom;
        }
    }

    public function setDate_de_naissance($date_de_naissance){
        if (is_string($date_de_naissance)){
            $this->date_de_naissance=$date_de_naissance;
        }
    }

    public function setTel($tel){
        $tel = (int)$tel;
        if ($tel >0){
            $this->tel=$tel;
        }
    }

    public function setMail($mail){
        if (is_string($mail)){
            $this->mail=$mail;
        }
    }

    public function setIdentifiant($identifiant){
        if (is_string($identifiant)){
            $this->identifiant=$identifiant;
        }
    }

    public function setMdp($mdp){
        if (is_string($mdp)){
            $this->mdp=$mdp;
        }
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

class Gestionnaire_Proprietaire{
    private $_bdd;

    public function __construct($bdd){
        $this->setBDD($bdd);
    }

    public function setBDD(PDO $bdd){
        $this->_bdd = $bdd;
    }

    public function ajouter_proprietaire(Proprietaire $proprietaire){
        $sql = "INSERT INTO proprietaire(id,nom, prenom, date_de_naissance,tel,mail,identifiant,mdp) values ('";
        $sql .= addslashes($proprietaire->getId())."','";
        $sql .= addslashes($proprietaire->getNom())."','";
        $sql .= addslashes($proprietaire->getPrenom())."','";
        $sql .= addslashes($proprietaire->getDate_de_naissance())."','";
        $sql .= addslashes($proprietaire->getTel())."','";
        $sql .= addslashes($proprietaire->getMail())."','";
        $sql .= addslashes($proprietaire->getIdentifiant())."','";
        $sql .= addslashes($proprietaire->getMdp())."')";
        $this->_bdd->exec($sql);
    }

    public function delete_proprietaire($id){
        $sql = "DELETE FROM proprietaire WHERE id=".$id;
        $request = $this->_bdd->query($sql);
        $request->fetch();
    }

    public function afficher_proprietaire($id){
        $sql = "SELECT * FROM proprietaire WHERE id=".$id;
        $proprietaire = ($this->_bdd->query($sql)->fetchAll(PDO::FETCH_ASSOC));
        $proprietaire = new Proprietaire($proprietaire[0]);
        return $proprietaire;
    }
}

?>