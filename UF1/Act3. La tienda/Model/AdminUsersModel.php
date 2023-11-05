<?php

// Importa el controlador relacionado con la gestión de usuarios.
require_once("../Controller/AdminUsersController.php");

class AdminUsersModel {
    private $adminU_controller;

    public function __construct() {
        // Crea una instancia del controlador de usuarios.
        $this->adminU_controller = new AdminUsersController;
    }

    /*
    FUNCTION addRegister($nick, $email, $pass, $c_pass)
    Registra un nuevo usuario con el nombre de usuario, correo electrónico y contraseñas proporcionados.
    */
    public function addRegister($nick, $email, $pass, $c_pass) {
        // Llama al método del controlador para registrar un usuario.
        $msg = $this->adminU_controller->addRegister($nick, $email, $pass, $c_pass);
        // Imprime el mensaje resultante.
        echo $msg;
    }

    /*
    FUNCTION modifyUser($nick, $email, $pass, $c_pass)
    Modifica los datos de un usuario existente con el nombre de usuario, correo electrónico y contraseñas proporcionados.
    */
    public function modifyUser($nick, $email, $pass, $c_pass) {
        // Llama al método del controlador para modificar un usuario.
        $msg = $this->adminU_controller->modifyUser($nick, $email, $pass, $c_pass);
        // Imprime el mensaje resultante.
        echo $msg;
    }

    /*
    FUNCTION showUsers()
    Muestra todos los usuarios registrados.
    */
    public function showUsers() {
        // Obtiene la lista de usuarios del controlador.
        $users = $this->adminU_controller->getUsers();
        // Requiere la vista que mostrará los usuarios y finaliza el script.
        require_once('../View/ShowUsers.php');
        die(); // El script se detiene después de mostrar los usuarios.
    }

    /*
    FUNCTION deleteUser($name)
    Elimina un usuario existente con el nombre de usuario especificado.
    */
    public function deleteUser($name) {
        // Llama al método del controlador para eliminar un usuario.
        $msg = $this->adminU_controller->deleteUser($name);
        // Imprime el mensaje resultante.
        echo $msg;
    }

}
