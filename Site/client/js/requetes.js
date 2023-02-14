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

let reqLister = (action) => {	
	$.ajax({
		type : "POST",
		url : "controller/produit/produitController.php",
		data : {"action":action},
        dataType: "text",
        success: (reponse) => {
            reponse = JSON.parse(reponse);
            if(reponse.OK){
                listeProduits = reponse.listeProduits;
                creerVue('lister', listeProduits);
            }else{
                alert("Problème pour récupérer les produits");
            }
        }, 
        fail: (e) => {
    	    alert("Erreur: " + e.message());
  	    }
    })
}

let reqSupprimer = (action, id) => {	
	$.ajax({
		type : "POST",
		url : "controller/produit/produitController.php",
		data : {
            "action":action,
            "id":id
        },
        dataType: "text",
        success: (reponse) => {
            reponse = JSON.parse(reponse);
            if(reponse.OK){
                alert("Le produit a bien été supprimé");
                location.reload(); // a modifier 
            }else{
                alert("Problème pour supprimer le produit");
            }
        }, 
        fail: (e) => {
    	    alert("Erreur: " + e.message());
  	    }
    })
}

let reqModifier = (action, id) => {	
    alert( action + " " + id);
	// $.ajax({
	// 	type : "POST",
	// 	url : "controller/produit/produitController.php",
	// 	data : {
    //         "action":action,
    //         "id":id
    //     },
    //     dataType: "text",
    //     success: (reponse) => {
    //         alert(reponse);
    //         // reponse = JSON.parse(reponse);
    //         // if(reponse.OK){
    //         //     listeProduits = reponse.listeProduits;
    //         //     creerVue('lister', listeProduits);
    //         // }else{
    //         //     alert("Problème pour récupérer les produits");
    //         // }
    //     }, 
    //     fail: (e) => {
    // 	    alert("Erreur: " + e.message());
  	//     }
    // })
}




// Contrôleur de requêtes
let requeteAdminServeur = (action) => {
    switch(action){
        case "enregistrer":
            // reqEnregistrer(action);
            break;
        case "lister":
            reqLister(action);
            break;
        case "listerActivations":
            reqLister(action);
            break;
    }
}
