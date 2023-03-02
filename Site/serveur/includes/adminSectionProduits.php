	<!-- NAVIGATION -->
	<nav id="navigation">
		<div class="container">
			<div id="responsive-nav">
				<ul class="main-nav nav navbar-nav">
					<li class="active"><a href='#'>Gestion des produits</a></li>
					<li><a href='admin.php?page=2'>Gestion des membres</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- /NAVIGATION -->
	<div class="row">
	<!-- BOUTON AJOUTER -->
	<div class="container" style="margin-top:50px;">
		<a class="col-md-3" href="#" data-toggle="modal" data-target="#ajoutModal">
			<button type="button" class="btn btn-dark">Ajouter un produit</button>
		</a>
		<!-- SEARCH BAR -->
		<div class="header-search-admin">
		<form class="col-md-6 " id="formRechercherProd">
					<input  type="text" class="input" id="prodRechercher" placeholder="Recherchez ici">
					<button type="button" class="search-btn" onClick="reqRechercherProduits('rechercherProduits');"><i class="fa fa-search"></i></button>
				</form>
				</div>
		<!-- /SEARCH BAR -->
	</div>
		</div>
	<br><br>
	<!-- /BOUTON AJOUTER -->
	

	<!-- MODAL AJOUTER UN PRODUIT -->
	<div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="connectionModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="connectionModalLabel">Ajouter un produit</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formEnregistrerProduit">
						<div class="row">
							<div class="col-md-12">
								<label for="nom_prod" class="form-label">Nom</label>
								<input type="text" class="form-control is-valid" id="nom_prod" name="nom_prod" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="categorie-select">Catégorie</label>
								<select type="text" class="form-control is-valid" id="categorie-select" name="categorie-select" required>
									<!-- Remplissage dynamique lors de l'appel à la méthode lister du CRUD pour les produits -->
								</select>
							</div>
							<div class="col-md-6">
								<label for="modele" class="form-label">Modèle</label>
								<input type="text" class="form-control is-valid" id="modele" name="modele" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="fabriquant" class="form-label">Fabriquant</label>
								<input type="text" class="form-control is-valid" id="fabriquant" name="fabriquant" required>
							</div>
							<div class="col-md-6">
								<label for="prix" class="form-label">Prix</label>
								<input type="text" class="form-control is-valid" id="prix" name="prix" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="qte_totale" class="form-label">Quantité totale</label>
								<input type="text" class="form-control is-valid" id="qte_totale" name="qte_totale" required>
							</div>
							<div class="col-md-6">
								<label for="photo" class="form-label">Photo</label>
								<input type="file" class="form-control is-valid" id="photo" name="photo" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6">
								<button class="btn btn-primary" onClick="reqEnregistrerProduit('ajouter');">Enregistrer</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /MODAL AJOUTER UN PRODUIT -->

	<!-- FILTRE CONTENU AJAX -->
	<form class="container" id="filter-form" style="">
		<label for="category-select">Catégorie:</label>
  		<select id="category-select">
			<!-- Remplissage dynamique lors de l'appel à la méthode lister du CRUD pour les produits -->
  		</select>
  		<label for="price-min">Prix Min:</label>
  		<input type="number" id="price-min" min="0" step="0.01">
		<label for="price-max">Prix Max:</label>
		<input type="number" id="price-max" min="0" step="0.01">
  		<button type="submit">Filtrer</button>
	</form>
	<!-- /FILTRE CONTENU AJAX -->

	<!-- AFFICHAGE CONTENU AJAX -->
	<div class="container affichageAdmin" id="affichageAdmin" style="margin-top:5px;">
		<!-- VUE PRINCIPALE -->
	</div>
	<!-- /AFFICHAGE CONTENU AJAX -->

<!-- AFFICHAGE MODAL -->
<div class="container affichageModal" id="affichageModal" style="margin-top:5px;">
	<!-- -->
</div>

<!-- JQUERY PLUGINS -->
<script src="../client/js/jquery.min.js"></script>
<script src="../client/js/bootstrap.min.js"></script>
<script src="../client/js/slick.min.js"></script>
<script src="../client/js/nouislider.min.js"></script>
<script src="../client/js/jquery.zoom.min.js"></script>
<script src="../client/js/main.js"></script>


</body>
</html>

<?php echo '<script type="text/javascript">reqListerProduits("listerProduits");</script>'; ?>
