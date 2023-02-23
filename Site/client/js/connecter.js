document.querySelector('#formConn').addEventListener('keyup', function (e) {
    if (e.key === 'Enter') {
        connecter(e);
    }
});

function connecter(e) {
    console.log("Début fonction connecter() de connecter.js");
    const email = document.getElementById('emailConn').value;
    const mdp = document.getElementById('mdpConn').value
    console.log("email=", email, " mdp=", mdp);
    if (email == null || email == "" || mdp == null || mdp == "") { 
        document.getElementById("msgErrConn").innerText = "Les champs 'Courriel' et 'Mot de passe' doivent être remplis.\n";
        return; 
    }
    membreSeConnecte(email, mdp); // requete ajax
}