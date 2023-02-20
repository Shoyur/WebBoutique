<?php
//CRUD OPERATIONS PRODUITS

$reponse = array();

// -------- READ ALL ------------------------------------------------------------------------------------------------------
function readAll() {
    global $reponse;
    $reponse['listeProduits'] = array();
    require_once("../../includes/configdb.inc.php");
    try{
        $requete = "SELECT * FROM produits";
        $stmt = $conn->prepare($requete);
        $stmt->execute();
        $result = $stmt->get_result();
        $reponse['OK'] = true;
        while ($ligne = mysqli_fetch_array($result)){
            $reponse['listeProduits'][] = $ligne;
        }
    }catch(Exception $e){
        $reponse['OK'] = false;
        $reponse['message'] = "Probleme pour lister dans controller!";
    }finally{
        mysqli_close($conn);
    }
}
// -------- CREATE --------------------------------------------------------------------------------------------------------
function create() {
    global $reponse;
    $id = date("Ymdhis"); // retourne un string format (year-month-day-hour-minutes-secondes) sans les tirets
    $cheminImg = "../../../client/images/";
    $nom = $_POST['nom_prod'];
    $categ = $_POST['categorie'];
    $modele = $_POST['modele'];
    $fabriquant = $_POST['fabriquant'];
    $prix =$_POST['prix'];
    $qte_totale = $_POST['qte_totale'];
    $qte_vendue = 0;
    require_once("../../includes/configdb.inc.php");
    try{
        $nomFichierTemp = $_FILES['photo']['tmp_name'];
        $nomFichierOriginal = $_FILES['photo']['name'];
        $extensionFichier = strrchr($nomFichierOriginal,'.');
        $nomPhoto = $id.$extensionFichier;
        @move_uploaded_file($nomFichierTemp, $cheminImg.$nomPhoto);
        $cheminImg = "client/images/".$nomPhoto;
        //
        $requete = "INSERT INTO produits VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($requete);
        $stmt->bind_param("sssssdiis", $id, $nom, $categ, $modele, $fabriquant, $prix, $qte_totale, $qte_vendue, $cheminImg);
        $stmt->execute();
        $reponse['OK'] = true;
        $reponse['message'] = "Produit ".$nom." enregistre";
    }catch(Exception $err){
        $reponse['OK'] = false;
        $reponse['message'] = "Server-side error: ".$err;
    }finally{
        mysqli_close($conn);
    }
}
// -------- DELETE -------------------------------------------------------------------------------------------------------
function delete()
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

// -------- UPDATE ------------------------------------------------------------------------------------------------------
function update()
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

// -------- RECHERCHER UN PRODUIT ------------------------------------------------------------------------------------------------------
function chercherProds() {
    global $reponse;
    $reponse['listeProduits'] = array();
    $nom_produits = "%";
    $nom_produits .= $_POST["prodRechercher"];
    $nom_produits .= "%";
    require_once("../../includes/configdb.inc.php");
    try{
        $requete = "SELECT * FROM produits WHERE nom_prod LIKE ?";
        $stmt = $conn->prepare($requete);
        $stmt->bind_param("s", $nom_produits);
        $stmt->execute();
        $result = $stmt->get_result();
        $reponse['OK'] = true;
        while ($ligne = mysqli_fetch_array($result)){
            $reponse['listeProduits'][] = $ligne;
        }
    }catch(Exception $e){
        $reponse['OK'] = false;
        $reponse['message'] = "Probleme pour lister dans controller!";
    }finally{
        mysqli_close($conn);
    }
}



//UNCOMMENT POUR TESTER FONCTION
// readAll();
// create();
// delete();
// update();

// ------------  AVEC COMMANDE PHP SEULEMENT ------------
// - cd serveur/model/produit
// - php produitModel.php

$action = $_POST['action'];
switch ($action) {
    case 'enregistrerProduit':
        create();
    break;
    case 'listerProduits':
        readAll();
    break;
    case 'rechercherProduit':
        chercherProds();
    break;
}
header("Content-Type: application/json");
echo json_encode(utf8ize($reponse));
exit();


?>