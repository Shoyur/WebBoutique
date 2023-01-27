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
        mysqli_close($conn);
        // echo '<script type="text/JavaScript">document.getElementById("msgErrConn").innerText = "Membre inexistant...";</script>';
        echo "E";
    }
    else {
        if ($ligne->statut_m == "A") {
            if ($ligne->role_m == "M") {
                $_SESSION['statut_m'] = 'M';
                mysqli_close($conn);
                echo "M";
            }
            elseif ($ligne->role_m == "A") {
                $_SESSION['statut_m'] = 'A';
                mysqli_close($conn);
                // header('Location: admin.php');
                echo "A";
            }
        }
        else {
            mysqli_close($conn);
            // echo '<script type="text/JavaScript">document.getElementById("msgErrConn").innerText = "Membre existant mais inactif. Contactez l`administrateur.";</script>';
            echo "I";
        }
    }



?>