<?php
require_once('../Database/database.php');

class AdminProductController {
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
    FUNCTION addProduct($name, $stock, $price, $category)
    Agrega un nuevo producto a la base de datos.
    */
    public function addProduct($name, $stock, $price, $category) {
        $existe = $this->comprobarProductoExiste($name);
        $Cexiste = $this->comprobarCategoriaExiste($category);

        if ($existe == 0) {
            if ($Cexiste != 0) {
                // Consulta SQL para insertar un nuevo producto en la base de datos
                $sql = 'INSERT INTO productos(nombre, stock, precio, categoria)
                VALUES ("' . $name .'", " ' . $stock . '", "' . $price . '", "' . $category .'")';

                $query = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

                if ($query) {
                    return '<h1>Producto añadido!</h1>';
                }
            } else {
                return '<h1>La categoría no existe!</h1>';
            }
        } else {
            return '<h1>El producto ya existe!</h1>';
        }
    }

    /*
    FUNCTION comprobarProductoExiste($name)
    Comprueba si el producto que se pasa por parámetro existe en la base de datos y devuelve el número de coincidencias.
    */
    public function comprobarProductoExiste($name) {
        // Consulta SQL que cuenta el número de filas con el nombre proporcionado como parámetro
        $sql = 'SELECT COUNT(*) FROM productos WHERE nombre = "' . $name . '"';

        $rows = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

        $row = mysqli_fetch_assoc($rows); // Obtiene la primera fila del resultado de la consulta

        // Retorna si el producto existe o no
        return $row['COUNT(*)'];
    }

    /*
    FUNCTION comprobarCategoriaExiste($category)
    Comprueba si la categoría que se pasa por parámetro existe en la base de datos y devuelve el número de coincidencias.
    */
    public function comprobarCategoriaExiste($category) {
        // Consulta SQL que cuenta el número de filas con el ID de la categoría proporcionado como parámetro
        $sql = 'SELECT COUNT(*) FROM categorias WHERE id = "' . $category . '"';

        $rows = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

        $row = mysqli_fetch_assoc($rows); // Obtiene la primera fila del resultado de la consulta

        // Retorna si la categoría existe o no
        return $row['COUNT(*)'];
    }

    /*
    FUNCTION modifyProduct($name, $stock, $price, $category)
    Modifica la información de un producto existente en la base de datos.
    */
    public function modifyProduct($name, $stock, $price, $category) {
        $existe = $this->comprobarProductoExiste($name);
        $Cexiste = $this->comprobarCategoriaExiste($category);

        if ($existe != 0 && $Cexiste != 0) {
            // Consulta SQL para actualizar la información de un producto
            $sql = 'UPDATE productos
            SET nombre = "' . $name .'",
            stock = "' . $stock . '",
            precio = "' . $price . '",
            categoria = "' . $category .'"';

            $query = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

            if ($query) {
                return '<h1>Producto modificado!</h1>';
            }
        } else {
            return '<h1>El producto/categoría no existe!</h1>';
        }
    }

    /*
    FUNCTION getProducts()
    Obtiene todos los productos almacenados en la base de datos.
    */
    public function getProducts() {
        // Consulta SQL para obtener todos los productos
        $sql = 'SELECT * FROM productos';
        $query = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

        return $query; // Retorna el resultado de la consulta
    }

    /*
    FUNCTION deleteProduct($name)
    Elimina un producto por su nombre de la base de datos.
    */
    public function deleteProduct($name) {
        // Consulta SQL para eliminar un producto por nombre
        $sql = 'DELETE FROM productos WHERE nombre = "' . $name . '"';
        $query = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

        if ($query) {
            return '<h1>Producto eliminado</h1>';
        } else {
            return '<h1>¡Oops! Ha ocurrido algún error!</h1>';
        }   
    }
}
?>
