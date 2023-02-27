<?php
declare (strict_types=1);

class Membre {
    private $nom;
    private $prenom;
    private $email;
    private $sexe;
    private $daten;

    function __construct(string $nom, string $prenom, string $email, string $sexe, string $daten) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->sexe = $sexe;
        $this->daten = $daten;     
    }

    function getNom():string {
        return $this->nom;
    }
    function getPrenom():string {
        return $this->prenom;
    }
    function getEmail():string {
        return $this->email;
    }
    function getSexe():string {
        return $this->sexe;
    }
    function getDaten():string {
        return $this->daten;
    }

    function setNom($nom):void {
        $this->nom = $nom;
    }
    function setPrenom($prenom):void {
        $this->prenom = $prenom;
    }
    function setEmail($email):void {
        $this->email = $email;
    }
    function setSexe($sexe):void {
        $this->sexe = $sexe;
    }
    function setDaten($daten):void {
        $this->daten = $daten;
    }
          
}

?>