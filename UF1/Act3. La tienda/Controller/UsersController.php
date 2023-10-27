<?php
class UsersController {
    private $con;

    /*
    FUNCTION __construct()
    Crea el objeto model y la conexión a la base de datos
    */
    public function __construct() {
        $this->con=Database::conectarBD();
    }

    /*
    FUNCTION addRegister()
    Añade un registro a la bbdd
    */
    public function addRegister($nick, $email, $pass, $c_pass) {

        // Comprueba si el usuario ya existe
        $existe = $this->comprobarUsuarioExiste($nick);

        // Si el usuario no existe, registra al nuevo usuario
        if ($existe == 0) {
            // Comprueba si las contraseñas coinciden
            if ($pass == $c_pass) {
                // Encripta la contraseña
                $hash = $this->ecryptPassword($pass);
    
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
    FUNCTION comprobarUsuarioExiste()
    Encrypta la contraseña que se le pasa por parametro
    */
    public function comprobarUsuarioExiste($nick) {
        // Consulta SQL que retorna el numero de filas con el nick que le pasamos por parametro
        $sql = 'SELECT COUNT(*) FROM usuarios WHERE nick = "' . $nick . '"';

        // Ejecuta la consulta SQL
        $rows = mysqli_query($this->con, $sql);

        // Obtiene la primera fila del resultado de la consulta.
        $row = mysqli_fetch_assoc($rows);

        // Retorna las filas contadas
        return $row['COUNT(*)'];
    }


    /*
    FUNCTION ecryptPassword()
    Encrypta la contraseña que se le pasa por parametro
    */
    public function ecryptPassword($pass) {
        return password_hash($pass, PASSWORD_DEFAULT);
    }
   
    
}
?>
