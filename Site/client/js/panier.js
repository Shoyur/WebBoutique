function rafraichirPanier(action, item) {
    let data = {}
    if (action != "") {
        switch (action) {
            case "ajout":
                data.action = action;
                data.id_prod = item.getAttribute("data-id_prod");
                data.nom_prod = item.getAttribute("data-nom_prod");
                data.chemin_img = item.getAttribute("data-chemin_img");
                data.prix = item.getAttribute("data-prix");
                break;
            case "retrait":
                data.action = action;
                data.id_prod = item.getAttribute("data-id_prod");
                break;
        }
    }
    $.ajax({
        type: "POST",
        url: "serveur/controller/panier/panierController.php",
        data: data,
        dataType: "text",
        success: (reponse) => {
            reponse = JSON.parse(reponse);
            // icone rond rouge :
            $("#panierCompteur").html(reponse.compteur);
            // contenu modal panier :
            $("#panierItems").html(reponse.donnees);
            if (reponse.compteur > 0) {
                $("#panierFooter").html('<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>' +
                '<button type="submit" class="btn btn-primary my-cart-checkout" onclick="afficherPageCommande();" data-dismiss="modal">Passer la commande</button>');
            }
            else { $("#panierFooter").html(''); }
        },
        fail: (e) => { alert("Erreur: " + e.message()); },
    });
}

function afficherPageCommande() {
    // $.ajax({
    //     type: "POST",
    //     url: "serveur/controller/panier/commandeController.php",
    //     data: data,
    //     dataType: "text",
    //     success: (reponse) => {
    //         reponse = JSON.parse(reponse);
    //         $("#panierItems").html(reponse.donnees);
    //         $("#panierCompteur").html(reponse.compteur);
    //         if (reponse.compteur > 0) {
    //             $("#panierFooter").html('<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>' +
    //             '<button type="submit" class="btn btn-primary my-cart-checkout" onclick="afficherPageCommande();">Passer la commande</button>');
    //         }
    //         else { $("#panierFooter").html(''); }
    //     },
    //     fail: (e) => { alert("Erreur: " + e.message()); },
    // });
    $("#zoneTest").html("\nWohh\nWohh\nWohh\nWohh\nWohh\nWohh\n");
}