<?php
    declare (strict_types=1);

    require_once(__DIR__."/ControleurProduit.php");
   
    $instanceCtrl = ControleurProduit::getControleurProduit();
    echo $instanceCtrl->do();
?>