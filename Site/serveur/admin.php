<?php
session_start();
if (!isset($_SESSION['statut_m']) || $_SESSION['statut_m'] != 'A') {
	echo '<h2 style="color:red;">!!! VOUS DEVEZ ÊTRE AUTHENTIFIÉ COMME ADMINISTRATEUR POUR ACCÉDER À CETTE PAGE !!!</h2>';
	exit();
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Electro - HTML Ecommerce Template</title>
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="../client/css/bootstrap.min.css" />
	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="../client/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="../client/css/slick-theme.css" />
	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="../client/css/nouislider.min.css" />
	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../client/css/font-awesome.min.css">
	<!-- Custom stylesheet -->
	<link type="text/css" rel="stylesheet" href="../client/css/style.css" />
	<!-- JS de Mike -->
	<script src="../client/js/connecter.js"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	<script type="text/javascript" src="../client/js/global.js"></script>
	<script src="../client/js/requetes.js"></script>
</head>
<body onLoad="requeteFilmServeur('lister');">

	<!-- MAIN HEADER -->
	<div id="header">
		<div class="container">
			<div class="row">
				<!-- LOGO -->
				<div class="col-md-3">
					<div class="header-logo">
						<a href="#" class="logo">
							<img src="../client/images/logo90.png" alt="">
						</a>
					</div>
					<div class="header-span">
						<span>Les Quatres Mousquitaires de l'Informatique</span>
					</div>
				</div>
				<!-- /LOGO -->
				<!-- ACCOUNT -->
				<div class=" col-md-9 clearfix">
					<div class="header-ctn">
						<div class="divUser">
							<a href="deconnecter.php"><i class="fa fa-user-circle-o"></i> Déconnexion</a>
						</div>
						<!-- MENU TOGGLE -->
						<div class="menu-toggle">
							<a href="#">
								<i class="fa fa-bars"></i>
								<span>Menu</span>
							</a>
						</div>
						<!-- /MENU TOGGLE -->
					</div>
				</div>
				<!-- /ACCOUNT -->
			</div>
		</div>
	</div>
	<!-- /MAIN HEADER -->

	<!-- NAVIGATION -->
	<nav id="navigation">
		<div class="container">
			<div id="responsive-nav">
				<ul class="main-nav nav navbar-nav">
					<li class="active"><a href="#">Gestion des produits</a></li>
					<li><a href="#">Gestion des membres</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- /NAVIGATION -->

	<!-- BOUTON AJOUTER -->
	<div class="container" style="margin-top:50px;">
		<a href="#" data-toggle="modal" data-target="#ajoutModal">
			<button type="button" class="btn btn-dark">Ajouter un produit</button>
		</a>
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
					<span id="msgErrConn" style="color:#8B0000;"></span>
					<form id="formEnregistrer">
						<div class="row">
							<div class="col-md-12">
								<label for="nom_prod" class="form-label">Nom</label>
								<input type="text" class="form-control is-valid" id="nom_prod" name="nom_prod" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="categorie" class="form-label">Catégorie</label>
								<input type="text" class="form-control is-valid" id="categorie" name="categorie" required>
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
								<label for="qte_vendu" class="form-label">Photo</label>
								<input type="file" class="form-control is-valid" id="qte_vendu" name="qte_vendu">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<button class="btn btn-primary" onClick="requeteFilmServeur('enregistrer');">Enregistrer</button>
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