<?php

session_start();
require_once './controllers/authController.php';

$controller = new AuthController();
$controller->handleRequest();

?>