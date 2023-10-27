<?php
require_once("Controller/UsersController.php");

class UsersModel {
    private $u_controller;

    public function __construct() {
        $this->u_controller = new UsersController;
    }

    public function addRegister($nick, $email, $pass, $c_pass) {
        $msg = $this->u_controller->addRegister($nick, $email, $pass, $c_pass);
        echo $msg;
    }

}

//require_once("View/LoginView.php");