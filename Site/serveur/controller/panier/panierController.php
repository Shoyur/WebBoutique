<?php
    session_start();

    $reponse = array();
    $reponse["compte"] = 0;
    $reponse["donnees"] = "";
    $sousTotal = 0.0;

    if (!isset($_SESSION["panier"])) { 
        $_SESSION["panier"] = array();
    }
    if (isset($_POST["action"])) {
        $id_prod = $_POST["id_prod"];
        switch($_POST["action"]) {
            case "ajout":
                if (isset($_SESSION['panier'][$id_prod])) {
                    $_SESSION['panier'][$id_prod]['quantite']++;
                }
                else {
                    $_SESSION['panier'][$id_prod] = array('id_prod' => $id_prod, 'nom_prod' => $_POST["nom_prod"], 'prix' => $_POST["prix"], 'quantite' => 1, 'chemin_img' => $_POST["chemin_img"]);
                }
                break;
        
            case "retrait":
                if (isset($_SESSION['panier'][$id_prod])) {
                    $_SESSION['panier'][$id_prod]['quantite']--;
                    if ($_SESSION['panier'][$id_prod]['quantite'] < 1) { unset($_SESSION['panier'][$id_prod]); }
                }
                break;
        }
    }
    else {
        // pas d'action, seulement envoyer le panier de la session
        // possiblement rien ici...
    }
    if (count($_SESSION['panier']) === 0) {
        $reponse["donnees"] = "<br>Votre panier est vide.<br><br>";
    }
    else {
        foreach ($_SESSION["panier"] as $produit) {
            $totalLigne = ($produit["prix"] * $produit["quantite"]);
            $reponse["donnees"] .= '
                <tr title="sommaire" data-id="4" data-price="40">
                    <td class="text-center" style="width: 30px;"><img src="' . $produit["chemin_img"] . '" width="30px" height="30px"></td>
                    <td title="Nom du produit">' . $produit["nom_prod"] . '</td>
                    <td title="Prix">' . number_format((float)$produit["prix"], 2, '.', '') . '$</td>
                    <td title="Quantité"><input type="number" min="1" style="width: 70px;" class="my-product-quantity" value="' . $produit["quantite"] . '" readonly></td>
                    <td class="text-right" title="Total">' . number_format((float)$totalLigne, 2, '.', '') . '$</td>
                    <td title="Retirer du panier" class="text-center" style="width: 30px;">
                        <a href="javascript:void(0);" data-id_prod="' . $produit["id_prod"] . '" onclick="rafraichirPanier(`retrait`, this)" class="btn btn-xs btn-danger my-product-remove">X</a>
                    </td>
                </tr> 
            ';
            $reponse["compte"] = ($reponse["compte"] + (int)$produit["quantite"]);
            $sousTotal = ((int)$sousTotal + (int)$totalLigne);
        }
        // sous-total :
        $reponse["donnees"] .= '
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right">Sous-total</td>
                <td class="text-right"><strong id="panierSousTotal">' . number_format((float)$sousTotal, 2, '.', '') . '$</strong></td>
                <td></td>
            </tr>
        ';
        // taxes :
        $reponse["donnees"] .= '
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right">Taxes</td>
                <td class="text-right"><strong id="panierTaxes">' . number_format((float)($sousTotal * 0.15), 2, '.', '') . '$</strong></td>
                <td></td>
            </tr>
        ';
        // total :
        $reponse["donnees"] .= '
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right"><strong>Total</strong></td>
                <td class="text-right"><strong id="panierTotal">' . number_format((float)($sousTotal * 1.15), 2, '.', '') . '$</strong></td>
                <td></td>
            </tr>
        ';
    }
    header("Content-Type: application/json");
    echo json_encode(utf8ize($reponse));

    
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
?>
