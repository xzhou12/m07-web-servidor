<?php

// Importa el controlador relacionado con la gestión de productos.
require_once("../Controller/AdminProductController.php");

class AdminProductModel {
    private $adminP_controller;

    public function __construct() {
        // Crea una instancia del controlador de productos.
        $this->adminP_controller = new AdminProductController;
    }

    /*
    FUNCTION addProduct($name, $stock, $price, $category)
    Agrega un nuevo producto con el nombre, stock, precio y categoría especificados.
    */
    public function addProduct($name, $stock, $price, $category) {
        // Llama al método del controlador para agregar un producto.
        $msg = $this->adminP_controller->addProduct($name, $stock, $price, $category);
        // Imprime el mensaje resultante.
        echo $msg;
    }

    /*
    FUNCTION modifyProduct($name, $stock, $price, $category)
    Modifica un producto existente con el nombre, stock, precio y categoría especificados.
    */
    public function modifyProduct($name, $stock, $price, $category) {
        // Llama al método del controlador para modificar un producto.
        $msg = $this->adminP_controller->modifyProduct($name, $stock, $price, $category);
        // Imprime el mensaje resultante.
        echo $msg;
    }

    /*
    FUNCTION showProducts()
    Muestra todos los productos disponibles.
    */
    public function showProducts() {
        // Obtiene la lista de productos del controlador.
        $products = $this->adminP_controller->getProducts();
        // Requiere la vista que mostrará los productos y finaliza el script.
        require_once('../View/ShowProducts.php');
        die(); // El script se detiene después de mostrar los productos.
    }

    /*
    FUNCTION deleteProduct($name)
    Elimina un producto existente con el nombre especificado.
    */
    public function deleteProduct($name) {
        // Llama al método del controlador para eliminar un producto.
        $msg = $this->adminP_controller->deleteProduct($name);
        // Imprime el mensaje resultante.
        echo $msg;
    }

}
