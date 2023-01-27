<?php
// $servername = "sql9.freesqldatabase.com";
// $username = "sql9558434";
// $password = "bQV64kWUMF";
// $dbname = "sql9558434";

define("SERVEUR", "sql9.freesqldatabase.com");
define("USAGER", "sql9558434");
define("PASS", "bQV64kWUMF");
define("BD", "sql9558434");

$connexion = new mysqli(SERVEUR, USAGER, PASS, BD);

if ($connexion->connect_errno) {
    echo "Probléme de connexion au serveur de bd";
    exit();
}

?>