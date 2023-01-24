<?php

require_once("includes/configdb.inc.php");

// $servername = "sql9.freesqldatabase.com";
// $username = "sql9558434";
// $password = "bQV64kWUMF";
// $dbname = "sql9558434";
 
// // Create connection
// $conn = mysqli_connect($servername,
//     $username, $password, $dbname);
 
// // Check connection
// if ($conn === false) {
//     die("Connection failed: "
//         . mysqli_connect_error());
// }

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$sexe = $_POST['sexe'];
$daten = $_POST['daten'];
$mdp = $_POST['mdp'];
$cmdp = $_POST['cmdp'];


echo $daten;

if($mdp == $cmdp){
    $s = "";
    if($sexe == "Homme"){
        $s = "M";
    }else if($sexe == "Femme"){
        $s = "F";
    }else if($sexe == "Autre"){
        $s = "A";
    }

    // SQL INSERT pour la table membres
    
    $sql = "INSERT INTO membres VALUES
        ('$nom', '$prenom', '$email', '$s', '$daten')";
    
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


}else{
    echo "Les mots de passe diffère.";
}


?>

<a href="../index.php">Retour à la page d'acceuil</a>