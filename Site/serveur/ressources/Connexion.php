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
		mysqli_close(self::$conn);
		self::$conn = null;
	}
	
	private static function connecter():void {
		global $SERVEUR, $BD, $USAGER, $PASS; 
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		self::$conn= new mysqli();
		self::$conn->set_opt(MYSQLI_OPT_READ_TIMEOUT, 60);
		self::$conn->connect(
			$SERVEUR,
            $USAGER,
            $PASS,
            $BD
		);
		self::$conn->set_charset('utf8');
        if(self::$conn == false) {
            die("Connection failed: "
                . mysqli_connect_error());
        }
	}

}

?>