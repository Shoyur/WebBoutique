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
<body>
    <h2>MODIFICATION D'UN FILM</h2> 
        <?php
            $num = $_POST['nums'];
           
            $ficFilms = fopen("donnees/films.txt","a+");
            $ficFilmsTmp = fopen("donnees/films.tmp","a+");

            $trouve = false;
            $ligne = fgets($ficFilms);
            while(!feof($ficFilms)){
                $tab = explode(";", $ligne);
                if($tab[0] == $num){
                    $trouve = true;
                } else {
                    fputs($ficFilmsTmp, $ligne);
                }
                $ligne = fgets($ficFilms);
            }
            fclose($ficFilms);
            fclose($ficFilmsTmp);
            unlink("donnees/films.txt");// Supprimer le fichier
            rename("donnees/films.tmp", "donnees/films.txt");

            if($trouve){
                $msg =  "Film ".$num." a été supprimé";
            } else {
                $msg =  "Film ".$num." introuvable";
            }
            header('Location: ../index.php?msg='.$msg);
            exit; // Obligatoire
        ?>     
</body>
</html>
