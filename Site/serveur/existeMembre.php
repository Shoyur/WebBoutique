<?php

    $servername = "sql9.freesqldatabase.com";
    $username = "sql9558434";
    $password = "bQV64kWUMF";
    $dbname = "sql9558434";
    
    // Create connection
    $conn = mysqli_connect($servername,
        $username, $password, $dbname);
    
    // Check connection
    if ($conn === false) {
        die("Connection failed: "
            . mysqli_connect_error());
    }

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