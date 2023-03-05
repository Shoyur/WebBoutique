<?php
    declare (strict_types=1);

    require_once(__DIR__."/ControleurAuth.php");
   
    $instanceCtrl = ControleurAuth::getControleurAuth();
    echo $instanceCtrl->do();
?>