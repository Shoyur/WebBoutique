<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'A') {
	echo '<h2 style="color:red;">!!! VOUS DEVEZ ÊTRE AUTHENTIFIÉ COMME ADMINISTRATEUR POUR ACCÉDER À CETTE PAGE !!!</h2>';
	echo '<a href="../">Retour à la page d\'acceuil</a>';
	exit();
};
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
	<link type="text/css" rel="stylesheet" href="../client/css/bootstrap.min.css" />
	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="../client/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="../client/css/slick-theme.css" />
	<!-- NoUIslider -->
	<link type="text/css" rel="stylesheet" href="../client/css/nouislider.min.css" />
	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../client/css/font-awesome.min.css">
	<!-- Custom Stylesheet -->
	<link type="text/css" rel="stylesheet" href="../client/css/style.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<!-- Custom Scripts -->
	<script src="../client/js/connecter.js"></script>
	<script type="text/javascript" src="../client/js/global.js"></script>
	<script type="text/javascript" src="../client/js/requetes.js"></script>
	<script type="text/javascript" src="../client/Produits/requetes.js"></script>
	<script type="text/javascript" src="../client/Produits/vues.js"></script>
</head>

<body>

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
							<img src="../client/images/logo90.png" alt="">
						</a>
					</div>
					<div class="header-span">
						<span>Les Quatres Mousquitaires de l'Informatique</span>
					</div>
				</div>
				<!-- /LOGO -->
				<!-- ACCOUNT OPTION -->
				<div class=" col-md-9 clearfix">
					<div class="header-ctn">
						<div class="divUser">
							<a href="deconnecter.php"><i class="fa fa-user-circle-o"></i> Déconnexion</a>
						</div>
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
				<!-- /ACCOUNT OPTION -->
			</div>
			<!-- /ROW -->
		</div>
		<!-- /CONTAINER -->
	</div>
	<!-- /MAIN HEADER -->

	<?php 
	if (isset($_GET['page']) && $_GET['page'] == 2) {
		// si anchor call /admin.php?page=2
		include "includes/adminSectionActivations.php"; 
	}
	else {
		// else, anchor call /admin.php?page=1, ou aucun paramètre
		include "includes/adminSectionProduits.php"; 
	}
	?>