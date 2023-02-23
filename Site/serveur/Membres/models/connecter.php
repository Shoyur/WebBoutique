<?php

require_once __DIR__ . '/../../includes/configdb.inc.php';

class ConnecterModel {

    public function __construct() {
        //
    }
    
    public function connecter($email, $mdp) {
        global $conn;
        $requete = "SELECT * FROM connexion WHERE email = ? AND mdp = ?";
        $stmt = $conn->prepare($requete);
        $stmt->bind_param("ss", $email, $mdp);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$ligne = $result->fetch_object()) {
            echo "E";
        } else {
            if ($ligne->statut_m == "A") {
                $_SESSION['role'] = '';
                if ($ligne->role_m == "M") {
                    $_SESSION['role'] = 'M';
                    // Aller chercher son prénom :
                    $requete = "SELECT * FROM membres WHERE email = ?";
                    $stmt = $conn->prepare($requete);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$ligne = $result->fetch_object()) {
                        $_SESSION['prenom'] = 'Erreur!';
                    } else {
                        $_SESSION['prenom'] = trim($ligne->prenom);
                    }
                    echo "M";
                } elseif ($ligne->role_m == "A") {
                    $_SESSION['role'] = 'A';
                    echo "A";
                }
                error_log($_SESSION['role']);
            } else {
                echo "I";
            }
        }
        mysqli_close($conn);
    }
}

?>