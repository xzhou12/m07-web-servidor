<?php
require_once('../Model/AdminUsersModel.php');
$adminU_model = new AdminUsersModel;

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    session_destroy();
    header("Location: index.php");
}

if (isset($_POST['confirm_logout'])) {
    session_destroy();
    header('Location: ../index.php');
} elseif (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $c_pass = $_POST['confirm_password'];

    $adminU_model->addRegister($name, $email, $pass, $c_pass);
} elseif (isset($_POST['modify'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $c_pass = $_POST['confirm_password'];

    $adminU_model->modifyUser($name, $email, $pass, $c_pass);
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
        .left {
            position: absolute;
            right: 4rem;
            top: 2rem;
        }

        .show {
            display: none;
        }

        form:last-child {
            margin-top: 2rem;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let logout = document.querySelector('.form-logout');

            if(logout) {
                logout.addEventListener('click', function(event) {
                    event.preventDefault();
                    let confirm = document.querySelector('.confirm-logout');

                    if (confirm.classList.contains('show')) {
                        confirm.classList.remove('show');
                    } else {
                        confirm.classList.add('show');
                    }
                });
            }
        });
    </script>
    
    <h1>Admin Dashboard!</h1>
    <h1>Bienvenido <?php echo $_SESSION['user']?> !</h1>

    <div class="left">
        <form method="POST">
            <input type="submit" value="Cerrar Sesión" name="logout" class="form-logout">
        </form>
        <form method="POST" class="confirm-logout show">
            <input type="submit" value="Confirmar cerrar sesión" name="confirm_logout">
        </form>
    </div>

    <br>
    <br>

    <div>
        <div>
            <h2>USUARIOS!</h2>
            <h3>Añadir/Modificar usuarios</h3>
            <p>Introduzca el nick del usuario a modificar con su nueva información</p>
            <form method="POST">
                <label for="name">Nick:</label><br>
                <input type="text" name="name" id="name" required><br><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required><br><br>
                <label for="password">Contraseña:</label><br>
                <input type="password" name="password" id="password" required><br><br>
                <label for="confirm_password">Confirma contraseña:</label><br>
                <input type="password" name="confirm_password" id="confirm_password" required><br><br>
                <input type="submit" value="Registrar" name="register">
                <input type="submit" value="Modificar" name="modify">
            </form>
        </div>
    </div>


    

    <br>
    <br>
</body>
</html>