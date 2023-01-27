<?php

    require_once("includes/configdb.inc.php");

    $email = $_POST['email'];

    // Check if member exists in database
    $existe = 'false';
    try{
        $requete = "SELECT * FROM membres WHERE email='$email'";
        $resultat = $conn->query($requete);
        if($resultat->num_rows > 0){
            $existe = 'true';
        }
        echo $existe;
    }catch(Exception $e){
    }finally{
        mysqli_close($conn);
    }

?>