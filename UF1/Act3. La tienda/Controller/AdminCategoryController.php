<?php
require_once('../Database/database.php');

class AdminCategoryController {
    private $con;

    /*
    FUNCTION __construct()
    Constructor de la clase. Crea una instancia de la base de datos y establece una conexión a la misma.
    */
    public function __construct() {
        $this->con = new Database;
        $this->con = $this->con->conectarBD(); // Establece la conexión a la base de datos.
    }

    /*
    FUNCTION addCategory($name, $desc)
    Agrega una nueva categoría a la base de datos.
    */
    public function addCategory($name, $desc) {
        $existe = $this->comprobarCategoriaExiste($name);

        if ($existe == 0) {
            // Consulta SQL para insertar una nueva categoría en la base de datos
            $sql = 'INSERT INTO categorias(nombre, descripcion)
                VALUES ("'. $name .'", "' . $desc . '")';

            $query = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

            if ($query) {
                return '<h1>Categoría añadida!</h1>';
            }
        } else {
            return '<h1>La categoría ya existe!</h1>';
        }
    }

    /*
    FUNCTION comprobarCategoriaExiste($name)
    Comprueba si la categoría que se pasa por parámetro existe en la base de datos y devuelve el número de coincidencias.
    */
    public function comprobarCategoriaExiste($name) {
        // Consulta SQL que cuenta el número de filas con el nombre proporcionado como parámetro
        $sql = 'SELECT COUNT(*) FROM categorias WHERE nombre = "' . $name . '"';

        $rows = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

        $row = mysqli_fetch_assoc($rows); // Obtiene la primera fila del resultado de la consulta

        // Retorna cuántos resultados existen con el nombre proporcionado
        return $row['COUNT(*)'];
    }

    /*
    FUNCTION modifyCategory($name, $desc)
    Modifica la descripción de una categoría existente en la base de datos.
    */
    public function modifyCategory($name, $desc) {
        $existe = $this->comprobarCategoriaExiste($name);

        if ($existe != 0) {
            // Consulta SQL para actualizar la descripción de una categoría
            $sql = 'UPDATE categorias
            SET descripcion = "' . $desc . '"
            WHERE nombre = "' . $name . '"';

            $query = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

            if ($query) {
                return '<h1>Categoría modificada!</h1>';
            }
        } else {
            return '<h1>La categoría no existe!</h1>';
        }
    }

    /*
    FUNCTION getCategories()
    Obtiene todas las categorías almacenadas en la base de datos.
    */
    public function getCategories() {
        // Consulta SQL para obtener todas las categorías
        $sql = 'SELECT * FROM categorias';
        $query = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

        return $query; // Retorna el resultado de la consulta
    }

    /*
    FUNCTION deleteCategory($name)
    Elimina una categoría por su nombre de la base de datos.
    */
    public function deleteCategory($name) {
        // Consulta SQL para eliminar una categoría por nombre
        $sql = 'DELETE FROM categorias WHERE nombre = "' . $name . '"';
        $query = mysqli_query($this->con, $sql); // Ejecuta la consulta SQL

        if ($query) {
            return '<h1>Categoría eliminada</h1>';
        } else {
            return '<h1>¡Oops! Ha ocurrido algún error!</h1>';
        }   
    }
}
?>
