<?php
declare (strict_types=1);

require_once(__DIR__ . "./../ressources/Connexion.php");
require_once("Produit.php");

class DaoProduit {
    private static $daoProduit = null;
    private $connexion = null;
    private $reponse=array();
	
    private function __construct() {}
    
	static function getDaoProduit():DaoProduit {
		if(self::$daoProduit == null) {
			self::$daoProduit = new DaoProduit();  
		}
		return self::$daoProduit;
	}

    function readAll():string {
        $this->connexion = Connexion::getConnexion();
        $requete="SELECT * FROM produits";
        try {
            $stmt = $this->connexion->prepare($requete);
            $stmt->execute();
            $resultat = $stmt->get_result();
            $this->reponse['listeProduits'] = array();
            while($ligne = mysqli_fetch_array($resultat)) {
                $this->reponse['listeProduits'][] = $ligne;
            }
            $this->reponse['OK'] = true;
        }catch(Exception $e) { 
            $this->reponse['message'] = "Server-side error: " . $e;
            $this->reponse['OK'] = false;
        }finally {
            Connexion::unsetConnexion();
            return json_encode($this->reponse);
        }
    }

    function readSome(string $condition, $searchTerm = null):string {
        $this->connexion = Connexion::getConnexion();
        $requete="SELECT * FROM produits " . $condition;
        if(isset($searchTerm)) {
            $searchTerm = "%" . $this->connexion->real_escape_string($searchTerm) . "%";
            $stmt = $this->connexion->prepare($requete);
            $stmt->bind_param("s", $searchTerm);
        }else {
            $stmt = $this->connexion->prepare($requete);
        }
        try {
            $stmt->execute();
            $resultat = $stmt->get_result();
            $this->reponse['listeProduits'] = array();
            while($ligne = mysqli_fetch_array($resultat)) {
                $this->reponse['listeProduits'][] = $ligne;
            }
            $this->reponse['OK'] = true;
        }catch(Exception $e) { 
            $this->reponse['message'] = "Server-side error: " . $e;
            $this->reponse['OK'] = false;
        }finally {
            Connexion::unsetConnexion();
            return json_encode($this->reponse);
        }
    }

    function read(int $id_prod):string {
        $this->connexion = Connexion::getConnexion();
        $requete="SELECT * FROM produits WHERE id_prod=?";
        try {
            $stmt = $this->connexion->prepare($requete);
            $stmt->bind_param("s", $id_prod);
            $stmt->execute();
            $resultat = $stmt->get_result();
            $propsTableau = "";
            if($resultat->num_rows > 0) {
                $propsTableau = $resultat->fetch_assoc();
            }
        }catch(Exception $e) { 
            //
        }finally {
            Connexion::unsetConnexion();
            return json_encode($propsTableau);
        }
    }
	
	function create(Produit $produit):string {
        $this->connexion = Connexion::getConnexion();    
        $requete = "INSERT INTO produits VALUES(?,?,?,?,?,?,?,?,?)";
        try {
            $donnees = [
                $produit->getIdProd(),
                $produit->getNomProd(),
                $produit->getCategorie(),
                $produit->getModele(),
                $produit->getFabriquant(),
                $produit->getPrix(),
                $produit->getQteTotale(),
                $produit->getQteVendue(),
                $produit->getCheminImg()
            ];        
            $stmt = $this->connexion->prepare($requete);
            $stmt->bind_param("sssssdiis", $donnees[0], $donnees[1], $donnees[2], $donnees[3], $donnees[4], $donnees[5], $donnees[6], $donnees[7], $donnees[8]);
            $stmt->execute();
            $this->reponse['message'] = "Produit " . $donnees[0] . " enregistre";
            $this->reponse['OK'] = true;
        }catch(Exception $e) {
            $this->reponse['message'] = "Server-side error: " . $e;
            $this->reponse['OK'] = false;
        }finally {
            Connexion::unsetConnexion();
            return json_encode($this->reponse);
        }
    }

    function update(Produit $produit):string {
        $this->connexion = Connexion::getConnexion();
        $requete = "UPDATE produits SET nom_prod=?, categorie=?, modele=?, fabriquant=?, prix=?, qte_totale=?, qte_vendue=?, chemin_img=? WHERE id_prod=?";
        try {
            $donnees = [
                $produit->getNomProd(),
                $produit->getCategorie(),
                $produit->getModele(),
                $produit->getFabriquant(),
                $produit->getPrix(),
                $produit->getQteTotale(),
                $produit->getQteVendue(),
                $produit->getCheminImg(),
                $produit->getIdProd()
            ];        
            $stmt = $this->connexion->prepare($requete);
            $stmt->bind_param("ssssdiiss", $donnees[0], $donnees[1], $donnees[2], $donnees[3], $donnees[4], $donnees[5], $donnees[6], $donnees[7], $donnees[8]);
            $stmt->execute();
            $this->reponse['message'] = "Produit " . $donnees[7] . " modifie";
            $this->reponse['OK'] = true;
        }catch(Exception $e) {
            $this->reponse['message'] = "Server-side error: " . $e;
            $this->reponse['OK'] = false;
        }finally {
            Connexion::unsetConnexion();
            return json_encode($this->reponse);
        }
    }

    function delete(int $id_prod):string {
        $this->connexion = Connexion::getConnexion(); 
        $requete = "DELETE FROM produits WHERE id_prod=?";
        try {
            $stmt = $this->connexion->prepare($requete);
            $stmt->bind_param("s", $id_prod);
            $stmt->execute();
            $this->reponse['message'] = "Produit " . $id_prod . " supprime";
            $this->reponse['OK'] = true;
        }catch(Exception $e) {
            $this->reponse['message'] = "Server-side error: " . $e;
            $this->reponse['OK'] = false;
        }finally {
            Connexion::unsetConnexion();
            return json_encode($this->reponse);
        }
    }
	
}

?>