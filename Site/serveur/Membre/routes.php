<?php
    declare (strict_types=1);

    require_once(__DIR__."/ControleurMembre.php");
   
    $instanceCtrl = ControleurMembre::getControleurMembre();
    echo $instanceCtrl->do();
?>