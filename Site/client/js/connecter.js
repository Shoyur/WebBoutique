document.querySelector("#formConn").addEventListener("keyup", function (e) {
    if (e.key === "Enter") {
        connecter(e);
    }
});

function connecter(e) {
    const email = document.getElementById("emailConn").value;
    const mdp = document.getElementById("mdpConn").value;
    if (email == null || email == "" || mdp == null || mdp == "") {
        document.getElementById("msgErrConn").innerText =
            "Les champs 'Courriel' et 'Mot de passe' doivent être remplis.\n";
        return;
    }
    reqConnexion(email, mdp); // requete ajax
}

async function reqConnexion(email, mdp) {
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
