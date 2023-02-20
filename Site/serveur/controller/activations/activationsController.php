<?php

    //CRUD OPERATIONS

    $reponse = array();


    // -------- READ ALL ------------------------------------------------------------------------------------------------------j
    function read() {
        global $reponse;
        $reponse['listeActivations'] = array();

        require_once("../../includes/configdb.inc.php");

        try {
            $requete = "SELECT * FROM connexion INNER JOIN membres USING (email)";
            $stmt = $conn->prepare($requete);
            $stmt->execute();
            $result = $stmt->get_result();
            $reponse['OK'] = true;
            while ($ligne = mysqli_fetch_array($result)) {
                $reponse['listeActivations'][] = $ligne;
            }
        } 
        catch (Exception $e) {
            $reponse['OK'] = false;
            $reponse['message'] = "Problème à récupérer les activations (membres).\nDans activationsController.php -> lister().\nException= $e";
        } 
        finally {
            mysqli_close($conn);
            header("Content-Type: application/json");
            echo json_encode(utf8ize($reponse));
        }
    }

    // -------- UPDATE ------------------------------------------------------------------------------------------------------j
    function update($email, $valeur) {
        require_once("../../includes/configdb.inc.php");
        try {

            $requete = "UPDATE connexion SET statut_m='$valeur' WHERE email='$email'";
            // UPDATE connexion SET statut_m=I WHERE email=a.tavares@cmaisonneuve.qc.ca
            $stmt = $conn->prepare($requete);
            $stmt->execute();
            // $result = $stmt->get_result();
            $reponse['OK'] = true;
            $reponse['message'] = "L'accès du membre avec le login (courriel) '$email' a été ".($valeur == "A") ? "Activé" : "Inactivé".".";
        } 
        catch (Exception $e) {
            $reponse['OK'] = false;
            $reponse['message'] = "Problème à récupérer les activations (membres).\nDans activationsController.php -> lister().\nException= $e";
        } 
        finally {
            mysqli_close($conn);
            header("Content-Type: application/json");
        }
    }

    // fonction pour mettre tous les caractères en UTF8
    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8ize($v);
            }
        } else if (is_string($d)) {
            return utf8_encode($d);
        }
        return $d;
    }

    switch ($_POST['action']) {
        case 'lister':
            read();
            break;
        case 'modifier':
            update($_POST['email'], $_POST['valeur']);
            break;
    }

?>