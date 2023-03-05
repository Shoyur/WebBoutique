let montrerProduitsPopulairesAccueil = (data) => {
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
                <h3 class="product-name">
                    <a href="#">${data[i].nom_prod.substring(0, 15)}</a>
                </h3>
                <h4 class="product-price">
                    $${data[i].prix} 
                    <del class="product-old-price">$990.00</del>
                </h4>
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
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
    `;
    for (let unProduit of listeProduits) {
        contenu += creerRangeeProduit(unProduit);
        tableauCategProduits.add(unProduit.categorie);
    }
    contenu += `
                </tbody>
            </table>
        </div>
    `;
    document.getElementById("affichageAdmin").innerHTML = contenu;
};

let creerRangeeProduit = (unProduit) => {
    return `
        <tr>
            <td>
                <img 
                    src="../${unProduit.chemin_img}" 
                    class="imgTable" 
                    alt="Image du produit"
                />
            </td>
            <td>${unProduit.nom_prod}</td>
            <td>${unProduit.categorie}</td>
            <td>${unProduit.modele}</td>
            <td>${unProduit.fabriquant}</td>
            <td>${unProduit.prix}</td>
            <td>${unProduit.qte_totale}</td>
            <td>${unProduit.qte_vendue}</td>
            <td>
                <button 
                    type="button" 
                    class="btn btn-dark" 
                    value='${JSON.stringify(unProduit)}' 
                    onClick="modifierForm(this.value);"
                >
                <span class="glyphicon glyphicon-pencil"></span>
                </button>
            </td>
            <td>
                <button 
                    type="button" 
                    class="btn btn-dark" 
                    value='${JSON.stringify(unProduit)}' 
                    onClick="supprimerForm(this.value);"
                >
                <span class="glyphicon glyphicon-trash"></span>
                </button>
            </td>
        </tr>
    `;
};

let modifierForm = (value) => {
    let leProduit = JSON.parse(value);
    document.getElementById("affichageModal").innerHTML = "";
    let contenu = `
        <div class="modal fade" id="modifierModal" tabindex="-1" role="dialog" aria-labelledby="connectionModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
		        <div class="modal-content">
			        <div class="modal-header">
				        <h5 class="modal-title" id="connectionModalLabel">Modifier le produit : ${leProduit.nom_prod}</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        <span aria-hidden="true">&times;</span>
				        </button>
			        </div>
			        <div class="modal-body">
				        <span id="msgErrConn" style="color:#8B0000;"></span>
				        <form id="formModifierProduit">
						    <div class="row">
							    <div class="col-md-12">
								    <label for="nom_prod" class="form-label">Nom</label>
								    <input type="text" class="form-control is-valid" id="nom_prod" name="nom_prod" value="${leProduit.nom_prod}" required>
							    </div>
						    </div>
						    <div class="row">
							    <div class="col-md-6">
								    <label for="categorie">Catégorie</label>
								    <input type="text" class="form-control is-valid" id="categorie" name="categorie" value="${leProduit.categorie}" required>
							    </div>
							    <div class="col-md-6">
								    <label for="modele" class="form-label">Modèle</label>
								    <input type="text" class="form-control is-valid" id="modele" name="modele" value="${leProduit.modele}" required>
							    </div>
						    </div>
						    <div class="row">
							    <div class="col-md-6">
								    <label for="fabriquant" class="form-label">Fabriquant</label>
								    <input type="text" class="form-control is-valid" id="fabriquant" name="fabriquant" value="${leProduit.fabriquant}" required>
							    </div>
							    <div class="col-md-6">
								    <label for="prix" class="form-label">Prix</label>
								    <input type="text" class="form-control is-valid" id="prix" name="prix" value="${leProduit.prix}" required>
							    </div>
						    </div>
						    <div class="row">
							    <div class="col-md-6">
								    <label for="qte_totale" class="form-label">Quantité totale</label>
								    <input type="text" class="form-control is-valid" id="qte_totale" name="qte_totale" value="${leProduit.qte_totale}" required>
							    </div>
							    <div class="col-md-6">
								    <label for="photo" class="form-label">Photo</label>
								    <input type="file" class="form-control is-valid" id="photo" name="photo" value="">
							    </div>
						    </div>
						    <br>
						    <div class="row">
							    <div class="col-md-6">
								    <button type="button" class="btn btn-primary" id="${leProduit.id_prod}" onClick="reqModifierProduit('modifier', this.id);">Modifier</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
							    </div>
						    </div>
					    </form>
			        </div>
		        </div>
	        </div>
        </div>
    `;
    document.getElementById("affichageModal").innerHTML += contenu;
    $("#modifierModal").modal("show"); // affiche manuellement le modal
};

let supprimerForm = (value) => {
    let leProduit = JSON.parse(value);
    document.getElementById("affichageModal").innerHTML = "";
    let contenu = `
        <div class="container">
            <div class="modal fade" id="supprimerModal" tabindex="-1" role="dialog" aria-labelledby="connectionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Supprimer un produit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formSupprimerProduit">
                                <p>Désirez vous vraiment supprimer le produit suivant : </p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nom_prod" class="form-label">Nom</label>
                                        <input type="text" class="form-control is-valid" id="nom_prod" name="nom_prod" value="${leProduit.nom_prod}" readonly>
                                    </div>
                                </div>  
                            </form>                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="${leProduit.id_prod}" onClick="reqSupprimerProduit('supprimer', this.id);">Supprimer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    document.getElementById("affichageModal").innerHTML += contenu;
    $("#supprimerModal").modal("show"); // affiche manuellement le modal
};

let preparerFiltre = () => {
    let filterForm = document.getElementById("filter-form");
    let categorySelect = document.getElementById("category-select");
    let categorySelectModalAjout = document.getElementById("category-select-ajout");
    let priceMin = document.getElementById("price-min");
    let priceMax = document.getElementById("price-max");
    let productTable = document.getElementById("table_produits");
    let productRows = productTable.getElementsByTagName("tr");
    categorySelect.innerHTML = `<option value="Tout">Tout</option>`;
    tableauCategProduits.forEach((elem1, elem2, tableauCategProduits) => {
        categorySelect.innerHTML += `
            <option value='${elem1}'>${elem2}</option>
        `;
        if (elem1 != "Tout") {
            categorySelectModalAjout.innerHTML += `
                <option value='${elem1}'>${elem2}</option>
            `;
        }
    });
    filterForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const selectedCategory = categorySelect.value;
        const minPrice = parseFloat(priceMin.value) || 0;
        const maxPrice = parseFloat(priceMax.value) || Number.POSITIVE_INFINITY;
        for (let i = 1; i < productRows.length; i++) {
            const productRow = productRows[i];
            const productCells = productRow.getElementsByTagName("td");
            const productCategory = productCells[2].innerText;
            const productPrice = parseFloat(productCells[5].innerText);
            if (
                selectedCategory === "Tout" &&
                productPrice >= minPrice &&
                productPrice <= maxPrice
            ) {
                productRow.style.display = "";
            } else if (
                productCategory === selectedCategory &&
                productPrice >= minPrice &&
                productPrice <= maxPrice
            ) {
                productRow.style.display = "";
            } else {
                productRow.style.display = "none";
            }
        }
    });
};
