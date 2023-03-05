const reqListerProduitsPopulaires = (action, nbDeProduits, pourAccueil) => {
    let condition = "ORDER BY qte_vendue DESC LIMIT 0," + nbDeProduits;
    let formProduit = new FormData();
    formProduit.append("action", action);
    formProduit.append("condition", condition);
    let url = pourAccueil ? "serveur/Produit/routes.php" : "Produit/routes.php";
    $.ajax({
        type: "POST",
        url: url,
        data: formProduit,
        dataType: "text",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
    })
        .done((reponse) => {
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                listeProduits = reponse.listeProduits;
                if (pourAccueil) {
                    montrerProduitsPopulairesAccueil(listeProduits);
                }
            } else {
                alert("Problème pour récupérer les produits populaires");
            }
        })
        .fail((e) => {
            alert("Erreur: " + e.responseText);
        });
};

const reqListerProduits = (action) => {
    let formProduit = new FormData();
    formProduit.append("action", action);
    $.ajax({
        type: "POST",
        url: "Produit/routes.php",
        data: formProduit,
        dataType: "text",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
    })
        .done((reponse) => {
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                listeProduits = reponse.listeProduits;
                listerProduits(listeProduits);
                preparerFiltre();
            } else {
                alert("Problème pour récupérer les produits");
            }
        })
        .fail((e) => {
            alert("Erreur: " + e.responseText);
        });
};

const reqEnregistrerProduit = (action) => {
    let formProduit = new FormData(
        document.getElementById("formEnregistrerProduit")
    );
    formProduit.append("categorie", formProduit.get("category-select-ajout"));
    formProduit.append("action", action);
    $.ajax({
        type: "POST",
        url: "Produit/routes.php",
        data: formProduit,
        dataType: "text",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
    })
        .done((reponse) => {
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                //
            } else {
                alert("Problème pour enregistrer le produit");
            }
        })
        .fail((e) => {
            alert("Erreur: " + e.responseText);
        });
};

const reqModifierProduit = (action, id) => {
    let formProduit = new FormData(
        document.getElementById("formModifierProduit")
    );
    formProduit.append("id_prod", id);
    formProduit.append("action", action);
    $.ajax({
        type: "POST",
        url: "Produit/routes.php",
        data: formProduit,
        dataType: "text",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
    })
        .done((reponse) => {
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                alert(reponse.message);
                location.reload();
            } else {
                alert("Problème pour modifier le produit");
            }
        })
        .fail((e) => {
            alert("Erreur: " + e.responseText);
        });
};

let reqSupprimerProduit = (action, id) => {
    let formProduit = new FormData(
        document.getElementById("formSupprimerProduit")
    );
    formProduit.append("id_prod", id);
    formProduit.append("action", action);
    $.ajax({
        type: "POST",
        url: "Produit/routes.php",
        data: formProduit,
        dataType: "text",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
    })
        .done((reponse) => {
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                alert(reponse.message);
                location.reload();
            } else {
                alert("Problème pour supprimer le produit");
            }
        })
        .fail((e) => {
            alert("Erreur: " + e.responseText);
        });
};

let reqRechercherProduits = (action) => {
    let prodRechercher = document.getElementById("prodRechercher").value;
    let condition = "WHERE nom_prod LIKE ?";
    let formProduit = new FormData();
    formProduit.append("action", action);
    formProduit.append("condition", condition);
    formProduit.append("params", prodRechercher);
    $.ajax({
        type: "POST",
        url: "Produit/routes.php",
        data: formProduit,
        dataType: "text",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
    })
        .done((reponse) => {
            alert(reponse);
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                listeProduits = reponse.listeProduits;
                listerProduits(listeProduits);
                preparerFiltre();
            } else {
                alert("Problème pour récupérer les produits recherchés");
            }
        })
        .fail((e) => {
            alert("Erreur: " + e.responseText);
        });
};
