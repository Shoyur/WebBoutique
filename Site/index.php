<?php
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple</title>
    <link rel="stylesheet" href="client/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="client/css/style.css">
    <script src="client/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="client/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="client/js/global.js"></script>
</head>
<body onLoad="initialiser(<?php echo "'".$msg."'" ?>);">
    <?php require_once('serveur/includes/nav-accueil.inc.php'); ?>
    <div class="container">
        <?php require_once('serveur/lister.php'); ?>
    </div>
    <!-- Modal enregistrer -->       
        <div class="modal fade" id="modalEnregistrer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrer un film</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="msgErrEnreg"></span>
                        <form class="row g-3" action="serveur/enregistrer.php" method="POST" onSubmit="return validerFormEnreg();">
                            <div class="col-md-12">
                                <label for="titre" class="form-label">Numéro</label>
                                <input type="number" min=1 class="form-control is-valid" id="num" name="num" required>
                            </div>
                            <div class="col-md-12">
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" class="form-control is-valid" id="titre" name="titre" required>
                            </div>
                            <div class="col-md-12">
                                <label for="res" class="form-label">Réalisateur</label>
                                <input type="text" class="form-control is-valid" id="res" name="res" required>
                            </div>
                            <div class="col-md-12">
                                <label for="duree" class="form-label">Durée</label>
                                <input type="number" min=30 max=240 class="form-control is-valid" id="duree" name="duree" required>
                            </div>
                            <br/>
                            <div class="col-6">
                                <button class="btn btn-primary" type="submit">Enregistrer</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-danger" type="reset">Vider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Fin modal enregistrer -->
    <!-- Formulaire lister -->
        <form id="formLister" action="serveur/lister.php"  method="POST"></form>
    <!-- Fin formulaire lister -->
    <!-- Modal fiche -->
    <div class="modal fade" id="modalFiche" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier un film</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgErrFiche"></span>
                    <form class="row g-3" action="serveur/fiche.php" method="POST">
                        <div class="col-md-12">
                            <label for="titre" class="form-label">Numéro</label>
                            <input type="number" min=1 class="form-control is-valid" id="numf" name="numf" required>
                        </div>
                        <br />
                        <div class="col-6">
                            <button class="btn btn-primary" type="submit">Envoyer</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger" type="reset">Vider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal supprimer -->
    <div class="modal fade" id="modalSupprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer un film</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgErrFiche"></span>
                    <form class="row g-3" action="serveur/supprimer.php" method="POST">
                        <div class="col-md-12">
                            <label for="titre" class="form-label">Numéro</label>
                            <input type="number" min=1 class="form-control is-valid" id="nums" name="nums" required>
                        </div>
                        <br />
                        <div class="col-6">
                            <button class="btn btn-primary" type="submit">Envoyer</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger" type="reset">Vider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Pour les toast de Bootstrap -->
    <div class="toast-container posToast">
		<div id="toast" class="toast  align-items-center text-white bg-danger border-0" data-bs-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
			<img src="client/images/message.png" width=24 height=24 class="rounded me-2" alt="message">
			<strong class="me-auto">Messages</strong>
			<small class="text-muted"></small>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div id="textToast" class="toast-body">
			</div>
		</div>
    </div>
</body>
</html>