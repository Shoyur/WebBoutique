
function connecter() {
    console.log("Début fonction connecter() de connecter.js");
    const email = document.getElementById('emailConn').value;
    const mdp = document.getElementById('mdpConn').value
    console.log("email=", email, " mdp=", mdp);
    if (email == null || email == "" || mdp == null || mdp == "") { 
        document.getElementById("msgErrConn").innerText = "Les champs 'Courriel' et 'Mot de passe' doivent être remplis.\n";
        return; 
    }
    $.ajax({
        url: "serveur/connecter.php",
        type: "POST",
        data: {
            "email": email,
            "mdp": mdp
        },
        async: false,
        dataType: 'text',
        success: (reponse) => {
            switch (reponse) {
                case 'E': {
                    console.log("'E': membre inexistant...");
                    document.getElementById("msgErrConn").innerText = "Membre inexistant..."; break; }
                case 'M': { 
                    console.log("'M'embre.");
                    location.reload(); break; }
                case 'A': { 
                    console.log("'A'dmin.");
                    window.location.href = "serveur/admin.php"; break; }
                case 'I': { 
                    console.log("Membre existant mais 'I'nactif. Contactez l`administrateur.");
                    document.getElementById("msgErrConn").innerText = "Membre existant mais inactif. Contactez l`administrateur."; break; }
                default : { 
                   console.log("connecter.js ajax reponse est autre chose que E-M-A-I");
                   break; }
            }
        },
        fail: (e) => {
            console.log(`Problème (ajax fail): ${e.message()}`);
        }
    });
}