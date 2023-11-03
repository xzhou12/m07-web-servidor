<?php

require_once("../Controller/AdminUsersController.php");


class AdminUsersModel {
    private $adminU_controller;

    public function __construct() {
        $this->adminU_controller = new AdminUsersController;
    }

    public function addRegister($nick, $email, $pass, $c_pass) {
        $msg = $this->adminU_controller->addRegister($nick, $email, $pass, $c_pass);
        echo $msg;
    }

    public function modifyUser($nick, $email, $pass, $c_pass) {
        $msg = $this->adminU_controller->modifyUserr($nick, $email, $pass, $c_pass);
        echo $msg;
    }

    public function login($nick, $pass) {
        $login = $this->adminU_controller->login($nick, $pass);
        if ($login == true) {
            session_start();
            $_SESSION['user'] = $nick;

            if ($nick == 'admin') {
                header("Location: View/AdminHomepage.php");
            } else {
                header("Location: View/Homepage.php");
            }
        } else {
            die('Oops! Ha habido algun error!');
        }
    }

}