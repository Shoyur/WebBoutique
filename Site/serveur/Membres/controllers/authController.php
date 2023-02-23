<?php

require_once './models/connecter.php';

class AuthController {

    private $model;

    public function __construct() {
        $this->model = new ConnecterModel();
    }

    public function handleRequest() {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'connecter':
                    $model->connecter($_POST['email'], $_POST['mdp']);
                break;
                case 'deconnecter':
                    $this->logout();
                break;
            }
        }
    }
}

?>