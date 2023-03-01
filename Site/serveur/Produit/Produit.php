<?php
declare (strict_types=1);

class Produit {
    private $id_prod;
    private $nom_prod;
    private $categorie;
    private $modele;
    private $fabriquant;
    private $prix;
    private $qte_totale;
    private $qte_vendue;
    private $chemin_img;

    function __construct(string $id_prod, string $nom_prod, string $categorie, string $modele, string $fabriquant, float $prix, int $qte_totale, int $qte_vendue, string $chemin_img) {
        $this->id_prod = $id_prod;
        $this->nom_prod = $nom_prod;
        $this->categorie = $categorie;
        $this->modele = $modele;
        $this->fabriquant = $fabriquant;
        $this->prix = $prix;
        $this->qte_totale = $qte_totale;
        $this->qte_vendue = $qte_vendue;
        $this->chemin_img = $chemin_img;        
    }

    function getIdProd():string {
        return $this->id_prod;
    }
    function getNomProd():string {
        return $this->nom_prod;
    }
    function getCategorie():string {
        return $this->categorie;
    }
    function getModele():string {
        return $this->modele;
    }
    function getFabriquant():string {
        return $this->fabriquant;
    }
    function getPrix():float {
        return $this->prix;
    }
    function getQteTotale():int {
        return $this->qte_totale;
    }
    function getQteVendue():int {
        return $this->qte_vendue;
    }
    function getCheminImg():string {
        return $this->chemin_img;
    }


    function setIdProd($id_prod):void {
        $this->id_prod = $id_prod;
    }
    function setNomProd($nom_prod):void {
        $this->nom_prod = $nom_prod;
    }
    function setCategorie($categorie):void {
        $this->categorie = $categorie;
    }
    function setModele($modele):void {
        $this->modele = $modele;
    }
    function setFabriquant($fabriquant):void {
        $this->fabriquant = $fabriquant;
    }
    function setPrix($prix):void {
        $this->prix = $prix;
    }    
    function setQteTotale($qte_totale):void {
        $this->qte_totale = $qte_totale;
    }    
    function setQteVendue($qte_vendue):void {
        $this->qte_vendue = $qte_vendue;
    }    
    function setCheminImg($chemin_img):void {
        $this->chemin_img = $chemin_img;
    }  
          
}

?>