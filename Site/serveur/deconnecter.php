<?php

    session_start();

    unset($_SESSION['statut_m']);
    header('Location: ../index.php');
    exit;

?>