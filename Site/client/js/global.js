window.addEventListener("load", function () {
    showProduct();
});

let showProduct = async () => {
    let reponse = await fetch('serveur/getProduits.php');
    let responseText = await reponse.text();
    let data = await JSON.parse(responseText);
    for (let i = 0; i < data.length; i++) {
        let produit = `
            <div class="product-img">
                <img src="${data[i].chemin_img}" alt="">
                <div class="product-label">
                    <span class="sale">-30%</span>
                    <span class="new">NEW</span>
                </div>
            </div>
            <div class="product-body">
                <p class="product-category">${data[i].categorie}</p>
                <h3 class="product-name"><a href="#">${data[i].nom_prod.substring(0, 15)}</a></h3>
                <h4 class="product-price">$${data[i].prix} <del class="product-old-price">$990.00</del></h4>
                <div class="product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <div class="product-btns">
                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                </div>
            </div>
            <div class="add-to-cart">
                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
            </div>
        `;
        let idIndexHTML = "produit" + (i + 1);
        document.getElementById(idIndexHTML).innerHTML = produit;
    }
};

let validerFormEnregPartOne = () => {
    const pass = document.getElementById('mdp').value;
    const cpass = document.getElementById('cmdp').value;
    if (pass !== cpass) {
        document.getElementById('msgErrEnreg').innerHTML = "Les mots de passe sont différents!";
        setInterval(() => {
            document.getElementById('msgErrEnreg').innerHTML = "";
        }, 5000);
    } else {
        const email = document.getElementById('email').value;
        membreExiste(email); // requete ajax
    }
}

let validerFormEnregPartTwo = (reponse) => {
    if (reponse == 'false') {
        document.getElementById('enreg_btn').removeAttribute('disabled');
    } else {
        document.getElementById('msgErrEnreg').innerHTML = "Un compte associé avec cette adresse courriel existe déjà!";
        setInterval(() => {
            document.getElementById('msgErrEnreg').innerHTML = "";
        }, 5000);
    }
}


// Contrôleur vue panneau admin (page produits)
let creerVue = (action, donnees) => {
    switch(action){
        case "enregistrerProduit":
            // pas besoin d'une méthode la page se recharge et 
            // donc ré-appelle automatiquement listerProduits().
        break;
        case "modifier":
            //
        break;
        case "enlever" :
            // afficherMessage(donnees);
        break;
        case "listerProduits":
            listerProduits(donnees);
            preparerFiltre();
        break;
    }
}

let tableauCategProduits = new Set();
let listerProduits = (listeProduits) => {
    let contenu = `
        <div class='row'>
            <table class="table" id='table_produits'>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Modèle</th>
                        <th scope="col">Fabricant</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Qté total</th>
                        <th scope="col">Qté vendue</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
    `;
    for(let unProduit of listeProduits){
        contenu += creerRangeeProduit(unProduit);
        tableauCategProduits.add(unProduit.categorie);
    }
    contenu += `
                </tbody>
            </table>
        </div>
    `;
    document.getElementById('affichageAdmin').innerHTML += contenu;
}

let creerRangeeProduit = (unProduit) => {
    return `
        <tr>
            <td><img src="../${unProduit.chemin_img}" class="imgTable" alt="Image du produit"></td>
            <td>${unProduit.nom_prod}</td>
            <td>${unProduit.categorie}</td>
            <td>${unProduit.modele}</td>
            <td>${unProduit.fabriquant}</td>
            <td>${unProduit.prix}</td>
            <td>${unProduit.qte_totale}</td>
            <td>${unProduit.qte_vendue}</td>
            <td><button type="button" class="btn btn-dark" id="${unProduit.id_prod}">Modifier</button></td>
            <td><button type="button" class="btn btn-dark" id="${unProduit.id_prod}">Supprimer</button></td>
        </tr>
    `;
}

let preparerFiltre = () => {
    let filterForm = document.getElementById('filter-form');
    let categorySelect = document.getElementById('category-select');
    let categorySelectModalAjout = document.getElementById('categorie-select');
    let priceMin = document.getElementById("price-min");
    let priceMax = document.getElementById("price-max");
    let productTable = document.getElementById('table_produits');
    let productRows = productTable.getElementsByTagName('tr');
    categorySelect.innerHTML = `<option value="Tout">Tout</option>`;
    tableauCategProduits.forEach( (elem1, elem2, tableauCategProduits) => {
        categorySelect.innerHTML += `
            <option value='${elem1}'>${elem2}</option>
        `;
        if(elem1 != 'Tout'){
            categorySelectModalAjout.innerHTML += `
                <option value='${elem1}'>${elem2}</option>
            `;
        }
    })
    filterForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const selectedCategory = categorySelect.value;
        const minPrice = parseFloat(priceMin.value) || 0;
        const maxPrice = parseFloat(priceMax.value) || Number.POSITIVE_INFINITY;
        for(let i = 1; i < productRows.length; i++){
            const productRow = productRows[i];
            const productCells = productRow.getElementsByTagName("td");
            const productCategory = productCells[2].innerText;
            const productPrice = parseFloat(productCells[5].innerText);
            if(selectedCategory === 'Tout'){
                productRow.style.display = "";
            }else if(productCategory === selectedCategory || selectedCategory === ""){
                if(productPrice >= minPrice && productPrice <= maxPrice){
                    productRow.style.display = "";
                }else{
                    productRow.style.display = "none";
                }
            }else{
                productRow.style.display = "none";
            }
        }
    })
}


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
    for(let unMembre of listeActivations){
        contenu += creerRangeeMembre(unMembre);
    }
    contenu += `
                </tbody>
            </table>
        </div>
    `;
    document.getElementById('affichageAdmin').innerHTML += contenu;
}

function creerRangeeMembre(unMembre) {
    texte = "";
    texte+= `
        <tr>
            <td>${unMembre.nom}</td>
            <td>${unMembre.prenom}</td>
            <td>${unMembre.email}</td>
            <td>${unMembre.sexe}</td>
            <td>${unMembre.daten}</td><td>`
    if (unMembre.role_m == "M") {
        texte += `Membre</td><td><label class="switch">
                    <input type="checkbox" `;
        if (unMembre.statut_m == "A") {
            texte += `checked `
        }
        texte += `id="${unMembre.email}" `
        texte += ` onclick="activationToggle(this.id);">
                               <span class="slider round"></span>
                               </label>
            </td>`
    }
    else { texte+= "👑</td><td></td>"; }
    texte += `</tr>`;
    return texte;
}

function activationToggle(id) {
    reqModifierActivation(id, document.getElementById(id).checked ? "A" : "I");
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////




