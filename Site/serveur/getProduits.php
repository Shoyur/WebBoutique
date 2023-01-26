<?php

require_once("includes/configdb.inc.php");

echo "ALLLOOO je suis dans getProduits.php";

try{
    $requete = "SELECT * FROM produits ORDER BY qte_vendue DESC LIMIT 0,3";
    $resultat = $conn->query($requete);
    
    echo $resultat;
}catch(Exception $e){
}finally{
    mysqli_close($conn);
}




?>