<?php

// Importa el controlador relacionado con la gestión de productos.
require_once ('../Controller/ProductsController.php');

class ProductsModel {
    private $p_controller;

    public function __construct() {
        // Crea una instancia del controlador de productos.
        $this->p_controller = new ProductsController;
    }

    /*
    FUNCTION showProducts()
    Muestra todos los productos disponibles para los usuarios.
    */
    public function showProducts() {
        // Obtiene la lista de productos del controlador.
        $products = $this->p_controller->getProducts();
        // Requiere la vista que mostrará los productos y finaliza el script.
        require_once('../View/ShowProductsUser.php');
        exit();
    }

    /*
    FUNCTION showProductsPrice()
    Muestra todos los productos ordenados por precio para los usuarios.
    */
    public function showProductsPrice() {
        // Obtiene la lista de productos ordenados por precio del controlador.
        $products = $this->p_controller->getProductsPrice();
        // Requiere la vista que mostrará los productos y finaliza el script.
        require_once('../View/ShowProductsUser.php');
        exit();
    }

    /*
    FUNCTION addToCart($id, $cantidad)
    Agrega un producto al carrito de compras con la cantidad especificada.
    */
    public function addToCart($id, $cantidad) {
        // Llama al método del controlador para agregar un producto al carrito.
        $msg = $this->p_controller->addToCart($id, $cantidad);
        // Imprime el mensaje resultante.
        echo $msg;
    }

    /*
    FUNCTION showCarrito()
    Muestra el contenido del carrito de compras.
    */
    public function showCarrito() {
        // Obtiene el contenido del carrito de compras del controlador.
        $carrito = $this->p_controller->getCarrito();
        // Requiere la vista que mostrará el carrito y finaliza el script.
        require_once('../View/ShowCarrito.php');
        exit();
    }

    /*
    FUNCTION deleteCarritoProduct($id)
    Elimina un producto del carrito de compras por su ID.
    */
    public function deleteCarritoProduct($id) {
        // Llama al método del controlador para eliminar un producto del carrito.
        $msg = $this->p_controller->deleteCarritoProduct($id);
        // Imprime el mensaje resultante.
        echo $msg;
    }
}
