<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Usuarios</h1>

    <?php
        // Comprueba si hay resultados de usuarios en la base de datos.
        if (mysqli_num_rows($users) > 0) {
            // Inicia una tabla HTML para mostrar los usuarios.
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nick</th>";
            echo "<th>Email</th>";
            echo "</tr>";

            // Recorre los resultados de los usuarios y los muestra en la tabla.
            while ($row = mysqli_fetch_array($users)) {
                echo "<tr>";
                // Muestra los resultados
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nick'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }

            // Cierra la tabla HTML.
            echo "</table>";
        } else {
            // Si no hay resultados de usuarios, muestra un mensaje que indica que no hay datos.
            echo 'No hay datos';
        }

        // Comprueba si se ha enviado un formulario con la acción "volver".
        if (isset($_POST['volver'])) {
            // Redirige a la página "AdminHomepage.php".
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