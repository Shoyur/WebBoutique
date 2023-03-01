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
    // Pour voir l'objet avant de l'envoyer
    console.info("Dans rafraichirPanier(), avant le Ajax, data = ");
    console.info(data);
    
    $.ajax({
        type: "POST",
        url: "serveur/controller/panier/panierController.php",
        data: data,
        dataType: "text",
        success: (reponse) => {
            reponse = JSON.parse(reponse);
            $("#panierItems").html(reponse.donnees);
            $("#panierCompte").html(reponse.compte);
            if (reponse.compte > 0) {
                $("#panierFooter").html('<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>' +
                '<button type="button" class="btn btn-primary my-cart-checkout">Passer la commande</button>');
            }
            else {
                $("#panierFooter").html('');
            }
            // alert("Il y a", reponse.compte, "produits dans le panier.");
            // alert("TEST, reponse=", reponse);
            
        },
        fail: (e) => { alert("Erreur: " + e.message()); },
    });
};