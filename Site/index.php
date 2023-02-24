<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Les Quatres Mousquitaires de l'Informatique</title>
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
	<!-- Bootstrap 3 -->
	<link type="text/css" rel="stylesheet" href="client/css/bootstrap.min.css" />
	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="client/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="client/css/slick-theme.css" />
	<!-- NoUIslider -->
	<link type="text/css" rel="stylesheet" href="client/css/nouislider.min.css" />
	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="client/css/font-awesome.min.css">
	<!-- Custom Stylesheet -->
	<link type="text/css" rel="stylesheet" href="client/css/style.css" />
	<!-- Custom Scripts -->
	<script defer src="./client/js/connecter.js"></script>
	<script defer src="./client/js/global.js"></script>
	<script defer src="./client/js/requetes.js"></script>
</head>

<body onload=montrerProduitsPopulaires();>

	<!-- HEADER -->
	<header>
		<!-- MODAL CREER UN COMPTE -->
		<div class="modal fade" id="enregistrerModal" tabindex="-1" role="dialog"
			aria-labelledby="enregistrerModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="enregistrerModalLabel">Devenir Membre</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span id="msgErrEnreg" style="color:#8B0000;"></span>
						<form class="row g-3 espace" action="serveur/enregMembre.php" method="POST">
							<div class="col-md-12">
								<label for="nom" class="form-label">Nom</label>
								<input type="text" class="form-control is-valid" id="nom" name="nom" required>
							</div>
							<div class="col-md-12">
								<label for="prenom" class="form-label">Prénom</label>
								<input type="text" class="form-control is-valid" id="prenom" name="prenom" required>
							</div>
							<div class="col-md-12">
								<label for="email" class="form-label">Courriel</label>
								<input type="email" class="form-control is-valid" id="email" name="email" required>
							</div>
							<div class="col-md-6">
								<label for="sexe">Sexe</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="sexe" id="homme" value="H" checked>
									<label class="form-check-label" for="homme">Homme</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="sexe" id="femme" value="F">
									<label class="form-check-label" for="femme">Femme</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="sexe" id="autre" value="A">
									<label class="form-check-label" for="autre">Autre</label>
								</div>
							</div>
							<div class="col-md-6">
								<label for="daten">Date de naissance
									<input type="date" name="daten" id="daten">
								</label>
							</div>
							<div class="col-md-8">
								<label for="mdp" class="form-label">Mot de passe</label>
								<input type="text" class="form-control is-valid" id="mdp" name="mdp" required>
							</div>
							<div class="col-md-8" style="margin-bottom:15px">
								<label for="cmdp" class="form-label">Confirmation du mot de passe</label>
								<input type="text" class="form-control is-valid" id="cmdp" name="cmdp" required>
							</div>
							<br />
							<div class="col-md-12">
								<div class="modal-footer">
									<button type="button" class="btn btn-success"
										onclick="validerFormEnregPartOne();">Valider</button>
									<button type="submit" class="btn btn-primary" id="enreg_btn"
										disabled>Enregistrer</button>
									<button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /MODAL CREER UN COMPTE -->
		<!-- MODAL OUVRIR UNE SESSION -->
		<div class="modal fade" id="connectionModal" tabindex="-1" role="dialog" aria-labelledby="connectionModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="connectionModalLabel">Connexion</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span id="msgErrConn" style="color:#8B0000;"></span>
						<form class="row g-3 espace" id="formConn">
							<div class="col-md-12">
								<label for="emailUser" class="form-label">Courriel</label>
								<input type="text" class="form-control is-valid" id="emailConn" name="emailConn" required>
							</div>
							<div class="col-md-12">
								<label for="mdpUser" class="form-label">Mot de passe</label>
								<input type="password" class="form-control is-valid" id="mdpConn" name="mdpConn" required>
							</div>
							<br />
							<div class="col-md-12">
								<div class="modal-footer">
									<button id="btConnConn" type="button" class="btn btn-primary" onclick="connecter();">Connecter</button>
									<button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#enregistrerModal">Créer un compte</button>
									<button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /MODAL OUVRIR UNE SESSION -->
		<!-- MAIN HEADER -->
		<div id="header">
			<!-- CONTAINER -->
			<div class="container">
				<!-- ROW -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-3">
						<div class="header-logo">
							<a href="#" class="logo">
								<img src="client/images/logo90.png" alt="">
							</a>
						</div>
						<div class="header-span">
							<span>Les Quatres Mousquitaires de l'Informatique</span>
						</div>
					</div>
					<!-- /LOGO -->
					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<form>
								<input class="input" placeholder="Recherchez ici">
								<button class="search-btn"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
					<!-- /SEARCH BAR -->
					<!-- ACCOUNT -->
					<div class="col-md-3 clearfix">
						<div class="header-ctn">
							<!-- ACCOUNT OPTIONS -->
							<div class="divUser">
								<?php
								if (isset($_SESSION['role']) && $_SESSION['role'] == "M") {
									$prenom = trim($_SESSION['prenom']);
									echo '
										<a href="#" data-toggle="dropdown" data-hover="dropdown">
											<i class="fa fa-user-circle-o"></i>&nbsp;&nbsp;' . trim($prenom) . '&nbsp;<span class="caret"></span>
										</a>
										<ul class="dropdown-menu">
											<li><a href="#">Liste de souhaits</a></li>
											<li><a href="#">Historique d’achats</a></li>
											<li><a href="#">Détails membre</a></li>
											<li><a href="serveur/deconnecter.php">Déconnecter</a></li>
										</ul>
									';
								} else {
									echo '
										<a href="#" data-toggle="modal" data-target="#connectionModal">
											<i class="fa fa-user-circle-o"></i>&nbsp;&nbsp;S’identifier
										</a>
									';
								}
								?>
							</div>
							<!-- /ACCOUNT OPTIONS -->
							<!-- ACCOUNT CART -->
							<div class="dropdown">
								<a href="#" data-toggle="dropdown">
									<i class="fa fa-shopping-cart"></i>
									<div class="qty">3</div>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list">
										<div class="product-widget">
											<div class="product-img">
												<img src="client/images/product01.png" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
											</div>
											<button class="delete"><i class="fa fa-close"></i></button>
										</div>
										<div class="product-widget">
											<div class="product-img">
												<img src="client/images/product02.png" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
											</div>
											<button class="delete"><i class="fa fa-close"></i></button>
										</div>
									</div>
									<div class="cart-summary">
										<small>3 Item(s) selected</small>
										<h5>SUBTOTAL: $2940.00</h5>
									</div>
									<div class="cart-btns">
										<a href="#">View Cart</a>
										<a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
							<!-- /ACCOUNT CART -->
							<!-- MENU TOGGLE 
							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>
						    /MENU TOGGLE -->
						</div>
					</div>
					<!-- /ACCOUNT -->
				</div>
				<!-- /ROW -->
			</div>
			<!-- /CONTAINER -->
		</div>
		<!-- /MAIN HEADER -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<nav id="navigation">
		<!-- CONTAINER -->
		<div class="container">
			<!-- RESPONSIVE NAV -->
			<div id="responsive-nav">
				<!-- NAV -->
				<ul class="main-nav nav navbar-nav">
					<li class="active"><a href="#">Accueil</a></li>
					<li><a href="#">Aubaines</a></li>
					<li><a href="#">Catégories</a></li>
					<li><a href="#">Portables</a></li>
					<li><a href="#">Téléphones</a></li>
					<li><a href="#">Tours</a></li>
				</ul>
				<!-- /NAV -->
			</div>
			<!-- /RESPONSIVE NAV -->
		</div>
		<!-- /CONTAINER -->
	</nav>
	<!-- /NAVIGATION -->

	<!-- HOT DEAL SECTION -->
	<div id="hot-deal" class="section">
		<!-- CONTAINER -->
		<div class="container">
			<!-- ROW -->
			<div class="row">
				<div class="col-md-12">
					<div class="hot-deal">
						<ul class="hot-deal-countdown">
							<li>
								<div>
									<h3>02</h3>
									<span>Jours</span>
								</div>
							</li>
							<li>
								<div>
									<h3>10</h3>
									<span>Heures</span>
								</div>
							</li>
							<li>
								<div>
									<h3>34</h3>
									<span>Minutes</span>
								</div>
							</li>
							<li>
								<div>
									<h3>60</h3>
									<span>Secondes</span>
								</div>
							</li>
						</ul>
						<h2 class="text-uppercase">Aubaine de la semaine</h2>
						<p>Jusqu'à 50% de rabais</p>
						<a class="primary-btn cta-btn" href="#">Magasinez Maintenant</a>
					</div>
				</div>
			</div>
			<!-- /ROW -->
		</div>
		<!-- /CONTAINER -->
	</div>
	<!-- /HOT DEAL SECTION -->

	<!-- SECTION PRODUITS POPULAIRES -->
	<div class="section">
		<!-- CONTAINER -->
		<div class="container">
			<!-- ROW -->
			<div class="row">
				<!-- SECTION TITLE -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">Produits Populaires</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Portables</a></li>
								<li><a data-toggle="tab" href="#tab1">Téléphones</a></li>
								<li><a data-toggle="tab" href="#tab1">Tours</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /SECTION TITLE -->
				<!-- SECTION CAROUSSEL -->
				<div class="col-md-12">
					<!-- ROW -->
					<div class="row">
						<!-- TABS CONTAINER -->
						<div class="products-tabs">
							<!-- TAB -->
							<div id="tab1" class="tab-pane active">
								<!-- SLICK CONTAINER -->
								<div class="products-slick" data-nav="#slick-nav-1">
									<!-- PRODUCT 1 -->
									<div id="produit1" class="product"></div>
									<!-- /PRODUCT 1 -->
									<!-- PRODUCT 2 -->
									<div id="produit2" class="product"></div>
									<!-- /PRODUCT 2 -->
									<!-- PRODUCT 3 -->
									<div id="produit3" class="product"></div>
									<!-- /PRODUCT 3 -->
									<!-- PRODUCT 4-->
									<div id="produit4" class="product"></div>
									<!-- /PRODUCT 4 -->
									<!-- PRODUCT 5 -->
									<div id="produit5" class="product"></div>
									<!-- /PRODUCT 5 -->
									<!-- PRODUCT 6 -->
									<div id="produit6" class="product"></div>
									<!-- /PRODUCT 6 -->
									<!-- PRODUCT 7 -->
									<div id="produit7" class="product"></div>
									<!-- /PRODUCT 7 -->
									<!-- PRODUCT 8 -->
									<div id="produit8" class="product"></div>
									<!-- /PRODUCT 8 -->
								</div>
								<!-- /SLICK CONTAINER -->
								<!-- SLICK NAV CONTAINER -->
								<div id="slick-nav-1" class="products-slick-nav"></div>
								<!-- /SLICK NAV CONTAINER -->
							</div>
							<!-- /TAB -->
						</div>
						<!-- /TAB CONTAINER -->
					</div>
					<!-- /ROW -->
				</div>
				<!-- /SECTION CAROUSSEL -->
			</div>
			<!-- /ROW -->
		</div>
		<!-- /CONTAINER -->
	</div>
	<!-- /SECTION PRODUITS POPULAIRES -->

	<!-- FOOTER -->
	<footer id="footer">
		<!-- TOP FOOTER -->
		<div class="section">
			<!-- CONTAINER -->
			<div class="container">
				<!-- ROW -->
				<div class="row">
					<div class="col-md-4 col-xs-12">
						<div class="footer">
							<h3 class="footer-title">À propos de nous</h3>
							<div class="footer-description">
								<p>Nous sommes les seuls Mousquitaires avec qui vous ferez affaire pour trouver ce que
									vous cherchez en terme de technologie informatique dernier cri!</p>
							</div>
							<ul class="footer-links">
								<li><a href="#"><i class="fa fa-map-marker"></i>2030 Boulevard Pie-IX</a></li>
								<li><a href="#"><i class="fa fa-phone"></i>1-514-420-6969</a></li>
								<li><a href="#"><i class="fa fa-envelope-o"></i>contactez.nous@LQM.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="footer">
							<h3 class="footer-title">Catégories</h3>
							<ul class="footer-links">
								<li><a href="#">Aubaines</a></li>
								<li><a href="#">Portables</a></li>
								<li><a href="#">Téléphones</a></li>
								<li><a href="#">Tours</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="footer">
							<h3 class="footer-title">Services</h3>
							<ul class="footer-links">
								<li><a href="#">Mon compte</a></li>
								<li><a href="#">Mon panier</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /ROW -->
			</div>
			<!-- /CONTAINER -->
		</div>
		<!-- /TOP FOOTER -->
		<!-- BOTTOM FOOTER -->
		<div id="bottom-footer" class="section">
			<div class="container">
				<!-- ROW -->
				<div class="row">
					<div class="col-md-12 text-center">
						<span class="copyright">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;
							<script>document.write(new Date().getFullYear());</script> All rights reserved | This
							template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
								href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</span>
					</div>
				</div>
				<!-- /ROW -->
			</div>
			<!-- /CONTAINER -->
		</div>
		<!-- /BOTTOM FOOTER -->
	</footer>
	<!-- /FOOTER -->

	<!-- JQUERY PLUGINS -->
	<script src="client/js/jquery.min.js"></script>
	<script src="client/js/bootstrap.min.js"></script>
	<script src="client/js/slick.min.js"></script>
	<script src="client/js/nouislider.min.js"></script>
	<script src="client/js/jquery.zoom.min.js"></script>
	<script src="client/js/main.js"></script>
	<!-- /JQUERY PLUGINS -->

</body>

</html>