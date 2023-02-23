async function membreSeConnecte(email, mdp) {
    $.ajax({
        url: "serveur/Membres/routesMembres.php",
        type: "POST",
        data: {
            action: "connecter",
            email: email,
            mdp: mdp,
        },
        dataType: "text",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: (reponse) => {
            console.log(reponse);
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
            console.log(`Problème (ajax fail): ${e.message()}`);
        },
    });
}
