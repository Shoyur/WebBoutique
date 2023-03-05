<?php
       
    require_once("Auth.php");
    require_once("DaoAuth.php");

class ControleurAuth { 
    static private $ctrlAuth = null;

    private function __construct() {}

	static function getControleurAuth():ControleurAuth {
		if(self::$ctrlAuth == null) {
			self::$ctrlAuth = new ControleurAuth();  
		}
		return self::$ctrlAuth;
	}

    function getAll() {
        return DaoAuth::getDaoAuth()->readAll(); 
    }

	function ajouter() {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $role = 'M';
        $statut = 'A';
        $auth = new Auth($email, $mdp, $role, $statut);
        return DaoAuth::getDaoAuth()->create($auth); 
    }

    function modifier() {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $role = $_POST['role'];
        $statut = $_POST['valeur'];
        $auth = new Auth($email, $mdp, $role, $statut);
        return DaoAuth::getDaoAuth()->update($auth);
    }

    function do() {
        $action = $_POST['action'];
        switch($action) {
            case "listerActivations":
                return $this->getAll();
            break;
            case "enregistrer":
                return $this->ajouter();
            break;
            case "modifier":
                return $this->modifier(); 
            break;
        }      
    }

}

?>