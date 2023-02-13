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

let reqLister = (action) => {
	
	$.ajax({
		type : "POST",
		url : "controller/produit/produitController.php",
		data : {"action":action},
        dataType: "text",
        success: (reponse)  => {
            alert(JSON.stringify(reponse));
            if(reponse['OK'] === true){
                console.log("reponse reussi");
                //alert(JSON.stringify(reponse.listeProduits));
                creerVue('lister', reponse.listeProduits);
            }else{
                console.log("reponse echoué");
                alert("Problème pour lister dans requetes");
            }
        }, 
        fail : (e)  => {
    	alert( "error reqLister" + e.message());
  	}
})}

// Contrôleur de requêtes
let requeteFilmServeur = (action) => {
    switch(action){
        case "enregistrer":
            // reqEnregistrer(action);
        break;
        case "lister":
            console.log("requeteFilmServeur");
            reqLister(action);
        break;
    }
}
