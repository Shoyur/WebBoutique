let listeProduits;

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

let reqListerProduits = (action) => {	
	$.ajax({
		type: "POST",
		url: "controller/produit/produitController.php",
		data: {"action":action},
        dataType: "text",
        success: (reponse) => {
            reponse = JSON.parse(reponse);
            if(reponse.OK){
                listeProduits = reponse.listeProduits;
                creerVue(action, listeProduits);
            }else{
                alert("Problème pour récupérer les produits");
            }
        }, 
        fail: (e) => {
    	    alert("Erreur: " + e.message());
  	    }
    })
}

let reqEnregistrerProduit = (action) => {	
    let formProduit = new FormData(document.getElementById('formEnregistrerProduit'));
	formProduit.append("action",action);
	$.ajax({
		type: "POST",
		url: "controller/produit/produitController.php",
		data: formProduit,
        dataType: "text",
        async: false,
		cache: false,
		contentType: false,
		processData: false
    }).done((reponse) => {
        reponse = JSON.parse(reponse);
        if(reponse.OK){
            //
        }else{
            alert("Problème pour enregistrer le produit");
        }
    }).fail((e) => {
    	alert("Erreur: " + e.message());
  	})
}


// Contrôleur de requêtes
let requeteAdminServeur = (action) => {
    switch(action){
        case "enregistrerProduit":
            reqEnregistrerProduit(action);
        break;
        case "listerProduits":
            reqListerProduits(action);
        break;
        case "listerActivations":
            //reqLister(action);
        break;
    }
}
