<?php
/*
 // Debes asegurarte de iniciar la sesión al principio de tu script

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header("Location: index.php");
    exit;
}
*/

session_start();

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
            right: 2rem;
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
</body>
</html>