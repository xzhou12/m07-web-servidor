<?php
require_once('../Database/database.php');

class ProductsController {
    private $con;

    /*
    FUNCTION __construct()
    Constructor de la clase. Crea un objeto del modelo y establece la conexión a la base de datos.
    */
    public function __construct() {
        $this->con = new Database;
        $this->con = $this->con->conectarBD(); // Establece la conexión a la base de datos.
    }

    /*
    FUNCTION getProducts()
    Obtiene todos los productos almacenados en la base de datos.
    */
    public function getProducts() {
        $sql = 'SELECT * FROM productos';
        $query = mysqli_query($this->con, $sql);

        return $query; // Retorna el resultado de la consulta
    }

    /*
    FUNCTION getProductsPrice()
    Obtiene todos los productos ordenados por precio.
    */
    public function getProductsPrice() {
        $sql = 'SELECT * FROM productos ORDER BY precio';
        $query = mysqli_query($this->con, $sql);

        return $query; // Retorna el resultado de la consulta
    }

    /*
    FUNCTION addToCart($id, $cantidad)
    Agrega un producto al carrito de compra.
    */
    public function addToCart($id, $cantidad) {
        $existe = $this->comprobarProductoExiste($id);

        if ($existe != 0) {
            $stock = $this->comprobarProductoStock($id);

            if ($stock > 0 && $cantidad <= $stock) {
                $precio_total = $this->precioTotal($id, $cantidad);

                $sql = 'INSERT INTO carrito_compra(producto, cantidad, precio_total)
                VALUES("'. $id .'", "' . $cantidad . '", "' . $precio_total . '")';

                $query = mysqli_query($this->con, $sql);

                if ($query) {
                    $this->quitarProductoStock($id, $cantidad);
                    return '<h1>Producto/s añadidos al carrito!</h1>';
                }
            } else {
                return '<h1>No queda stock!</h1>';
            }
        } else {
            return '<h1>El producto no existe!</h1>';
        }
    }

    /*
    FUNCTION comprobarProductoExiste($id)
    Comprueba si el producto con el ID proporcionado existe en la base de datos.
    */
    public function comprobarProductoExiste($id) {
        $sql = 'SELECT COUNT(*) FROM productos
        WHERE id = "' . $id . '"';

        // Ejecuta la consulta SQL
        $rows = mysqli_query($this->con, $sql);

        // Obtiene la primera fila del resultado de la consulta.
        $row = mysqli_fetch_assoc($rows);

        // Retorna si el producto existe o no
        return $row['COUNT(*)'];
    }

    /*
    FUNCTION comprobarProductoStock($id)
    Obtiene la cantidad de stock disponible para un producto con el ID proporcionado.
    */
    public function comprobarProductoStock($id) {
        $sql = 'SELECT stock FROM productos
        WHERE id = "' . $id . '"';

        // Ejecuta la consulta SQL
        $query = mysqli_query($this->con, $sql);

        return mysqli_fetch_assoc($query)['stock'];
    }

    /*
    FUNCTION precioTotal($id, $cantidad)
    Calcula el precio total de un producto dado su ID y la cantidad deseada.
    */
    public function precioTotal($id, $cantidad) {
        $sql = 'SELECT precio FROM productos
        WHERE id = "' . $id . '"';

        // Ejecuta la consulta SQL
        $query = mysqli_query($this->con, $sql);
        $precio = mysqli_fetch_assoc($query)['precio'];

        return ($precio * $cantidad);
    }

    /*
    FUNCTION quitarProductoStock($id, $cantidad)
    Actualiza el stock de un producto después de agregarlo al carrito.
    */
    public function quitarProductoStock($id, $cantidad) {
        $sql = 'UPDATE productos
        SET stock = stock - ' . $cantidad .'
        WHERE id = "' . $id . '"';

        $query = mysqli_query($this->con, $sql);
    }

    /*
    FUNCTION addProductoStock($producto, $cantidad)
    Agrega stock a un producto después de eliminarlo del carrito.
    */
    public function addProductoStock($producto, $cantidad) {
        $sql = 'UPDATE productos
        SET stock = stock + ' . $cantidad .'
        WHERE id = "' . $producto . '"';

        $query = mysqli_query($this->con, $sql);
    }

    /*
    FUNCTION getCarrito()
    Obtiene todos los productos en el carrito de compra.
    */
    public function getCarrito() {
        $sql = 'SELECT * FROM carrito_compra';
        $query = mysqli_query($this->con, $sql);

        return $query; // Retorna el resultado de la consulta
    }

    /*
    FUNCTION deleteCarritoProduct($id)
    Elimina un producto del carrito de compra por su ID.
    */
    public function deleteCarritoProduct($id) {
        $existe = $this->comprobarCarritoExiste($id);

        if ($existe != 0) {
            $info_producto = $this->getInfoProductoCarrito($id);

            $producto = $info_producto['producto'];
            $cantidad = $info_producto['cantidad'];

            $sql = 'DELETE FROM carrito_compra
            WHERE id = "' . $id . '"';

            $query = mysqli_query($this->con, $sql);

            if ($query) {
                $this->addProductoStock($producto, $cantidad);
                return '<h1>Producto/s retirados del carrito!</h1>';
            }

        } else {
            return '<h1>El producto no existe!</h1>';
        }
    }

    /*
    FUNCTION comprobarCarritoExiste($id)
    Comprueba si un producto en el carrito de compra con el ID proporcionado existe.
    */
    public function comprobarCarritoExiste($id) {
        $sql = 'SELECT COUNT(*) FROM carrito_compra
        WHERE id = "' . $id . '"';

        // Ejecuta la consulta SQL
        $rows = mysqli_query($this->con, $sql);

        // Obtiene la primera fila del resultado de la consulta.
        $row = mysqli_fetch_assoc($rows);

        // Retorna si el producto existe o no
        return $row['COUNT(*)'];
    }

    /*
    FUNCTION getInfoProductoCarrito($id)
    Obtiene información del producto en el carrito de compra por su ID.
    */
    public function getInfoProductoCarrito($id) {
        $sql = 'SELECT producto, cantidad FROM carrito_compra
        WHERE id = "' . $id . '"';

        // Ejecuta la consulta SQL
        $query = mysqli_query($this->con, $sql);

        return mysqli_fetch_assoc($query);
    }
}
?>
