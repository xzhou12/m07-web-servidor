<?php
require_once('../Database/database.php');

class AdminUsersController {
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
    FUNCTION addRegister($nick, $email, $pass, $c_pass)
    Agrega un nuevo registro de usuario a la base de datos.
    */
    public function addRegister($nick, $email, $pass, $c_pass) {
        // Comprueba si el usuario ya existe
        $existe = $this->comprobarUsuarioExiste($nick);

        // Si el usuario no existe, registra al nuevo usuario
        if ($existe == 0) {
            // Comprueba si las contraseñas coinciden
            if ($pass == $c_pass) {
                // Encripta la contraseña
                $hash = $this->encryptPassword($pass);

                // Genera la consulta SQL para insertar el nuevo usuario en la base de datos
                $sql = 'INSERT INTO usuarios(nick, email, contra)
                VALUES ("'. $nick .'", "' . $email . '", "' . $hash . '")';

                // Ejecuta la consulta SQL
                $query = mysqli_query($this->con, $sql);

                // Si la consulta se ha ejecutado correctamente, informa al modelo de que la cuenta se ha creado
                if ($query) {
                    return '
                    <h1>Cuenta creada!</h1>
                    <h3>Inicia sesión para poder acceder a ella!</h3>
                    ';
                }
            } else {
                // Informa al modelo de que las contraseñas no coinciden
                return '
                <h1>Oops! Las contraseñas no coinciden</h1>
                ';
            }
        } else {
            // Informa al modelo de que el usuario ya existe
            return '
            <h1>Oops! El usuario ya existe</h1>
            ';
        }
    }

    /*
    FUNCTION comprobarUsuarioExiste($nick)
    Comprueba si el usuario con el nombre de usuario proporcionado ya existe en la base de datos.
    */
    public function comprobarUsuarioExiste($nick) {
        // Consulta SQL que retorna el número de filas con el nick proporcionado como parámetro
        $sql = 'SELECT COUNT(*) FROM usuarios WHERE nick = "' . $nick . '"';

        // Ejecuta la consulta SQL
        $rows = mysqli_query($this->con, $sql);

        // Obtiene la primera fila del resultado de la consulta.
        $row = mysqli_fetch_assoc($rows);

        // Retorna si el usuario existe o no
        return $row['COUNT(*)'];
    }

    /*
    FUNCTION encryptPassword($pass)
    Encripta la contraseña que se pasa por parámetro.
    */
    public function encryptPassword($pass) {
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    /*
    FUNCTION getPassword($nick)
    Obtiene la contraseña del usuario con el nombre de usuario proporcionado.
    */
    public function getPassword($nick) {
        // Consulta SQL que retorna la contraseña del usuario que se pasa por parámetro
        $sql = 'SELECT contra FROM usuarios WHERE nick = "' . $nick . '"';

        // Ejecuta la sentencia y devuelve el resultado
        $query = mysqli_query($this->con, $sql);
        return mysqli_fetch_assoc($query)['contra'];
    }

    /*
    FUNCTION modifyUser($nick, $email, $pass, $c_pass)
    Modifica la información de un usuario existente en la base de datos.
    */
    public function modifyUser($nick, $email, $pass, $c_pass) {
        // Comprueba si el usuario ya existe
        $existe = $this->comprobarUsuarioExiste($nick);

        if ($existe != 0) {
            // Comprueba si las contraseñas coinciden
            if ($pass == $c_pass) {
                // Encripta la contraseña
                $hash = $this->encryptPassword($pass);

                // Genera la consulta SQL para actualizar la información del usuario en la base de datos
                $sql = 'UPDATE usuarios
                    SET email = "' . $email . '", contra = "' . $hash . '" WHERE nick = "' . $nick . '"';

                // Ejecuta la consulta SQL
                $query = mysqli_query($this->con, $sql);

                // Si la consulta se ha ejecutado correctamente, informa al modelo de que la cuenta se ha creado
                if ($query) {
                    return '
                    <h1>Datos modificados!</h1>
                    ';
                }
            } else {
                // Informa al modelo de que las contraseñas no coinciden
                return '
                <h1>Oops! Las contraseñas no coinciden</h1>
                ';
            }
        } else {
            return '
            <h1>Oops! El usuario no existe</h1>
            ';
        }
    }

    /*
    FUNCTION getUsers()
    Obtiene todos los usuarios almacenados en la base de datos.
    */
    public function getUsers() {
        $sql = 'SELECT * FROM usuarios';
        $query = mysqli_query($this->con, $sql);

        return $query;
    }

    /*
    FUNCTION deleteUser($nick)
    Elimina un usuario por su nombre de usuario de la base de datos.
    */
    public function deleteUser($nick) {
        // Consulta SQL para eliminar un usuario por nombre de usuario
        $sql = 'DELETE FROM usuarios WHERE nick = "' . $nick . '"';
        $query = mysqli_query($this->con, $sql);

        if ($query) {
            return '<h1>Usuario eliminado</h1>';
        } else {
            return '
            <h1>Oops! Ha ocurrido algún error!</h1>
            ';
        }
    }
}
?>
