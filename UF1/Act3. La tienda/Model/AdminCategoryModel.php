<?php

// Importa el controlador relacionado con la gestión de categorías.
require_once("../Controller/AdminCategoryController.php");

class AdminCategoryModel {
    private $adminC_controller;

    public function __construct() {
        // Crea una instancia del controlador de categorías.
        $this->adminC_controller = new AdminCategoryController;
    }

    /*
    FUNCTION addCategory($name, $desc)
    Agrega una nueva categoría con el nombre y la descripción especificados.
    */
    public function addCategory($name, $desc) {
        // Llama al método del controlador para agregar una categoría.
        $msg = $this->adminC_controller->addCategory($name, $desc);
        // Imprime el mensaje resultante.
        echo $msg;
    }

    /*
    FUNCTION modifyCategory($name, $desc)
    Modifica una categoría existente con el nombre y la descripción especificados.
    */
    public function modifyCategory($name, $desc) {
        // Llama al método del controlador para modificar una categoría.
        $msg = $this->adminC_controller->modifyCategory($name, $desc);
        // Imprime el mensaje resultante.
        echo $msg;
    }

    /*
    FUNCTION showCategories()
    Muestra todas las categorías disponibles.
    */
    public function showCategories() {
        // Obtiene la lista de categorías del controlador.
        $categories = $this->adminC_controller->getCategories();
        // Requiere la vista que mostrará las categorías y finaliza el script.
        require_once('../View/ShowCategories.php');
        die(); // El script se detiene después de mostrar las categorías.
    }

    /*
    FUNCTION deleteCategory($name)
    Elimina una categoría existente con el nombre especificado.
    */
    public function deleteCategory($name) {
        // Llama al método del controlador para eliminar una categoría.
        $msg = $this->adminC_controller->deleteCategory($name);
        // Imprime el mensaje resultante.
        echo $msg;
    }

}
