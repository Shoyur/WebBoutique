	<!-- NAVIGATION -->
	<nav id="navigation">
		<div class="container">
			<div id="responsive-nav">
				<ul class="main-nav nav navbar-nav">
					<li><a href='admin.php?page=1'>Gestion des produits</a></li>
					<li class="active"><a href='#'>Gestion des membres</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- /NAVIGATION -->

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

<?php echo '<script type="text/javascript">requeteAdminServeur("listerActivations");</script>'; ?>