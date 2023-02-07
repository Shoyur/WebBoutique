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

async function membreSeConnecte(email, mdp) {
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

