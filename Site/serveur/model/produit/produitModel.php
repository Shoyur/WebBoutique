<?php





function listerProduits()
{

    require_once("../../includes/configdb.inc.php");

    $requete = "SELECT * FROM produits";
    $stmt = $conn->prepare($requete);
    // $stmt->bind_param("ss", $email, $mdp);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = mysqli_fetch_array($result)) {
        echo $row['name'];
    }

}

listerProduits();


?>