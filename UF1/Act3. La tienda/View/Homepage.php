<?php

// Inicia la sesión para trabajar con datos de sesión.
session_start();

// Importa el modelo relacionado con productos.
require_once('../Model/ProductsModel.php');
$p_model = new ProductsModel;

// Procesa las solicitudes según las acciones enviadas a través de formularios.
if (isset($_POST['confirm_logout'])) {
    // Si se solicita el cierre de sesión, se destruye la sesión y se redirige a la página de inicio.
    session_destroy();
    header('Location: ../index.php');
} elseif (isset($_GET['verProductos'])) {
    // Si se solicita ver todos los productos, se llama al modelo correspondiente.
    $p_model->showProducts();
} elseif (isset($_GET['verProductosPrecio'])) {
    // Si se solicita ver todos los productos ordenados por precio, se llama al modelo correspondiente.
    $p_model->showProductsPrice();
} elseif (isset($_POST['addProductoCarrito'])) {
    // Si se envía un formulario para agregar un producto al carrito, se capturan los datos y se llama al modelo correspondiente.
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];
    $p_model->addToCart($id, $cantidad);
} elseif (isset($_GET['showCarrito'])) {
    // Si se solicita ver el contenido del carrito, se llama al modelo correspondiente.
    $p_model->showCarrito();
} elseif (isset($_POST['deleteCarritoProduct'])) {
    // Si se envía un formulario para eliminar un producto del carrito, se captura el ID del producto y se llama al modelo correspondiente.
    $id = $_POST['id'];
    $p_model->deleteCarritoProduct($id);
} elseif (isset($_POST['changeInfo'])) {
    // Si se envía un formulario para cambiar la información del usuario, se importa el modelo relacionado con la información del usuario, se capturan los datos y se llama al modelo correspondiente.
    require_once('../Model/UserInfoModel.php');
    $u_model = new UserInfoModel;
    $nick = $_SESSION['user'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $u_model->cambiarInfoUsuario($nick, $email, $pass);
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
        .right {
            position: absolute;
            right: 2rem;
            top: 2rem;
        }

        .show {
            display: none;
        }

        .right form:last-child {
            margin-top: 2rem;
        }
        .flex {
            display: flex;
            gap: 50px;
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

    <div class="right">
        <form method="POST">
            <input type="submit" value="Cerrar Sesión" name="logout" class="form-logout">
        </form>
        <form method="POST" class="confirm-logout show">
            <input type="submit" value="Confirmar cerrar sesión" name="confirm_logout">
        </form>

    </div>
    
    <h2>Ver productos!</h2>
    <div class="flex">
        <form method="get">
            <label for="verProductos">Ver productos</label><br><br>
            <input type="submit" value="Ver" name="verProductos">
        </form>
        <form method="get">
            <label for="verProductosPrecio">Ver productos ordenados por precio</label><br><br>
            <input type="submit" value="Ver" name="verProductosPrecio">
        </form>
    </div>

    <br>
    <br>

    <h2>Carrito!</h2>
    <div class="flex">
        <div>
            <h3>Añadir productos al carrito</h3>
            <form method="post">
                <label for="id">ID del producto:</label><br>
                <input tpye="number" name="id" id="id"><br><br>
                <label for="cantidad">Cantidad:</label><br>
                <input tpye="number" name="cantidad" id="cantidad"><br><br>
                <input type="submit" value="Añdir al carrito" name="addProductoCarrito">
            </form>
        </div>
        
        <div>
            <h3>Ver carrito</h3>
            <form method="get">
                <input type="submit" value="Ver carrito" name="showCarrito">
            </form>
            <br>
            <h3>Eliminar producto del carrito</h3>
            <form method="post">
                <label for="id">ID producto carrito:</label><br>
                <input tpye="number" name="id" id="id"><br><br>
                <input type="submit" value="Eliminar" name="deleteCarritoProduct">
            </form>
        </div>
    </div>

    <br>
    <br>

    <h2>Información personal!</h2>
    <div class="flex">
        <div>
            <h3>Cambiar información personal</h3>
            <form method="post">
                <label for="email">Correo electronico:</label><br>
                <input tpye="email" name="email" id="email"><br><br>
                <label for="pass">Contraseña:</label><br>
                <input tpye="password" name="pass" id="pass"><br><br>
                <input type="submit" value="Cambiar información" name="changeInfo">
            </form>
        </div>
    </div>

    <br>
    <br>
</body>
</html>