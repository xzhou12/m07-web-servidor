<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Productos</h1>

    <?php
        // Comprueba si hay resultados de productos en la base de datos.
        if (mysqli_num_rows($products) > 0) {
            // Inicia la tabla HTML para mostrar los productos.
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Stock</th>";
            echo "<th>Precio</th>";
            echo "<th>Categoria</th>";
            echo "</tr>";

            // Recorre los resultados de los productos y los muestra en la tabla.
            while ($row = mysqli_fetch_array($products)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>" . $row['precio'] . "€</td>";
                echo "<td>" . $row['categoria'] . "</td>";
                echo "</tr>";
            }

            // Cierra la tabla HTML.
            echo "</table>";
        } else {
            // Si no hay resultados de productos, muestra un mensaje indicando que no hay datos.
            echo 'No hay datos';
        }

        // Comprueba si se ha enviado un formulario con la acción "volver".
        if (isset($_POST['volver'])) {
            // Redirige a la página "Homepage.php".
            header('Location: Homepage.php');
        }
    ?>


<br>
<br>
    <form method="POST">
        <input type="submit" value="Volver" name="volver">
    </form>
    
</body>
</html>