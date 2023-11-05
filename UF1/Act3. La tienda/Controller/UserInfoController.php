<?php
require_once('../Database/database.php');

class UserInfoController {
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
    FUNCTION cambiarInfoUsuario($nick, $email, $pass)
    Cambia la información de un usuario dado su nombre de usuario (nick).
    */
    public function cambiarInfoUsuario($nick, $email, $pass) {
        $existe = $this->comprobarUsuarioExiste($nick);

        if ($existe != 0){
            $hash = $this->ecryptPassword($pass);

            $sql = 'UPDATE usuarios
            SET email = "' . $email . '",
            contra = "' . $hash . '"
            WHERE nick = "' . $nick . '"';

            $query = mysqli_query($this->con, $sql);
    
            if ($query) {
                return '
                <h1>Información modificada!</h1>
                ';
            }

        } else {
            return '
            <h1>El usuario no existe!</h1>
            ';
        }
    }

    /*
    FUNCTION comprobarUsuarioExiste($nick)
    Comprueba si un usuario con el nick proporcionado existe en la base de datos.
    */
    public function comprobarUsuarioExiste($nick) {
        // Consulta SQL que retorna el número de filas con el nick que se pasa por parámetro.
        $sql = 'SELECT COUNT(*) FROM usuarios WHERE nick = "' . $nick . '"';

        // Ejecuta la consulta SQL
        $rows = mysqli_query($this->con, $sql);

        // Obtiene la primera fila del resultado de la consulta.
        $row = mysqli_fetch_assoc($rows);

        // Retorna si el usuario existe o no
        return $row['COUNT(*)'];
    }

    /*
    FUNCTION ecryptPassword($pass)
    Encripta la contraseña que se pasa por parámetro utilizando una función hash.
    */
    public function ecryptPassword($pass) {
        return password_hash($pass, PASSWORD_DEFAULT);
    }
}
?>
