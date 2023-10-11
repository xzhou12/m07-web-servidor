<?php
// Llamada al modelo
require_once('Model/Model.php');

class CursosController {
    private $model;
    private $con;

    public function __construct() {
        $this->model = new Model();
        $this->con = $this->model->getDatabase();
    }

    /*
    FUNCTION mostrarFormulario()
    Llama al modelo para mostrar el formulario
    */
    public function mostrarFormulario() {
        $this->model->mostrarFormulario();
    }

    /*
    FUNCTION addCursos()
    Añade cursos a la base de datos
    */
    public function addCursos() {
        // Selecciona los campos del formulario
        $nombre = $_POST['name'];
        $year = $_POST['year'];

        // Comprueba si existe el curso
        $existe = $this->comprobarCurso($nombre);

        if ($existe == 0) { 
            // Si no existe hace el query del insert
            $sql = 'INSERT INTO cursos VALUES ("'. $nombre .'", '. $year . ')';
            $query = mysqli_query($this->con, $sql);

            // Comprueba si se ha hecho el query
            if ($query) {
                // Si se ha hecho muestra que se han hecho correctamente
                $this->model->mostrarDatosAdded();
            } else {
                // Si no, muestra error
                echo 'Error';
                $this->model->mostrarBotonVolver();
            }
        } else {
            // Si ya existe, muestra que existe y también un botón para volver
            echo '<h1>El curso ya existe</h1>';
            $this->model->mostrarBotonVolver();
        }
    }

    /*
    FUNCTION comprobarCurso()
    Comprueba la existencia del curso
    */
    public function comprobarCurso($curso) {

        // Cuenta los rows que existen con el mismo nombre que se le pasa por parametro
        $sql = 'SELECT COUNT(*) FROM cursos WHERE nombre = ' . $curso . '';
        $rows = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_assoc($rows);

        // Retorna las filas contadas
         return $row['COUNT(*)'];
    }

    /*
    FUNCTION mostrarCursos()
    Selecciona todos los cursos y las manda al modelo para mostrarlas
    */
    public function mostrarCursos() {
        // Hace un select de todos los cursos para mostrarlos
        $sql = 'SELECT * FROM cursos';
        $query = mysqli_query($this->con, $sql);

        // Y las pasa al modelo para mostrarlos
        $this->model->mostrarCursos($query);
    }

    /*
    FUNCTION deleteCurso()
    Elimina los cursos y sus alumnos
    */
    public function deleteCurso() {
        // Selecciona los campos del formulario
        $nombre = $_POST['nameDelete'];

        // Comprueba si el curso existe
        $existe = $this->comprobarCurso($nombre);
        if ($existe != 0) {
            // Si existe, elimina los alumnos
            $sql = 'DELETE FROM alumnos WHERE curso = "' . $nombre .'"';
            $query1 = mysqli_query($this->con, $sql);

            // Y elimina el curso
            $sql = 'DELETE FROM cursos WHERE nombre = "' . $nombre .'"';
            $query2 = mysqli_query($this->con, $sql);

            // Comprueba si ha salido bien los dos querys
            if ($query1 && $query2) {
                $this->model->mostrarDatosEliminados();
            } else {
                // Si ha salido mal, muestra que ha habido un error.
                echo '<h1>Ha ocurrido un error al borrar</h1>';
            $this->model->mostrarBotonVolver();
            }
        } else {
            echo '<h1>El curso no existe</h1>';
            $this->model->mostrarBotonVolver();
        }
    }
}
?>
