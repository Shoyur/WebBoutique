function connecter() {
    const email = document.getElementById("emailConn").value;
    const mdp = document.getElementById("mdpConn").value;
    if (email == null || email == "" || mdp == null || mdp == "") {
        document.getElementById("msgErrConn").innerText =
            "Les champs 'Courriel' et 'Mot de passe' doivent être remplis.\n";
        return;
    }
    membreSeConnecte(email, mdp); // requete ajax
}
