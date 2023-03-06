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
            console.log(reponse);
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

let reqModifierActivation = (email, valeur) => {
    $.ajax({
        type: "POST",
        url: "Auth/routes.php",
        data: {
            action: "modifier",
            email: email,
            valeur: valeur,
        },
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
