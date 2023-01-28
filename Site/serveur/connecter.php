<?php

    session_start();

    require_once("includes/configdb.inc.php");

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $requete = "SELECT * FROM connexion WHERE email = ? AND mdp = ?";
    $stmt = $conn->prepare($requete);
    $stmt->bind_param("ss", $email, $mdp);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$ligne = $result->fetch_object()) {
        echo "E";
    }
    else {
        if ($ligne->statut_m == "A") {
            if ($ligne->role_m == "M") {
                $_SESSION['statut_m'] = 'M';

                // Aller chercher son prénom :
                $requete = "SELECT * FROM membres WHERE email = ?";
                $stmt = $conn->prepare($requete);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                if (!$ligne = $result->fetch_object()) {
                    $_SESSION['prenom'] = 'Erreur!';
                }
                else { $_SESSION['prenom'] = trim($ligne->prenom); }
                echo "M";
            }
            elseif ($ligne->role_m == "A") {
                $_SESSION['statut_m'] = 'A';
                echo "A";
            }
        }
        else {
            echo "I";
        }
    }
    mysqli_close($conn);


?>