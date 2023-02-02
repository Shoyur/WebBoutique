<?php
//CRUD OPERATIONS



//READ ALL
function listerProduits()
{

    require_once("../../includes/configdb.inc.php");

    $requete = "SELECT * FROM produits";
    $stmt = $conn->prepare($requete);
    // $stmt->bind_param("ss", $email, $mdp);
    $stmt->execute();
    $result = $stmt->get_result();

    //TEST
    while ($row = mysqli_fetch_array($result)) {
        echo "Produit : " . $row['nom_prod'] . " \t Catégorie : " . $row['categorie'] . "\n";
    }

    mysqli_close($conn);

}

function ajouterProduits()
{
    // VARIABLES TEST QUI SERONT REMPLACÉ PAR $_POST
    $idProd = date("Ymdhis");
    $cheminImg = "Site/client/images/produit1.png";
    $nomProd = "nom1";
    $categ = "categ1";
    $modele = "modele1";
    $fabriquant = "fabricant1";
    $prix = 500.00;
    $qte_totale = 500;
    $qte_vendue = 50;

    require_once("../../includes/configdb.inc.php");

    $requete = "INSERT INTO produits VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($requete);
    $stmt->bind_param("sssssdiis", $idProd, $nomProd, $categ, $modele, $fabriquant, $prix, $qte_totale, $qte_vendue, $cheminImg);
    $stmt->execute();
    $result = $stmt->get_result();

    //TEST
    var_dump($result);

    mysqli_close($conn);

}

function supprimerProduits()
{
    // VARIABLE TEST QUI SERONT REMPLACÉ PAR $_POST -- A MODIFIÉ POUR CHAQUE TEST
    $id = "20230202062534";

    require_once("../../includes/configdb.inc.php");

    $requete = "DELETE FROM produits WHERE id_prod=?";
    $stmt = $conn->prepare($requete);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    var_dump($result);

    mysqli_close($conn);

}

function updateProduits()
{
    // VARIABLES TEST QUI SERONT REMPLACÉ PAR $_POST
    $id = "20230202064550";
    $object = [["nom_prod", "Blablabla"], ["prix", 275.95], ["qte_vendue", 3]];

    require_once("../../includes/configdb.inc.php");

    //Fonction qui transforme le "Map object" en partie de requetes mySQL
    $requeteUpdates = mapToStringUpdates($object);

    $requete = "UPDATE produits SET $requeteUpdates WHERE id_prod=?";
    echo $requete; //TEST VERIF REQUETE
    $stmt = $conn->prepare($requete);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    mysqli_close($conn);

}

function mapToStringUpdates($object)
{
    $updateRequest = "";

    foreach ($object as $modifications) {
        $modifColumn = $modifications[0];
        // Si la valeur est un string, on ajoute des guillemets pour faire fonctionner la requete -----
        $modifNewValue = is_String($modifications[1]) ? "'$modifications[1]'" : $modifications[1];
        // --------------------------------------------------------------------------------------------
        $updateRequest .= $modifColumn . " = " . $modifNewValue . ", ";
    }

    $updateRequest = substr($updateRequest, 0, -2); //retrait de la virgule et de l'espace de trop

    return $updateRequest;
}

//UNCOMMENT POUR TESTER FONCTION
// listerProduits();
// ajouterProduits();
// supprimerProduits();
// updateProduits();

?>