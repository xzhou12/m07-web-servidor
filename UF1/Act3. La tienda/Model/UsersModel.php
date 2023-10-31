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

    public function login($nick, $pass) {
        $login = $this->u_controller->login($nick, $pass);
        if ($login == true) {
            session_start();
            $_SESSION['user'] = $nick;

            if ($nick == 'admin') {
                header("Location: View/Homepage.php");
            } else {
                header("Location: View/Homepage.php");
            }
        } else {
            die('Oops! Ha habido algun error!');
        }
    }

}