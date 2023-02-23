<?php
//CRUD OPERATIONS PRODUITS

$reponse = array();

// -------- READ ALL ------------------------------------------------------------------------------------------------------
function readAll() {
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
function create() {
    global $reponse;
    $id = date("Ymdhis"); // retourne un string format (year-month-day-hour-minutes-secondes) sans les tirets
    $cheminImg = "../../../client/images/";
    $nom = $_POST['nom_prod'];
    $categ = $_POST['categorie'];
    $modele = $_POST['modele'];
    $fabriquant = $_POST['fabriquant'];
    $prix = $_POST['prix'];
    $qte_totale = $_POST['qte_totale'];
    $qte_vendue = 0;
    require_once("../../includes/configdb.inc.php");
    try {
        $nomFichierTemp = $_FILES['photo']['tmp_name'];
        $nomFichierOriginal = $_FILES['photo']['name'];
        $extensionFichier = strrchr($nomFichierOriginal, '.');
        $nomPhoto = $id . $extensionFichier;
        @move_uploaded_file($nomFichierTemp, $cheminImg . $nomPhoto);
        $cheminImg = "client/images/" . $nomPhoto;
        //
        $requete = "INSERT INTO produits VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($requete);
        $stmt->bind_param("sssssdiis", $id, $nom, $categ, $modele, $fabriquant, $prix, $qte_totale, $qte_vendue, $cheminImg);
        $stmt->execute();
        $reponse['OK'] = true;
        $reponse['message'] = "Produit " . $nom . " enregistre";
    } catch (Exception $err) {
        $reponse['OK'] = false;
        $reponse['message'] = "Server-side error: " . $err;
    } finally {
        mysqli_close($conn);
    }
}
// -------- UPDATE ------------------------------------------------------------------------------------------------------
function update() {
    global $reponse;
    $id = $_POST['id_prod'];
    $cheminImg = "../../../client/images/";
    $nom = $_POST['nom_prod'];
    $categ = $_POST['categorie'];
    $modele = $_POST['modele'];
    $fabriquant = $_POST['fabriquant'];
    $prix = $_POST['prix'];
    $qteTotale = $_POST['qte_totale'];
    require_once("../../includes/configdb.inc.php");
    try {
        $requete = "";
        $stmt = "";
        if($_FILES['photo']['error'] != UPLOAD_ERR_NO_FILE){
            $nomFichierTemp = $_FILES['photo']['tmp_name'];
            $nomFichierOriginal = $_FILES['photo']['name'];
            $extensionFichier = strrchr($nomFichierOriginal, '.');
            $nomPhoto = $id . $extensionFichier;
            @move_uploaded_file($nomFichierTemp, $cheminImg . $nomPhoto);
            $cheminImg = "client/images/" . $nomPhoto;
            $requete = "UPDATE produits 
                SET nom_prod=?,
                categorie=?,
                modele=?,
                fabriquant=?,
                prix=?,
                qte_totale=?,
                chemin_img=? 
                WHERE id_prod=?";
            $stmt = $conn->prepare($requete);
            $stmt->bind_param("ssssdiss", $nom, $categ, $modele, $fabriquant, $prix, $qteTotale, $cheminImg, $id);
        }else{
            $requete = "UPDATE produits 
                SET nom_prod=?,
                categorie=?,
                modele=?,
                fabriquant=?,
                prix=?,
                qte_totale=?
                WHERE id_prod=?";
            $stmt = $conn->prepare($requete);
            $stmt->bind_param("ssssdis", $nom, $categ, $modele, $fabriquant, $prix, $qteTotale, $id);
        }
        //
        $stmt->execute();
        $reponse['OK'] = true;
        $reponse['message'] = "Produit " . $nom . " modifie";
    } catch (Exception $e) {
        $reponse['OK'] = false;
        $reponse['message'] = "Probleme pour modifier dans controller!";
    } finally {
        mysqli_close($conn);
    }
}
// -------- DELETE -------------------------------------------------------------------------------------------------------
function delete() {
    global $reponse;
    $id = $_POST['id_prod'];
    $nom = $_POST['nom_prod'];
    require_once("../../includes/configdb.inc.php");
    try {
        $requete = "DELETE FROM produits WHERE id_prod=?";
        $stmt = $conn->prepare($requete);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $reponse['OK'] = true;
        $reponse['message'] = "Produit " . $nom . " supprime";
    } catch (Exception $e) {
        $reponse['OK'] = false;
        $reponse['message'] = "Probleme pour lister dans controller!";
    } finally {
        mysqli_close($conn);
    }
}
// -------- AUTRES ------------------------------------------------------------------------------------------------------------
function utf8ize($d) { // fonction pour mettre tous les caractères en UTF8
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
    case 'lister':
        readAll();
    break;
    case 'ajouter':
        create();
    break;
    case 'modifier':
        update();
    break;
    case 'supprimer':
        delete();
        break;
    case 'rechercherProduit':
        chercherProds();
    break;
}

//error_log(json_encode($reponse));
header("Content-Type: application/json");
echo json_encode(utf8ize($reponse));
exit();

?>