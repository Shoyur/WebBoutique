<?php

// echo '<script>alert("OUAIP!!!")</script>';
// die();

session_start();



function connecter()
{

    require_once("includes/configdb.inc.php");
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $requete = "SELECT * FROM connexion WHERE email = ? AND mdp = ?";
    $stmt = $conn->prepare($requete);
    $stmt->bind_param("ss", $email, $mdp);
    $stmt->execute();
    $result = $stmt->get_result();
    $ligne = $result->fetch_object();
    print_r($ligne);
    if (!$ligne = $result->fetch_object()) {
        mysqli_close($conn);
        // echo '<script type="text/JavaScript">document.getElementById("msgErrConn").innerText = "Membre inexistant...";</script>';
        return "E";
    } else {
        if ($ligne->statut_m == "A") {
            if ($ligne->role_m == "M") {
                $_SESSION['statut_m'] = 'M';
                header('Location: pages/membre.php');
                mysqli_close($conn);
                //return "M";
            } elseif ($ligne->role_m == "A") {
                $_SESSION['statut_m'] = 'A';
                mysqli_close($conn);
                header('Location: pages/admin.php');
                //return "A";
            }
        } else {
            mysqli_close($conn);
            // echo '<script type="text/JavaScript">document.getElementById("msgErrConn").innerText = "Membre existant mais inactif. Contactez l`administrateur.";</script>';
            //return "I";
        }
    }
}

connecter();

?>