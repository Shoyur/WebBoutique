async function membreExiste(email) {
    $.ajax({
        url: "serveur/existeMembre.php",
        type: "POST",
        data: { email: email },
        dataType: "text",
        success: (reponse) => {
            validerFormEnregPartTwo(reponse);
        },
        fail: (e) => {
            alert(`Problème: ${e.responseText}`);
        },
    });
}

async function membreSeConnecte(email, mdp) {
    $.ajax({
        url: "serveur/connecter.php",
        type: "POST",
        data: {
            email: email,
            mdp: mdp,
        },
        async: false,
        dataType: "text",
        success: (reponse) => {
            switch (reponse) {
                case "E": {
                    document.getElementById("msgErrConn").innerText =
                        "Membre inexistant...";
                    break;
                }
                case "M": {
                    location.reload();
                    break;
                }
                case "A": {
                    window.location.href = "serveur/admin.php";
                    break;
                }
                case "I": {
                    document.getElementById("msgErrConn").innerText =
                        "Membre existant mais inactif. Contactez l`administrateur.";
                    break;
                }
                default: {
                    break;
                }
            }
        },
        fail: (e) => {
            console.log(`Problème (ajax fail): ${e.responseText}`);
        },
    });
}

let reqListerProduitsPopulairesAccueil = (action, nbDeProduits) => {
    let formProduit = new FormData();
    formProduit.append("action", action);
    formProduit.append("attributVise", "qte_vendue");
    formProduit.append("nbDeProduits", nbDeProduits);
    $.ajax({
        type: "POST",
        url: "serveur/Produit/routes.php",
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
                montrerProduitsPopulairesAccueil(listeProduits);
            } else {
                alert(
                    "Problème pour récupérer les produits populaires pour la page d'accueil"
                );
            }
        })
        .fail((e) => {
            alert("Erreur: " + e.responseText);
        });
};

let reqListerProduits = (action) => {
    $.ajax({
        type: "POST",
        url: "Produit/routes.php",
        data: { action: action },
        dataType: "text",
        success: (reponse) => {
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                listeProduits = reponse.listeProduits;
                creerVue(action, listeProduits);
            } else {
                alert("Problème pour récupérer les produits");
            }
        },
        fail: (e) => {
            alert("Erreur: " + e.responseText);
        },
    });
};

let reqEnregistrerProduit = (action) => {
    let formProduit = new FormData(
        document.getElementById("formEnregistrerProduit")
    );
    formProduit.append("categorie", formProduit.get("categorie-select"));
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

let reqRechercher = (action) => {
    //here
    let prodRechercher = document.getElementById("prodRechercher").value;
    let formProduit = new FormData();
    formProduit.append("prodRechercher", prodRechercher);
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
                action = "listerProduits";
                creerVue(action, listeProduits);
            } else {
                alert("Problème pour enregistrer le produit");
            }
        })
        .fail((e) => {
            alert("Erreur: " + e.responseText);
        });
};

let reqModifierProduit = (action, id) => {
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
                alert("Problème pour enregistrer le produit");
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

let reqListerActivations = () => {
    $.ajax({
        type: "POST",
        url: "controller/activations/activationsController.php",
        data: { action: "lister" },
        dataType: "text",
        success: (reponse) => {
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                creerVueActivations(reponse.listeActivations);
            } else {
                alert(
                    "Problème à récupérer les activations (membres).\nDans " +
                        reponse.message
                );
            }
        },
        fail: (e) => {
            alert("Erreur: " + e.responseText);
        },
    });
};

let reqModifierActivation = (email, valeur) => {
    $.ajax({
        type: "POST",
        url: "controller/activations/activationsController.php",
        data: {
            action: "modifier",
            email: email,
            valeur: valeur,
        },
        // dataType: "text",
        success: (reponse) => {
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                console.log(reponse.message);
            } else {
                alert(
                    "Problème avec une activation (membre).\nDans " +
                        reponse.message
                );
            }
        },
        fail: (e) => {
            alert("Erreur: " + e.responseText);
        },
    });
};
