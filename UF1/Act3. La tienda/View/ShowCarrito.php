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
        // Verifica si hay elementos en el carrito.
        if (mysqli_num_rows($carrito) > 0) {
            // Comienza la tabla HTML para mostrar los elementos del carrito.
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Producto</th>";
            echo "<th>Cantidad</th>";
            echo "<th>Precio Total</th>";
            echo "</tr>";
            
            // Itera a través de los resultados en el carrito.
            while ($row = mysqli_fetch_array($carrito)) {
                echo "<tr>";
                // Muestra los detalles del producto en el carrito.
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['producto'] . "</td>";
                echo "<td>" . $row['cantidad'] . "</td>";
                echo "<td>" . $row['precio_total'] . "€</td>";
                echo "</tr>";
            }
            
            // Finaliza la tabla.
            echo "</table>";
        } else {
            // Si no hay elementos en el carrito, muestra un mensaje indicando que no hay datos.
            echo 'No hay datos';
        }

        // Verifica si se ha enviado el formulario para volver a la página de inicio.
        if (isset($_POST['volver'])) {
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