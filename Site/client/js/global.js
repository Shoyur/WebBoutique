let validerFormEnregPartOne = () => {
    const pass = document.getElementById("mdp").value;
    const cpass = document.getElementById("cmdp").value;
    if (pass !== cpass) {
        document.getElementById("msgErrEnreg").innerHTML =
            "Les mots de passe sont différents!";
        setInterval(() => {
            document.getElementById("msgErrEnreg").innerHTML = "";
        }, 5000);
    } else {
        const email = document.getElementById("email").value;
        membreExiste(email); // requete ajax
    }
};

let validerFormEnregPartTwo = (reponse) => {
    if (reponse == "false") {
        document.getElementById("enreg_btn").removeAttribute("disabled");
    } else {
        document.getElementById("msgErrEnreg").innerHTML =
            "Un compte associé avec cette adresse courriel existe déjà!";
        setInterval(() => {
            document.getElementById("msgErrEnreg").innerHTML = "";
        }, 5000);
    }
};

// Crée une erreur au browser
// $('.dropdown-toggle').click(function(e) {
//     if ($(document).width() > 768) {
//       e.preventDefault();
//       var url = $(this).attr('href');
//       if (url !== '#') {
//         window.location.href = url;
//       }
//     }
// });

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////// *** CODE MIKE *** ///////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function creerVueActivations(listeActivations) {
    let contenu = `
    <div class='row'>
        <table class="table" id='table_produits'>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Courriel</th>
                    <th scope="col">Sexe</th>
                    <th scope="col">Naissance</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
    `;
    for (let unMembre of listeActivations) {
        contenu += creerRangeeMembre(unMembre);
    }
    contenu += `
                </tbody>
            </table>
        </div>
    `;
    document.getElementById("affichageAdmin").innerHTML += contenu;
}

function creerRangeeMembre(unMembre) {
    texte = "";
    texte += `
        <tr>
            <td>${unMembre.nom}</td>
            <td>${unMembre.prenom}</td>
            <td>${unMembre.email}</td>
            <td>${unMembre.sexe}</td>
            <td>${unMembre.daten}</td><td>`;
    if (unMembre.role_m == "M") {
        texte += `Membre</td><td><label class="switch">
                    <input type="checkbox" `;
        if (unMembre.statut_m == "A") {
            texte += `checked `;
        }
        texte += `id="${unMembre.email}" `;
        texte += ` onclick="activationToggle(this.id);">
                               <span class="slider round"></span>
                               </label>
            </td>`;
    } else {
        texte += "👑</td><td></td>";
    }
    texte += `</tr>`;
    return texte;
}

function activationToggle(id) {
    reqModifierActivation(id, document.getElementById(id).checked ? "A" : "I");
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
