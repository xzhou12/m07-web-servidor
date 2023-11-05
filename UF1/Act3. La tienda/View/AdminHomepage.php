<?php

// Importa los modelos relacionados con la administración de usuarios, categorías y productos.
require_once('../Model/AdminUsersModel.php');
require_once('../Model/AdminCategoryModel.php');
require_once('../Model/AdminProductModel.php');

// Crea instancias de los modelos relacionados con la administración de usuarios, categorías y productos.
$adminU_model = new AdminUsersModel;
$adminC_model = new AdminCategoryModel;
$adminP_model = new AdminProductModel;

// Inicia la sesión.
session_start();

// Verifica si el usuario ha iniciado sesión como administrador.
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    // Si no ha iniciado sesión como administrador, se destruye la sesión y se redirige a la página de inicio.
    session_destroy();
    header("Location: index.php");
}

if (isset($_POST['confirm_logout'])) {
    // Si se solicita el cierre de sesión, se destruye la sesión y se redirige a la página de inicio.
    session_destroy();
    header('Location: ../index.php');

// ADMINISTRACIÓN DE USUARIOS
} elseif (isset($_POST['registerUser'])) {
    // Si se envía un formulario para registrar un usuario, se capturan los datos y se llama al modelo correspondiente.
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $c_pass = $_POST['confirm_password'];
    $adminU_model->addRegister($name, $email, $pass, $c_pass);
} elseif (isset($_POST['modifyUser'])) {
    // Si se envía un formulario para modificar un usuario, se capturan los datos y se llama al modelo correspondiente.
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $c_pass = $_POST['confirm_password'];
    $adminU_model->modifyUser($name, $email, $pass, $c_pass);
} elseif (isset($_GET['showUsers'])) {
    // Si se solicita mostrar todos los usuarios, se llama al modelo correspondiente.
    $adminU_model->showUsers();
} elseif (isset($_POST['deleteUser'])) {
    // Si se envía un formulario para eliminar un usuario, se captura el nombre del usuario y se llama al modelo correspondiente.
    $name = $_POST['name'];
    $adminU_model->deleteUser($name);

// ADMINISTRACIÓN DE CATEGORÍAS
} elseif (isset($_POST['addCategory'])) {
    // Si se envía un formulario para agregar una categoría, se capturan los datos y se llama al modelo correspondiente.
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $adminC_model->addCategory($name, $desc);
} elseif (isset($_POST['modCategory'])) {
    // Si se envía un formulario para modificar una categoría, se capturan los datos y se llama al modelo correspondiente.
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $adminC_model->modifyCategory($name, $desc);
} elseif (isset($_GET['showCategories'])) {
    // Si se solicita mostrar todas las categorías, se llama al modelo correspondiente.
    $adminC_model->showCategories();
} elseif (isset($_POST['deleteCategory'])) {
    // Si se envía un formulario para eliminar una categoría, se captura el nombre de la categoría y se llama al modelo correspondiente.
    $name = $_POST['name'];
    $adminC_model->deleteCategory($name);

// ADMINISTRACIÓN DE PRODUCTOS
} elseif (isset($_POST['addProduct'])) {
    // Si se envía un formulario para agregar un producto, se capturan los datos y se llama al modelo correspondiente.
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $adminP_model->addProduct($name, $stock, $price, $category);
} elseif (isset($_POST['modProduct'])) {
    // Si se envía un formulario para modificar un producto, se capturan los datos y se llama al modelo correspondiente.
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $adminP_model->modifyProduct($name, $stock, $price, $category);
} elseif (isset($_GET['showProducts'])) {
    // Si se solicita mostrar todos los productos, se llama al modelo correspondiente.
    $adminP_model->showProducts();
} elseif (isset($_POST['deleteProduct'])) {
    // Si se envía un formulario para eliminar un producto, se captura el nombre del producto y se llama al modelo correspondiente.
    $name = $_POST['name'];
    $adminP_model->deleteProduct($name);
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
            right: 4rem;
            top: 2rem;
        }

        .show {
            display: none;
        }

        form:last-child {
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

    <h1>Admin Dashboard! Bienvenido <?php echo $_SESSION['user']?> !</h1>

    <div class="right">
        <form method="POST">
            <input type="submit" value="Cerrar Sesión" name="logout" class="form-logout">
        </form>
        <form method="POST" class="confirm-logout show">
            <input type="submit" value="Confirmar cerrar sesión" name="confirm_logout">
        </form>
    </div>

    <br>

    <h2>USUARIOS!</h2>
    <div class="flex">
        <div>
            <h3>Añadir/Modificar usuarios</h3>
            <p> Para modificar: Introduzca el nick del usuario<br>
                a modificar con su nueva información</p>
            <form method="POST">
                <label for="name">Nick:</label><br>
                <input type="text" name="name" id="name" required><br><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required><br><br>
                <label for="password">Contraseña:</label><br>
                <input type="password" name="password" id="password" required><br><br>
                <label for="confirm_password">Confirma contraseña:</label><br>
                <input type="password" name="confirm_password" id="confirm_password" required><br><br>
                <input type="submit" value="Registrar" name="registerUser">
                <input type="submit" value="Modificar" name="modifyUser">
            </form>
        </div>
        <div>
            <h3>Mostrar todos los usuarios</h3>
            <form method="GET">
                <input type="submit" value="Mostrar" name="showUsers">
            </form>

            <h3>Eliminar usuario</h3>
            <form method="POST">
                <label for="name">Nick:</label><br>
                <input type="text" name="name" id="name" required><br><br>
                <input type="submit" value="Eliminar" name="deleteUser">
            </form>
        </div>
    </div>

    <br>

    <h2>CATEGORIAS!</h2>
    <div class="flex">
        <div>
            <h3>Añadir/Modificar categorias</h3>
            <p>Para modificar: Introduzca el nombre de la categoria a modificar<br>
                con su nueva información</p>
            <form method="POST">
                <label for="name">Nombre:</label><br>
                <input type="text" name="name" id="name" required><br><br>
                <label for="desc">Descripción:</label><br>
                <input type="text" name="desc" id="desc" required><br><br>
                <input type="submit" value="Añadir" name="addCategory">
                <input type="submit" value="Modificar" name="modCategory">
            </form>
        </div>
        <div>
            <h3>Mostrar todas los categorias</h3>
            <form method="GET">
                <input type="submit" value="Mostrar" name="showCategories">
            </form>

            <h3>Eliminar categorias</h3>
            <form method="POST">
                <label for="name">Nombre:</label><br>
                <input type="text" name="name" id="name" required><br><br>
                <input type="submit" value="Eliminar" name="deleteCategory">
            </form>
        </div>
    </div>

    <br>

    <h2>PRODUCTOS!</h2>
    <div class="flex">
        <div>
            <h3>Añadir/Modificar productos</h3>
            <p>Para modificar: Introduzca el nombre del producto a modificar<br>
                con su nueva información</p>
            <form method="POST">
                <label for="name">Nombre:</label><br>
                <input type="text" name="name" id="name" required><br><br>
                <label for="stock">Stock:</label><br>
                <input type="text" name="stock" id="stock" required><br><br>
                <label for="price">Precio: (€)</label><br>
                <input type="number" name="price" id="price" required><br><br>
                <label for="category">Categoria:</label><br>
                <input type="number" name="category" id="category" required><br><br>
                <input type="submit" value="Añadir" name="addProduct">
                <input type="submit" value="Modificar" name="modProduct">
            </form>
        </div>
        <div>
            <h3>Mostrar todas los productos</h3>
            <form method="GET">
                <input type="submit" value="Mostrar" name="showProducts">
            </form>

            <h3>Eliminar productos</h3>
            <form method="POST">
                <label for="name">Nombre:</label><br>
                <input type="text" name="name" id="name" required><br><br>
                <input type="submit" value="Eliminar" name="deleteProduct">
            </form>
        </div>
    </div>


    <br>
    <br>
</body>
</html>