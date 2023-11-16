<?php
//Llamada a la vista y a la bbdd
require_once("View/view.php");
require_once("Database/database.php");

class Model {
    private $view;
    private $db;

    public function __construct() {
        $this->view = new view();
        $this->db = new database();
    }

    /*
    FUNCTION getDatabase()
    Inicializa la base de datos y la retorna
    */
    public function getDatabase() {
        return $this->db->conectarBD();
    }

    /*
    FUNCTION mostrarFormulario()
    Llama a la vista para mostrar el formulario
    */
    public function mostrarFormulario() {
        $this->view->mostrarFormulario();
    }

    /*
    FUNCTION mostrarDatosAdded()
    Llama a la vista para mostrar que los datos han sido
    añadidos
    */
    public function mostrarDatosAdded() {
        $this->view->mostrarDatosAddded();
    }

    /*
    FUNCTION mostrarCursos()
    Muestra los cursos en forma de tabla
    */
    public function mostrarCursos($query) {
        $this->view->mostrarTablaCursos($query);
    }

    /*
    FUNCTION mostrarAlumnos()
    Muestra los alumnos en forma de tabla
    */
    public function mostrarAlumnos($query) {
        $this->view->mostrarTablaAlumnos($query);
    }

    /*
    FUNCTION mostrarBotonVolver()
    Muestra un botón para vovler a la pagina principal
    */
    public function mostrarBotonVolver() {
        $this->view->mostrarBotonVolver();
    }

    /*
    FUNCTION mostrarDatosEliminados()
    Llama a la vista para mostrar que los datos han sido eliminados
    */
    public function mostrarDatosEliminados() {
        $this->view->mostrarDatosEliminados();
    }
}
?>
