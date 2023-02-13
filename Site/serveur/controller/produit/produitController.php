<?php
//CRUD OPERATIONS PRODUITS

$reponse = array();


// -------- READ ALL ------------------------------------------------------------------------------------------------------j
function lister()
{
    global $reponse;
    $reponse['listeProduits'] = array();

    require_once("../../includes/configdb.inc.php");

    try {
        $requete = "SELECT * FROM produits";
        $stmt = $conn->prepare($requete);
        $stmt->execute();
        $result = $stmt->get_result();

        $reponse['OK'] = true;
        while ($ligne = mysqli_fetch_array($result)) {
            $reponse['listeProduits'][] = $ligne;
        }
    } catch (Exception $e) {
        $reponse['OK'] = false;
        $reponse['message'] = "Probleme pour lister dans controller!";
    } finally {
        mysqli_close($conn);
    }
}

// -------- CREATE --------------------------------------------------------------------------------------------------------
function ajouterProduits()
{
    // VARIABLES TEST QUI SERONT REMPLACÉ PAR $_POST
    $idProd = date("Ymdhis"); // retourne un string format (year-month-day-hour-minutes-secondes) sans les tirets
    $cheminImg = "client/images/produit1.png";
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

// -------- DELETE -------------------------------------------------------------------------------------------------------
function supprimerProduits($id)
{

    global $reponse;

    require_once("../../includes/configdb.inc.php");

    try {
        $requete = "DELETE FROM produits WHERE id_prod=?";
        $stmt = $conn->prepare($requete);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $reponse['OK'] = true;
        $reponse['result'] = $result;

    } catch (Exception $e) {
        $reponse['OK'] = false;
        $reponse['message'] = "Probleme pour lister dans controller!";
    } finally {
        mysqli_close($conn);
    }

}

// -------- UPDATE ------------------------------------------------------------------------------------------------------
function updateProduits()
{
    // VARIABLES TEST QUI SERONT REMPLACÉ PAR $_POST
    $id = "20230202064550";
    $object = [["nom_prod", "Blablabla"], ["prix", 275.95], ["qte_vendue", 3]]; //sera créer via le formulaire et envoyer par le controlleur

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

// -------- AUTRES ------------------------------------------------------------------------------------------------------------
function mapToStringUpdates($object)
{
    $updateRequest = "";

    foreach ($object as $modifications) {
        $modifColumn = $modifications[0];

        // Si la valeur est un string, on ajoute des guillemets (pour faire fonctionner la requete sinon on laisse comme ça----- //
        $modifNewValue = is_String($modifications[1]) ? "'$modifications[1]'" : $modifications[1];
        // -------------------------------------------------------------------------------------------- //

        $updateRequest .= $modifColumn . " = " . $modifNewValue . ", ";
    }

    $updateRequest = substr($updateRequest, 0, -2); //retrait de la virgule et de l'espace de trop

    return $updateRequest;
}



function utf8ize($d) // fonction pour mettre tous les caractères en UTF8

{
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string($d)) {
        return utf8_encode($d);
    }
    return $d;
}



//UNCOMMENT POUR TESTER FONCTION
// listerProduits();
// ajouterProduits();
// supprimerProduits();
// updateProduits();

// ------------  AVEC COMMANDE PHP SEULEMENT ------------
// - cd serveur/model/produit
// - php produitModel.php

$action = $_POST['action'];

switch ($action) {
    case 'enregistrer':
        // enregistrer();
        break;
    case 'lister':
        lister();
        break;
    case 'supprimer':
        $id = $_POST['id'];
        supprimerProduits($id);
        break;

}
header("Content-Type: application/json");
echo json_encode(utf8ize($reponse));
exit();


?>