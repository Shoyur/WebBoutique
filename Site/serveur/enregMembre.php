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

$sql = "INSERT INTO membres VALUES
    ('$nom', '$prenom', '$email', '$sexe', '$daten')";

if(mysqli_query($conn, $sql)){
    echo "<h3>data stored in a database successfully."
        . " Please browse your localhost php my admin"
        . " to view the updated data</h3>";

    echo nl2br("Vous pouvez maintenant vous connectez en utilisant ".$email." comme identifiant.");
} else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn);
}

// SQL INSERT pour la table connexion
$sql = "INSERT INTO connexion VALUES
    ('$email', '$mdp', 'M', 'I')";

if(mysqli_query($conn, $sql)){
    echo "<h3>data stored in a database successfully."
        . " Please browse your localhost php my admin"
        . " to view the updated data</h3>";
    } else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn);
    }
    
// Close connection
mysqli_close($conn);





?>

<a href="../index.php">Retour à la page d'acceuil</a>