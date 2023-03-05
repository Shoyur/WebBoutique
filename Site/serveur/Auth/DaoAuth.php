<?php
declare (strict_types=1);

require_once(__DIR__ . "./../ressources/Connexion.php");
require_once("Auth.php");

class DaoAuth {
    private static $daoAuth = null;
    private $connexion = null;
    private $reponse=array();
	
    private function __construct() {}
    
	static function getDaoAuth():DaoAuth {
		if(self::$daoAuth == null) {
			self::$daoAuth = new DaoAuth();  
		}
		return self::$daoAuth;
	}

    function readAll():string {
        $this->connexion = Connexion::getConnexion();
        $requete = "SELECT * FROM connexion INNER JOIN membres USING (email)";
        try {
            $stmt = $this->connexion->prepare($requete);
            $stmt->execute();
            $resultat = $stmt->get_result();
            $this->reponse['listeActivations'] = array();
            while ($ligne = mysqli_fetch_array($resultat)) {
                $this->reponse['listeActivations'][] = $ligne;
            }
            $this->reponse['OK'] = true;
        }catch(Exception $e) {
            $this->reponse['message'] = "Server-side error: " . $e;
            $this->reponse['OK'] = false;
        } 
        finally {
            Connexion::unsetConnexion();
            return json_encode(utf8ize($this->reponse));
        }
    }
	
	function create(Auth $auth):string {
        $this->connexion = Connexion::getConnexion();    
        $requete = "INSERT INTO connexion VALUES(?,?,?,?)";
        try {
            $donnees = [
                $auth->getEmail(),
                $auth->getMdp(),
                $auth->getRoleM(),
                $auth->getStatutM()
            ];        
            $stmt = $this->connexion->prepare($requete);
            $stmt->bind_param("ssss", $donnees[0], $donnees[1], $donnees[2], $donnees[3]);
            $stmt->execute();
            $this->reponse['message'] = "Authentification reliée au Compte du Membre " . $donnees[0] . " créée";
            $this->reponse['OK'] = true;
        }catch(Exception $e) {
            $this->reponse['message'] = "Server-side error: " . $e;
            $this->reponse['OK'] = false;
        }finally {
            Connexion::unsetConnexion();
            return json_encode(utf8ize($this->reponse));
        }
    }

    function update(Auth $auth):string {
        $this->connexion = Connexion::getConnexion();
        $requete = "UPDATE connexion SET mdp=?, role_m=?, statut_m=? WHERE email=?";
        try {
            $donnees = [
                $auth->getMdp(),
                $auth->getRoleM(),
                $auth->getStatutM(),
                $auth->getEmail()
            ];        
            $stmt = $this->connexion->prepare($requete);
            $stmt->bind_param("ssss", $donnees[0], $donnees[1], $donnees[2], $donnees[3]);
            $stmt->execute();
            $this->reponse['message'] = "Authentification reliée au Compte du Membre " . $donnees[3] . " modifie";
            $this->reponse['OK'] = true;
        }catch(Exception $e) {
            $this->reponse['message'] = "Server-side error: " . $e;
            $this->reponse['OK'] = false;
        }finally {
            Connexion::unsetConnexion();
            return json_encode(utf8ize($this->reponse));
        }
    }

    // Fonction pour mettre tous les caractères en encodage UTF8
    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8ize($v);
            }
        } else if (is_string($d)) {
            return utf8_encode($d);
        }
        return $d;
    }

}

?>