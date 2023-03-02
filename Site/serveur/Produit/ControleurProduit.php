<?php
       
    require_once("Produit.php");
    require_once("DaoProduit.php");

class ControleurProduit { 
    static private $ctrlProduit = null;

    private function __construct() {}

	static function getControleurProduit():ControleurProduit {
		if(self::$ctrlProduit == null) {
			self::$ctrlProduit = new ControleurProduit();  
		}
		return self::$ctrlProduit;
	}

    function getAll() {
        return DaoProduit::getDaoProduit()->readAll(); 
    }

    function getSome() {
        $attributVise = $_POST['attributVise'];
        $nbDeProduits = $_POST['nbDeProduits'];
        error_log($nbDeProduits);
        return DaoProduit::getDaoProduit()->readSome($attributVise, $nbDeProduits);
    }

	function ajouter() {
        $id = date("Ymdhis"); // retourne un string format (year-month-day-hour-minutes-secondes) sans les tirets
        $nom = $_POST['nom_prod'];
        $categ = $_POST['categorie'];
        $modele = $_POST['modele'];
        $fabriquant = $_POST['fabriquant'];
        $prix = $_POST['prix'];
        $qte_totale = $_POST['qte_totale'];
        $qte_vendue = 0;
        $cheminImg = "../../client/images/";
        //
        $nomFichierTemp = $_FILES['photo']['tmp_name'];
        $nomFichierOriginal = $_FILES['photo']['name'];
        $extensionFichier = strrchr($nomFichierOriginal, '.');
        $nomPhoto = $id . $extensionFichier;
        @move_uploaded_file($nomFichierTemp, $cheminImg . $nomPhoto);
        $cheminImg = "client/images/" . $nomPhoto;
        //
        $leProduit = new Produit($id, $nom, $categ, $modele, $fabriquant, $prix, $qte_totale, $qte_vendue, $cheminImg);
        return DaoProduit::getDaoProduit()->create($leProduit); 
    }

    function modifier() {
        $id = $_POST['id_prod'];
        try {
            $propsTableau = json_decode(DaoProduit::getDaoProduit()->read($id), true);
        }catch(Exception $e) {
            //
        }
        $nom = $_POST['nom_prod'];
        $categ = $_POST['categorie'];
        $modele = $_POST['modele'];
        $fabriquant = $_POST['fabriquant'];
        $prix = $_POST['prix'];
        $qte_totale = $_POST['qte_totale'];
        $cheminImg = "../../client/images/";
        //
        if($_FILES['photo']['error'] != UPLOAD_ERR_NO_FILE) {
            unlink("../../" . $propsTableau["chemin_img"]);
            $nomFichierTemp = $_FILES['photo']['tmp_name'];
            $nomFichierOriginal = $_FILES['photo']['name'];
            $extensionFichier = strrchr($nomFichierOriginal, '.');
            $nomPhoto = $id . $extensionFichier;
            @move_uploaded_file($nomFichierTemp, $cheminImg . $nomPhoto);
            $cheminImg = "client/images/" . $nomPhoto;
            $nouveauProduit = new Produit($id, $nom, $categ, $modele, $fabriquant, $prix, $qte_totale, 0, $cheminImg);
        }else {
            $nouveauProduit = new Produit($id, $nom, $categ, $modele, $fabriquant, $prix, $qte_totale, 0, $propsTableau["chemin_img"]);
        }
        //
        return DaoProduit::getDaoProduit()->update($nouveauProduit);
    }

    function supprimer() {
        $id = $_POST['id_prod'];
        try {
            $propsTableau = json_decode(DaoProduit::getDaoProduit()->read($id), true);
        }catch(Exception $e) {
        //
        }
        unlink("../../" . $propsTableau["chemin_img"]);
        return DaoProduit::getDaoProduit()->delete($id);
    }

    function do() {
        $action = $_POST['action'];
        switch($action) {
            case "listerProduits":
                return $this->getAll();
            break;
            case "obtenirProduit":
                //fiche(); 
            break;
            case "ajouter":
                return $this->ajouter();
            break;
            case "modifier":
                return $this->modifier(); 
            break;
            case "supprimer":
                return $this->supprimer();
            break;
            case "listerProduitsPopulaires":
                return $this->getSome();
            break;
        }      
    }

}

?>