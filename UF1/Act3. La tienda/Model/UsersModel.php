<?php

// Importa el controlador relacionado con la gestión de usuarios.
require_once("Controller/UsersController.php");

class UsersModel {
    private $u_controller;

    public function __construct() {
        // Crea una instancia del controlador de usuarios.
        $this->u_controller = new UsersController;
    }

    /*
    FUNCTION addRegister($nick, $email, $pass, $c_pass)
    Registra un nuevo usuario en la base de datos.
    */
    public function addRegister($nick, $email, $pass, $c_pass) {
        // Llama al método del controlador para registrar un nuevo usuario.
        $msg = $this->u_controller->addRegister($nick, $email, $pass, $c_pass);
        // Imprime el mensaje resultante.
        echo $msg;
    }

    /*
    FUNCTION login($nick, $pass)
    Realiza el proceso de inicio de sesión de un usuario.
    */
    public function login($nick, $pass) {
        // Llama al método del controlador para realizar el inicio de sesión.
        $login = $this->u_controller->login($nick, $pass);
        if ($login == true) {
            // Inicia una sesión si el inicio de sesión fue exitoso.
            session_start();
            $_SESSION['user'] = $nick;

            if ($nick == 'admin') {
                // Redirige a la página de inicio de administrador si el usuario es un administrador.
                header("Location: View/AdminHomepage.php");
            } else {
                // Redirige a la página de inicio regular si el usuario es un usuario estándar.
                header("Location: View/Homepage.php");
            }
        } else {
            // Muestra un mensaje de error si el inicio de sesión falla.
            die('Oops! Ha habido algún error.');
        }
    }
}
