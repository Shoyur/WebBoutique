<?php
declare (strict_types=1);

require_once(__DIR__ . "./../ressources/Connexion.php");
require_once("Membre.php");

class DaoMembre {
    private static $daoMembre = null;
    private $connexion = null;
    private $reponse=array();
	
    private function __construct() {}
    
	static function getDaoMembre():DaoMembre {
		if(self::$daoMembre == null) {
			self::$daoMembre = new DaoMembre();  
		}
		return self::$daoMembre;
	}

    function readAll():string {
        $this->connexion = Connexion::getConnexion();
        $requete="SELECT * FROM membres";
        try {
            $stmt = $this->connexion->prepare($requete);
            $stmt->execute();
            $resultat = $stmt->get_result();
            $this->reponse['listeMembres'] = array();
            while($ligne = mysqli_fetch_array($resultat)) {
                $this->reponse['listeMembres'][] = $ligne;
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

    function read(string $email):string {
        $this->connexion = Connexion::getConnexion();
        $requete="SELECT * FROM membres WHERE email=?";
        try {
            $stmt = $this->connexion->prepare($requete);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultat = $stmt->get_result();
            $propsTableau = array();
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
	
	function create(Membre $membre):string {
        $this->connexion = Connexion::getConnexion();    
        $requete = "INSERT INTO membres VALUES(?,?,?,?,?)";
        try {
            $donnees = [
                $membre->getNom(),
                $membre->getPrenom(),
                $membre->getEmail(),
                $membre->getSexe(),
                $membre->getDaten()
            ];        
            $stmt = $this->connexion->prepare($requete);
            $stmt->bind_param("sssss", $donnees[0], $donnees[1], $donnees[2], $donnees[3], $donnees[4]);
            $stmt->execute();
            $this->reponse['message'] = "Compte du Membre " . $donnees[2] . " enregistre";
            $this->reponse['OK'] = true;
        }catch(Exception $e) {
            $this->reponse['message'] = "Server-side error: " . $e;
            $this->reponse['OK'] = false;
        }finally {
            Connexion::unsetConnexion();
            return json_encode($this->reponse);
        }
    }

    function update(Membre $membre):string {
        $this->connexion = Connexion::getConnexion();
        $requete = "UPDATE membres SET nom=?, prenom=?, sexe=?, daten=? WHERE email=?";
        try {
            $donnees = [
                $membre->getNom(),
                $membre->getPrenom(),
                $membre->getSexe(),
                $membre->getDaten(),
                $membre->getEmail()
            ];        
            $stmt = $this->connexion->prepare($requete);
            $stmt->bind_param("sssss", $donnees[0], $donnees[1], $donnees[2], $donnees[3], $donnees[4]);
            $stmt->execute();
            $this->reponse['message'] = "Compte du Membre " . $donnees[4] . " modifie";
            $this->reponse['OK'] = true;
        }catch(Exception $e) {
            $this->reponse['message'] = "Server-side error: " . $e;
            $this->reponse['OK'] = false;
        }finally {
            Connexion::unsetConnexion();
            return json_encode($this->reponse);
        }
    }

    // ON NE SUPPRIME PAS LE COMPTE D'UN MEMBRE, ON DÉSACTIVE SON AUTHENTIFICATION 
    // function delete(string $email):string {
    //     $this->connexion = Connexion::getConnexion(); 
    //     $requete = "DELETE FROM membres WHERE email=?";
    //     try {
    //         $stmt = $this->connexion->prepare($requete);
    //         $stmt->bind_param("s", $email);
    //         $stmt->execute();
    //         $this->reponse['message'] = "Compte du Membre " . $email . " supprime";
    //         $this->reponse['OK'] = true;
    //     }catch(Exception $e) {
    //         $this->reponse['message'] = "Server-side error: " . $e;
    //         $this->reponse['OK'] = false;
    //     }finally {
    //         Connexion::unsetConnexion();
    //         return json_encode($this->reponse);
    //     }
    // }
	
}

?>