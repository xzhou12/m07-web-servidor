<?php
// Llama al modelo y al controlador de cursos
require_once('Model/Model.php');
require_once('CursosController.php');

class AlumnosController {
    private $model;
    private $con;
    private $curso_controller;

    // Inicializa las variables/clases que se usarán más adelante
    public function __construct() {
        $this->model = new Model();
        $this->curso_controller = new CursosController();
        $this->con = $this->model->getDatabase();
    }

    /*
    FUNCTION addAlumnos()
    Añade los alumnos
    */
    public function addAlumnos() {
        // Selecciona los campos del formulario
        $nombre = $_POST['name'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $curso = $_POST['curso'];

        // Comprueba si el curso existe
        $existe = $this->curso_controller->comprobarCurso($curso);

        // Si existe
        if ($existe != 0) {

            // Hace el insert
            $sql = 'INSERT INTO alumnos VALUES ("'. $nombre .'", "'. $apellidos . '", "' . $dni . '","' . $curso . '")';
            $query = mysqli_query($this->con, $sql);

            if ($query) {
                // Si se ha hecho el insert, muestra que se han añadido
                $this->model->mostrarDatosAdded();
            } else {
                // Si no, salta error
                echo 'Error';
                $this->model->mostrarBotonVolver();
            }
        } else {
            // Si el curos no existe, muestra que no existe y un botón para volver
            echo '<h1>El curso ya existe</h1>';
            $this->model->mostrarBotonVolver();
        }
        
    }

     /*
    FUNCTION mostrarAlumnos()
    Muestra todos los alumnos
    */
    public function mostrarAlumnos() {
        // Hace un query de todos los alumnos
        $sql = 'SELECT * FROM alumnos';
        $query = mysqli_query($this->con, $sql);

        // Y los pasa al modelo para mostrarlos en la vista
        $this->model->mostrarAlumnos($query);
    }
}
?>
