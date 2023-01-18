<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple</title>
    <link rel="stylesheet" href="../client/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../client/css/style.css">
    <script src="../client/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="../client/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../client/js/global.js"></script>
</head>
</body>
  <div class="container">
    <?php
        function envoyerFiche($tab){
            $rep = <<<REPONSE
                <form class="row g-3" action="modifier.php" method="POST" onSubmit="return validerFormEnreg();">
                            <div class="col-md-12">
                                <label for="num" class="form-label">Numéro</label>
                                <input type="number" class="form-control is-valid" id="num" name="num" value="$tab[0]" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" class="form-control is-valid" id="titre" name="titre" value="$tab[1]" required>
                            </div>
                            <div class="col-md-12">
                                <label for="res" class="form-label">Réalisateur</label>
                                <input type="text" class="form-control is-valid" id="res" name="res" value="$tab[2]" required>
                            </div>
                            <div class="col-md-12">
                                <label for="duree" class="form-label">Durée</label>
                                <input type="number" min=30 max=240 class="form-control is-valid" id="duree" name="duree" value=$tab[3] required>
                            </div>
                            <br/>
                            <div class="col-6">
                                <button class="btn btn-primary" type="submit">Modifier</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-danger" type="reset">Vider</button>
                            </div>
                </form>
            REPONSE;
            echo $rep;
        }

        $num = $_POST['numf'];
        $ficFilms = fopen("donnees/films.txt","r");
        $trouve = false;
        $ligne = fgets($ficFilms);
        while(!feof($ficFilms) && !$trouve){
            $tab = explode(";", $ligne);
            if($tab[0] == $num){
                $trouve = true;
            } else {
                $ligne = fgets($ficFilms);
            }
        }
         fclose($ficFilms);
        if($trouve){
            envoyerFiche($tab);
        } else {
            $msg =  "Film ".$num." introuvable";
            header('Location: ../index.php?msg='.$msg);
            exit; // Obligatoire
        }
    ?>
    <br> <a href="../index.php">Retour à la page d'accueil</a> 
</body>
</html>