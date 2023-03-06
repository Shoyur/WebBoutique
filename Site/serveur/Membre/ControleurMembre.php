<?php
       
    require_once("Membre.php");
    require_once("DaoMembre.php");
    require_once("../Auth/ControleurAuth.php");

class ControleurMembre { 
    static private $ctrlMembre = null;

    private function __construct() {}

	static function getControleurMembre():ControleurMembre {
		if(self::$ctrlMembre == null) {
			self::$ctrlMembre = new ControleurMembre();  
		}
		return self::$ctrlMembre;
	}

    function getAll() {
        return DaoMembre::getDaoMembre()->readAll(); 
    }

    function get() {
        $email = $_POST['email'];
        return DaoMembre::getDaoMembre()->read($email);
    }

	function ajouter() {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $sexe = $_POST['sexe'];
        $daten = $_POST['daten'];
        //
        $leMembre = new Membre($nom, $prenom, $email, $sexe, $daten);
        $reponse = json_decode(DaoMembre::getDaoMembre()->create($leMembre)); 
        $ok = $reponse->OK;
        if($ok){
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $url = "{$protocol}://{$host}{$_SERVER['REQUEST_URI']}";
            $url = str_replace("Membre/routes.php","Auth/routes.php",$url);
            $data = $_POST;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
        }
        return json_encode($reponse);
    }

    function modifier() {
        //
    }

    function do() {
        $action = $_POST['action'];
        switch($action) {
            case "listerMembres":
                return $this->getAll();
            break;
            case "enregistrer":
                return $this->ajouter();
            break;
            case "modifier":
                return $this->modifier(); 
            break;
            case "lire":
                return $this->get();
            break;
        }      
    }

}

?>