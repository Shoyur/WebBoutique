<?php
session_start();
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
		<link type="text/css" rel="stylesheet" href="client/css/bootstrap.min.css"/>
		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="client/css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="client/css/slick-theme.css"/>
		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="client/css/nouislider.min.css"/>
		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="client/css/font-awesome.min.css">
		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="client/css/style.css"/>
		<!-- <link rel="stylesheet" href="client/js/test.js"> -->

		<!-- JS de Mike -->
		<script src="client/js/connecter.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="client/js/global.js"></script>
		<script src="./client/js/requetes.js"></script>
    </head>
	<body >

		<!-- HEADER -->
		<header>

			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					
					<ul class="header-links pull-right">
						<li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#enregistrerModal">Créer un compte</button></li>
						<li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#connectionModal">Ouvrir une session</button></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MODAL CREER UN COMPTE -->
			<div class="modal fade" id="enregistrerModal" tabindex="-1" role="dialog" aria-labelledby="enregistrerModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				  	<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="enregistrerModalLabel">Devenir Membre</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<div class="modal-body">
							<span id="msgErrEnreg" style="color=#8B0000;"></span>
							<form class="row g-3 espace" action="serveur/enregMembre.php" method="POST" >
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
										<input class="form-check-input" type="radio" name="sexe" id="homme" value="H">
										<label class="form-check-label" for="homme">
										  Homme
										</label>
									  </div>
									  <div class="form-check">
										<input class="form-check-input" type="radio" name="sexe" id="femme" value="F" checked>
										<label class="form-check-label" for="femme">
										  Femme
										</label>
									  </div>
									  <div class="form-check">
										<input class="form-check-input" type="radio" name="sexe" id="autre" value="A" checked>
										<label class="form-check-label" for="autre">
										  Autre
										</label>
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
									<input type="text"  class="form-control is-valid" id="cmdp" name="cmdp" required>
								</div>
								<br/>
								<div class="col-md-12">
									<div class="modal-footer">
										<button type="button" class="btn btn-success" onClick="validerFormEnregPartOne();">Valider</button>
										<button type="submit" class="btn btn-primary" id="enreg_btn" disabled>Enregistrer</button>
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
			<div class="modal fade" id="connectionModal" tabindex="-1" role="dialog" aria-labelledby="connectionModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="connectionModalLabel">Connexion</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
						<span id="msgErrConn">!!!</span>
                        <form class="row g-3 espace">
                        <!-- <form class="row g-3 espace" action="serveur/connecter.php" method="POST"> -->
                            <div class="col-md-12">
                                <label for="emailUser" class="form-label">Courriel</label>
                                <input type="text" class="form-control is-valid" id="emailConn" name="emailConn" required>
                            </div>
                            <div class="col-md-12" style="margin-bottom:15px">
                                <label for="mdpUser" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control is-valid" id="mdpConn" name="mdpConn" required>
                            </div>
                            <br/>
                        </form>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					  <button type="button" class="btn btn-primary">Valider</button>
					</div>
				  </div>
				</div>
			  </div>
			<!-- /MODAL OUVRIR UNE SESSION -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">

						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="client/images/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">>Catégories</option>
										<option value="1">Categorie 01</option>
										<option value="1">Categorie 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Rechercher</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">

								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Favoris</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Mon Panier</span>
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
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toggle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toggle -->

							</div>
						</div>
						<!-- /ACCOUNT -->

					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->

		</header>
		<!-- /HEADER -->


		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
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
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->


		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
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
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->
		

		<!-- SECTION NOUVEAUX PRODUITS -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- SECTION TITLE -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Nouveaux Produits</h3>
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

					<!-- SECTION CAROUSSEL NOUVEAUX PRODUITS -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">

										<!-- product1 -->
										<div id="produit1" class="product">
											<!-- <div class="product-img">
												<img src="client/images/product01.png" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
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
											</div> -->
										</div>
										<!-- /product1 -->

										<!-- product2 -->
										<div id="produit2" class="product">
											<!-- <div class="product-img">
												<img src="client/images/product02.png" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div> -->
										</div>
										<!-- /product2 -->

										<!-- product3 -->
										<div id="produit3" class="product">
											<!-- <div class="product-img">
												<img src="client/images/product03.png" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div> -->
										</div>
										<!-- /product3 -->

										<!-- product4 -->
										<div id="produit4" class="product">
											<!-- <div class="product-img">
												<img src="client/images/product04.png" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
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
											</div> -->
										</div>
										<!-- /product4 -->

										<!-- product5 -->
										<div id="produit5" class="product">
											<!-- <div class="product-img">
												<img src="client/images/product5.png" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
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
											</div> -->
										</div>
										<!-- /product5 -->

									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /SECTION CAROUSSEL NOUVEAUX PRODUITS -->

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION NOUVEAUX PRODUITS  -->

		
		<!-- SECTION PRODUITS POPULAIRES-->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- SECTION TITLE -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Meilleurs Vendeurs</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab2">Portables</a></li>
									<li><a data-toggle="tab" href="#tab2">Téléphones</a></li>
									<li><a data-toggle="tab" href="#tab2">Caméras</a></li>
									<li><a data-toggle="tab" href="#tab2">Accessoires</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /SECTION TITLE -->

					<!-- SECTION CAROUSSEL PRODUITS POPULAIRES -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">

										<!-- product1 -->
										<div class="product">
											<div class="product-img">
												<img src="client/images/product06.png" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
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
										</div>
										<!-- /product1 -->

										<!-- product2 -->
										<div class="product">
											<div class="product-img">
												<img src="client/images/product07.png" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
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
										</div>
										<!-- /product2 -->

										<!-- product3 -->
										<div class="product">
											<div class="product-img">
												<img src="client/images/product08.png" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
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
										</div>
										<!-- /product3 -->

										<!-- product4 -->
										<div class="product">
											<div class="product-img">
												<img src="client/images/product09.png" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
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
										</div>
										<!-- /product4 -->

										<!-- product5 -->
										<div class="product">
											<div class="product-img">
												<img src="client/images/product01.png" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
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
										</div>
										<!-- /product5 -->
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /SECTION CAROUSSEL PRODUITS POPULAIRES -->

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION PRODUITS POPULAIRES -->

		
		<!-- FOOTER -->
		<footer id="footer">
			<!-- TOP FOOTER -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">À propos de nous</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Catégories</h3>
								<ul class="footer-links">
									<li><a href="#">Aubaines</a></li>
									<li><a href="#">Portables</a></li>
									<li><a href="#">Téléphones</a></li>
									<li><a href="#">Caméras</a></li>
									<li><a href="#">Accessoires</a></li>
								</ul>
							</div>
						</div>
						<div class="clearfix visible-xs"></div>
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">Notre équipe</a></li>
									<li><a href="#">Contact</a></li>
									<li><a href="#">Politique de confidentialité</a></li>
									<li><a href="#">Commandes et retours</a></li>
									<li><a href="#">Termes & Conditions</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">Mon compte</a></li>
									<li><a href="#">Mon panier</a></li>
									<li><a href="#">Favoris</a></li>
									<li><a href="#">Trouver mon colis</a></li>
									<li><a href="#">Aide</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /TOP FOOTER -->

			<!-- BOTTOM FOOTER -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /BOTTOM FOOTER -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="client/js/jquery.min.js"></script>
		<script src="client/js/bootstrap.min.js"></script>
		<script src="client/js/slick.min.js"></script>
		<script src="client/js/nouislider.min.js"></script>
		<script src="client/js/jquery.zoom.min.js"></script>
		<script src="client/js/main.js"></script>
	</body>
</html>
