<?php

    require_once("includes/configdb.inc.php");

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $sexe = $_POST['sexe'];
    $daten = $_POST['daten'];
    $mdp = $_POST['mdp'];
    $cmdp = $_POST['cmdp'];

    
    // SQL INSERT pour la table membres
    $sql = "INSERT INTO membres (nom, prenom, email, sexe, daten) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $nom, $prenom, $email, $sexe, $daten);

    if (mysqli_stmt_execute($stmt)){
    // echo "<h3>data stored in a database successfully."
    //     . " Please browse your localhost php my admin"
    //     . " to view the updated data</h3>";

    // echo nl2br("Vous pouvez maintenant vous connectez en utilisant ".$email." comme identifiant.");
    } 
    else { echo "ERROR: Hush! Sorry -> ".mysqli_error($conn); }
 

    // SQL INSERT pour la table connexion
    $sql = "INSERT INTO connexion VALUES (?, ?, 'M', 'I')";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $mdp);
    if (mysqli_stmt_execute($stmt)) {
        echo "Enregistrement en tant que membre réussi.\n";
        // echo nl2br("Vous pouvez maintenant vous connectez en utilisant ".$email." comme identifiant.");
        echo "Votre compte sera éventuellement activé par un administrateur.\n";
        echo "Vous pourez ensuite vous connecter en utilisant ".$email." comme identifiant.\n\n";
    } 
    else { echo "ERROR: Hush! Sorry $sql. " . mysqli_stmt_error($stmt); }
    mysqli_close($conn);

?>

<a href="../index.php">Retour à la page d'acceuil</a>