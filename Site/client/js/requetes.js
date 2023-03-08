let reqListerActivations = () => {
    formActivation = new FormData();
    formActivation.append("action", "listerActivations");
    $.ajax({
        type: "POST",
        url: "Auth/routes.php",
        data: formActivation,
        dataType: "text",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: (reponse) => {
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                creerVueActivations(reponse.listeActivations);
            } else {
                alert(reponse.message);
            }
        },
        fail: (e) => {
            alert("Erreur: " + e.responseText);
        },
    });
};

let reqModifierActivation = (unMembre, nouvelleValeur) => {
    formActivation = new FormData();
    formActivation.append("email", unMembre.email);
    formActivation.append("mdp", unMembre.mdp);
    formActivation.append("role", unMembre.role_m);
    formActivation.append("valeur", nouvelleValeur);
    formActivation.append("action", "modifier");
    $.ajax({
        type: "POST",
        url: "Auth/routes.php",
        data: formActivation,
        dataType: "text",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: (reponse) => {
            reponse = JSON.parse(reponse);
            if (reponse.OK) {
                alert(reponse.message);
            } else {
                alert(reponse.message);
            }
        },
        fail: (e) => {
            alert("Erreur: " + e.responseText);
        },
    });
};
