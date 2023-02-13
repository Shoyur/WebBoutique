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
<body>

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