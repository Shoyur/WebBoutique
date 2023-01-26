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
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administration</title>
</head>
<body>
	<h2 class="">Future page pour administrer les produits du site...</h2>
</body>
</html>