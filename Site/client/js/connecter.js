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
    membreSeConnecte(v1, v2); // requete ajax
}