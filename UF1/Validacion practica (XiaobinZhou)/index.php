<?php

// Conecta la bbdd
$con = conectarBD();

// Si conecta la base de datos, empieza la funcion
if ($con) {
    /*
    Dependiendo del Submit que se presione, hará una accion u otra
    */
    if (isset($_POST['addAnimal'])) {
        addAnimal($con);
    } elseif (isset($_POST['changeInfo'])) {
        updateAnimal($con);
    } elseif (isset($_GET['showAnimal'])) {
        showAnimales($con);
    } elseif (isset($_POST['deleteAnimal'])) {
        deleteAnimales($con);
    }
} else {
    // Si no, muestra un mensaje de error
    echo 'No se ha conectado a la base de datos :(';
}

/*
Funcion para concectar a la BD
*/
function conectarBD()
{
    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "datos";

    // Retorna la conexión a la bbdd
    return new mysqli($server, $user, $pass, $bd);
}

/*
Funcion para añadir animales
*/
function addAnimal($con)
{
    // Recoge el ID del formulario HTML
    $id_animal = $_POST['id'];

    // Comprueba si existe el animal
    $existe = comprobarAnimal($id_animal, $con);

    if ($existe == 0) { // Si no existe, empieza la funcion
        // Recoge toda la información
        $especie = $_POST['especie'];
        $nombre = $_POST['nombre'];
        $fecha_n = $_POST['date'];
        $peso = $_POST['peso'];

        // Sentencia del animal
        $sql = 'INSERT INTO animales
        VALUES("' . $id_animal . '", "' . $especie . '", "' . $nombre . '", "' . $fecha_n . '", ' . $peso . ')';

        // Ejecuta la sentencia
        $ejecutar = mysqli_query($con, $sql);

        if (!$ejecutar) {
            // Ha fallado la sentencia muestra un error
            echo 'Ha habido algun error al insertar los datos';
        } else {
            // Si ha salido bien, muestra que se han añadido satisfactoriamente
            echo 'Se han añadido los datos de forma satisfactoria';
        }
    } else {
         // Si el animal ya existe, muestra que ya exsite
         echo 'El animal ya existe!';
    }

    
}


/*
Funcion para actualizar los datos del animal
*/
function updateAnimal($con)
{
    // Recoge todos los datos del formulario HTML
    $id_animal = $_POST['id'];
    // Comprueba si existe el animal
    $existe = comprobarAnimal($id_animal, $con);

    // Si existe el cliente
    if ($existe > 0) {
        // Recoge la información
        $especie = $_POST['especie'];
        $nombre = $_POST['nombre'];
        $fecha_n = $_POST['date'];
        $peso = $_POST['peso'];

        // Y hace la sentencia de Update
        $sql = 'UPDATE animales
            SET especie = "' . $especie . '", nombre = "' . $nombre . '", fecha_nacimiento = "' . $fecha_n . '", peso = "' . $peso . '"
            WHERE id_animal = "' . $id_animal . '"';

        // Ejecuta la sentencia
        $ejecutar = mysqli_query($con, $sql);

        if (!$ejecutar) {
            // Ha fallado la sentencia muestra un error
            echo 'Ha habido algun error al cambiar los datos';
        } else {
            // Si ha salido bien, muestra que se han añadido satisfactoriamente
            echo 'Se han cambiado los datos de forma satisfactoria';
        }
    } else {
        // Si no existe el animal, muestra que no existe
        echo 'El animal NO existe!';
    }
}

function showAnimales($con)
{
    // Recoge el dni
    $id_animal = $_GET['id'];

    // Si DNI no tiene valor
    if ($id_animal == null) {
        // Hace un select de todo
        $sql = 'SELECT *
                FROM animales';

        // Y ejecuta la sentencia
        $query = mysqli_query($con, $sql);
    } else {
        // Si no, comprueba que existe el ID del animal
        $existe = comprobarAnimal($id_animal, $con);

        if ($existe > 0) {
            // Si existe, hace la sentencia para ese animal
            $sql = 'SELECT *
                FROM animales
                WHERE id_animal = "' . $id_animal . '"';

            // Ejecuta la sentencia
            $query = mysqli_query($con, $sql);
        } else {
            // Si no existe el animal, muestra que no existe
            echo 'El cliente NO existe!';
        }
    }

    // Si hay más de 0 resultados
    if (mysqli_num_rows($query) > 0) {
        // Header de la tabla
        echo "<table>";
        echo "<tr>";
        echo "<th>ID Animal</th>";
        echo "<th>Especie</th>";
        echo "<th>Nombre</th>";
        echo "<th>Fecha nacimiento</th>";
        echo "<th>Peso</th>";
        echo "</tr>";
        // Bucle que se repite tantas veces como resultados haya
        while ($row = mysqli_fetch_array($query)) {
            echo "<tr>";
            // Muestra los resultados
            echo "<td>" . $row['id_animal'] . "</td>";
            echo "<td>" . $row['especie'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['fecha_nacimiento'] . "</td>";
            echo "<td>" . $row['peso'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        // Si no hay resultados, muestra que no hay resultados
        echo 'No hay datos';
    }
}


function deleteAnimales($con)
{
    // Recoge el ID
    $id_animal = $_POST['id'];
    $existe = comprobarAnimal($id_animal, $con);

    // Si existe, hace la funcion
    if ($existe > 0) {

        // Sentencia para eliminar
        $sql = 'DELETE FROM animales
            WHERE id_animal = "' . $id_animal . '"';

        // Ejecuta la sentencia
        $ejecutar = mysqli_query($con, $sql);


        if (!$ejecutar) {
            // Si ha fallado la sentencia muestra un error
            echo 'Ha habido algun error al eliminar';
        } else {
            // Si ha salido bien, muestra que se ha eliminado satisfactoriamente
            echo 'Se ha eliminado el animal';
        }
    } else {
        // Si no existe el animal, muestra que no existe
        echo 'El animal NO existe!';
    }
}

function comprobarAnimal($id, $con)
{
    // Cuenta los rows que existen con el mismo ID que se le pasa por parametro
    $sql = 'SELECT COUNT(*) FROM animales WHERE id_animal = ' . $id . '';
    $rows = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($rows);

    // Retorna las filas contadas
    return $row['COUNT(*)'];
}
