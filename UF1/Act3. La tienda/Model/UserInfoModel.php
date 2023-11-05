<?php

// Importa el controlador relacionado con la gestión de información de usuario.
require_once('../Controller/UserInfoController.php');

class UserInfoModel {
    private $u_controller;

    public function __construct() {
        // Crea una instancia del controlador de información de usuario.
        $this->u_controller = new UserInfoController;
    }

    /*
    FUNCTION cambiarInfoUsuario($nick, $email, $pass)
    Cambia la información de un usuario, como su email y contraseña.
    */
    public function cambiarInfoUsuario($nick, $email, $pass) {
        // Llama al método del controlador para cambiar la información del usuario.
        $msg = $this->u_controller->cambiarInfoUsuario($nick, $email, $pass);
        // Imprime el mensaje resultante.
        echo $msg;
    }
}
