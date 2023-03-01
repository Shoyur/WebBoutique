<?php
declare (strict_types=1);

require_once("env.inc.php");

class Connexion{
	private static $conn = null;
	
	private function __construct() {}

	static function getConnexion():mysqli {
		if(self::$conn == null) {
			self::connecter();
		}
		return self::$conn;
	}

	static function unsetConnexion():void {
		self::$conn = null;
	}
	
	private static function connecter():void {
		global $SERVEUR, $BD, $USAGER, $PASS; 
        self::$conn = new mysqli(
            $SERVEUR,
            $USAGER,
            $PASS,
            $BD
        );
        if(self::$conn == false) {
            die("Connection failed: "
                . mysqli_connect_error());
        }
	}

}

?>