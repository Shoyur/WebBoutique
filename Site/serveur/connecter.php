<?php

    session_start();

    // require_once();

    $servername = "sql9.freesqldatabase.com";
    $username = "sql9558434";
    $password = "bQV64kWUMF";
    $dbname = "sql9558434";

    $connexion = new mysqli($servername, $username, $password, $dbname);
    
    if ($connexion === false) {
        echo "Connexion à la base de données échouée: " . $mysqli->connect_error;
        echo "<br><br><a href='../index.php'>Retour à la page d'acceuil</a>";
        mysqli_close($connexion);
        exit();
    }

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // vérifier si cette connexion existe.
    $essaie = $mysqli->query("SELECT * FROM connexion WHERE email = $email AND mdp = $mdp");
    if ($essaie->num_rows == 0) { 
        echo "Membre inexistant...";
        echo "<br><br><a href='../index.php'>Retour à la page d'acceuil</a>";
        mysqli_close($connexion);
        exit();
    }

    // else, on vérifie si il est actif.
    $essaie = $mysqli -> query("SELECT * FROM connexion WHERE email = $email AND mdp = $mdp AND statut_m = 'A'");
    if ($essaie -> num_rows == 0) { 
        echo "Membre existant mais inactif. Contactez l'administrateur.";
        echo "<br><br><a href='../index.php'>Retour à la page d'acceuil</a>";
        mysqli_close($connexion);
        exit();
    }

    // else, l'usager est connecté.
    $_SESSION['connecte'] = true;
    mysqli_close($connexion);
    header("Location: ../index.php");

?>