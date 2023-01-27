async function connecter() {
    console.log("Début fonction connecter()");
    const v1 = document.getElementById('emailConn').value;
    const v2 = document.getElementById('mdpConn').value
    if (v1 == null || v1 == "" || v2 == null || v2 == "") { return; }
    $.ajax({
        url: "serveur/connecter.php",
        type: "POST",
        data: {
            "email": v1,
            "mdp": v2
        },
        dataType: 'text',
        success: (reponse) => {
            switch (reponse) {
                case 'E': {
                    alert("Erreur : membre inexistant !!!");
                    console.log("Erreur : membre inexistant !!!");
                    document.getElementById("msgErrConn").innerText = "Membre inexistant..."; break; }
                case 'M': { 
                    alert("Oui un membre !!!");
                    console.log("Oui un membre !!!");
                    location.reload(); break; }
                case 'A': { 
                    alert("Un ADMIN !!!!!!!!!!!!");
                    console.log("Un ADMIN !!!!!!!!!!!!");
                    window.location.href = "serveur/admin.php"; break; }
                case 'I': { 
                    alert("BOOOOUUUHHHH inactif !");
                    console.log("BOOOOUUUHHHH inactif !");
                    document.getElementById("msgErrConn").innerText = "Membre existant mais inactif. Contactez l`administrateur."; break; }
                default : { 
                    alert("switch default (???)");
                    console.log("switch default (???)");
                    break; }
            }
        },
        fail: (e) => {
            alert(`Problème: ${e.message()}`);
        }
    });
}