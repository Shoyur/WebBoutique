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
