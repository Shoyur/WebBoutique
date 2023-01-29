async function membreExiste(email) {
    $.ajax({
        url: "serveur/existeMembre.php",
        type: "POST",
        data: {"email": email},
        dataType: 'text',
        success: (reponse) => {
            validerFormEnregPartTwo(reponse);
        },
        fail: (e) => {
            alert(`Problème: ${e.message()}`);
        }
    });
}

async function membreSeConnecte(v1, v2) {
    $.ajax({
        url: "serveur/connecter.php",
        type: "POST",
        data: {"email": v1, "mdp": v2},
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
                case 'A':  {
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

// async function getProduits() {
//     $.ajax({
//         url: "serveur/getProduits.php",
//         type: "GET",
//         data: {},
//         dataType: 'json',
//         success: (reponse) => {
//             console.log(reponse);
//             initialiser(reponse);
//         },
//         fail: (e) => {
//             alert(`Problème: ${e.message()}`);
//         }
//     });
// }

