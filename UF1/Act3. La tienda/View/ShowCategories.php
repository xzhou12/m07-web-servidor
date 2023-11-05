<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Categorias</h1>

    <?php
        // Verifica si hay categorías en la base de datos.
        if (mysqli_num_rows($categories) > 0) {
            // Comienza la tabla HTML para mostrar las categorías.
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Descripción</th>";
            echo "</tr>";

            // Itera a través de los resultados de las categorías.
            while ($row = mysqli_fetch_array($categories)) {
                echo "<tr>";
                // Muestra los detalles de cada categoría.
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "</tr>";
            }

            // Finaliza la tabla.
            echo "</table>";
        } else {
            // Si no hay resultados, muestra un mensaje indicando que no hay datos.
            echo 'No hay datos';
        }

        // Verifica si se ha enviado el formulario para volver a la página de inicio del administrador.
        if (isset($_POST['volver'])) {
            header('Location: AdminHomepage.php');
        }
    ?>


<br>
<br>

    <form method="POST">
        <input type="submit" value="Volver" name="volver">
    </form>
    
</body>
</html>