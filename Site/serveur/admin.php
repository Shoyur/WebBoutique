<?php
session_start();
if (!isset($_SESSION['statut_m']) || $_SESSION['statut_m'] != 'A') {
	echo '<h2 style="color:red;">!!! VOUS DEVEZ ÊTRE AUTHENTIFIÉ COMME ADMINISTRATEUR POUR ACCÉDER À CETTE PAGE !!!</h2>';
	exit();

}
;
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

	<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administration</title>
</head>
<body>
	<br>
	<h2 class="">Future page pour administrer les produits du site...</h2>
	<br>
	<a href="deconnecter.php">Déconnecter et retour à l'acceuil</a>
</body>
</html> -->

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
					<li class="active"><a href="#">Gestion des produits</a></li>
					<li><a href="#">Gestion des membres</a></li>
				</ul>
				<!-- /NAV -->
			</div>
			<!-- /responsive-nav -->
		</div>
		<!-- /container -->
	</nav>
	<!-- /NAVIGATION -->

	<!-- Affichage -->
	<div class="container affichageAdmin" id="affichageAdmin" style="margin-top:50px;">

	</div>

	<!-- jQuery Plugins -->
	<script src="../client/js/jquery.min.js"></script>
	<script src="../client/js/bootstrap.min.js"></script>
	<script src="../client/js/slick.min.js"></script>
	<script src="../client/js/nouislider.min.js"></script>
	<script src="../client/js/jquery.zoom.min.js"></script>
	<script src="../client/js/main.js"></script>


</body>

</html>