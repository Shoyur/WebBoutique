
function connecter() {
    // alert(window.location.pathname);
    console.log("Début fonction connecter() de connecter.js");
    const v1 = document.getElementById('emailConn').value;
    const v2 = document.getElementById('mdpConn').value
    console.log(v1 + " + "+ v2);
    if (v1 == null || v1 == "" || v2 == null || v2 == "") { 
        document.getElementById("msgErrConn").innerText = "Les champs 'Courriel' et 'Mot de passe' doivent être remplis.\n";
        return; 
    }
    $.ajax({
        url: "serveur/connecter.php",
        type: "POST",
        data: {
            "email": v1,
            "mdp": v2
        },
        async: false,
        dataType: 'text',
        success: (reponse) => {
            switch (reponse) {
                case 'E': {
                    console.log("Erreur : membre inexistant !!!");
                    document.getElementById("msgErrConn").innerText = "Membre inexistant..."; break; }
                case 'M': { 
                    console.log("Oui un membre !!!");
                    location.reload(); break; }
                case 'A': { 
                    console.log("Un ADMIN !!!!!!!!!!!!");
                    window.location.href = "serveur/admin.php"; break; }
                case 'I': { 
                    console.log("BOOOOUUUHHHH inactif !");
                    document.getElementById("msgErrConn").innerText = "Membre existant mais inactif. Contactez l`administrateur."; break; }
                default : { 
                    console.log("switch default (???)");
                    break; }
            }
        },
        fail: (e) => {
            alert(`Problème: ${e.message()}`);
        }
    });
}