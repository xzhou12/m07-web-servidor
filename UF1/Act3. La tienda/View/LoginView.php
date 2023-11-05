<?php
// Importa el modelo de usuarios.
require_once('Model/UsersModel.php');

// Crea una instancia del modelo de usuarios.
$u_model = new UsersModel;

// Verifica si se ha enviado un formulario de registro.
if (isset($_POST['register'])) {
    // Captura los datos del formulario de registro.
    $nick = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $c_pass = $_POST['confirm_password'];

    // Llama al modelo para registrar al usuario con los datos proporcionados.
    $u_model->addRegister($nick, $email, $pass, $c_pass);
} 
// Verifica si se ha enviado un formulario de inicio de sesión.
elseif (isset($_POST['login'])) {
    // Captura los datos del formulario de inicio de sesión.
    $nick = $_POST['name'];
    $pass = $_POST['password'];

    // Llama al modelo para realizar el inicio de sesión con los datos proporcionados.
    $u_model->login($nick, $pass);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        .box {
            display: flex;
            flex-direction: row;
            gap: 50px;
        }
    </style>
    <h1>ACCEDE A TU CUENTA</h1>
    <div class="box">
        <div>
            <h3>No tienes cuenta? Registrate</h3>
            <form method="POST">
                <label for="name">Nick:</label><br>
                <input type="text" name="name" id="name" required><br><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required><br><br>
                <label for="password">Contraseña:</label><br>
                <input type="password" name="password" id="password" required><br><br>
                <label for="confirm_password">Confirma contraseña:</label><br>
                <input type="password" name="confirm_password" id="confirm_password" required><br><br>
                <input type="submit" value="Registrarse" name="register">
            </form>
        </div>
        <div>
            <h3>Ya tienes cuenta? Accede a ella</h3>
            <form method="POST">
                <label for="name">Nick:</label><br>
                <input type="text" name="name" id="name" required><br><br>
                <label for="password">Contraseña:</label><br>
                <input type="password" name="password" id="password" required><br><br>
                <input type="submit" value="Acceder" name="login">
            </form>
        </div>
    </div>
    <br>
    <br>
</body>
</html>