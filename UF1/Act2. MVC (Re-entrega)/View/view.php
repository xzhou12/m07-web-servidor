<?php
class view {
    /*
    FUNCTION mostrarFormulario()
    Muestra el formulario inicial con todos los formularios
    y las acciones
    */
    public function mostrarFormulario() {
        $html =
        '
        <style>
            body {
                display: flex;
                gap: 100px;
            }
        </style>
        <div>
            <h1>ALUMNOS</h1>
            <h3>Añade alumnos</h3>
            <form method="POST" action="index.php">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" required><br><br>
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" required><br><br>
                <label for="dni">DNI:</label>
                <input type="text" name="dni" id="dni" maxlength="10" required><br><br>
                <label for="dni">Curso:</label>
                <input type="text" name="curso" id="curso" required><br><br>
                <input type="submit" value="Enviar" name="addAlumnos">
            </form>
            <br>
            <br>
            <h3>Muestra todos los alumnos</h3>
            <form method="GET" action="index.php">
                <input type="submit" value="Mostrar" name="showAlumnos">
            </form>
        </div>

        <div>
            <h1>CURSOS</h1>
            <h3>Añade Cursos</h3>
            <form method="POST" action="index.php">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" required><br><br>
                <label for="year">Año:</label>
                <input type="text" name="year" id="year" required><br><br>
                <input type="submit" value="Enviar" name="addCursos">
            </form>
            <br>
            <br>
            <h3>Muestra todos los cursos</h3>
            <form method="GET" action="index.php">
                <input type="submit" value="Mostrar" name="showCursos">
            </form>
            <br>
            <br>
            <h3>Elimina un curso</h3>
            <form method="POST" action="index.php">
                <label for="nameDelete">Nombre del cuso a eliminar:</label><br>
                <input type="text" name="nameDelete" id="nameDelete" required><br><br>
                <input type="submit" value="Eliminar" name="deleteCurso">
            </form>
        </div>';

        echo $html;
    }

    /*
    FUNCTION mostrarBotonVolver()
    Muestra un boton para volver a la pagina principal
    */
    public function mostrarBotonVolver() {
        echo '
        <br>
        <form action="index.php">
        <input type="submit" value="Volver"">
        </form>';
    }

    /*
    FUNCTION mostrarDatosAddded()
    Muestra que los datos han sido añadidos de forma
    satisfactoria
    */
    public function mostrarDatosAddded() {
        echo
        '<h1>Datos introducidos correctamente!!</h1>';

        // Tambien muestra el boton de volver
        $this->mostrarBotonVolver();
    }

    /*
    FUNCTION mostrarTablaCursos()
    Se le pasa el query de los cursos y los muestra
    en formato tabla.
    */
    public function mostrarTablaCursos($datos) {
        if (mysqli_num_rows($datos) > 0) {
            echo '<h1>Todos los cursos</h1>';
            echo "<table>";
            echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Año</th>";
            echo "</tr>";
            // Bucle que se repite tantas veces como resultados haya
            while ($row = mysqli_fetch_array($datos)) {
                echo "<tr>";
                // Muestra los resultados
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['año'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            // Si no hay resultados, muestra que no hay resultados
            echo 'No hay datos';
        }

        $this->mostrarBotonVolver();
    }

    /*
    FUNCTION mostrarTablaAlumnos()
    Se le pasa el query de los alumnos y los muestra
    en formato tabla.
    */
    public function mostrarTablaAlumnos($datos) {
        if (mysqli_num_rows($datos) > 0) {
            echo '<h1>Todos los alumnos</h1>';
            echo "<table>";
            echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Apellidos</th>";
            echo "<th>DNI</th>";
            echo "<th>Curso</th>";
            echo "</tr>";
            // Bucle que se repite tantas veces como resultados haya
            while ($row = mysqli_fetch_array($datos)) {
                echo "<tr>";
                // Muestra los resultados
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellidos'] . "</td>";
                echo "<td>" . $row['dni'] . "</td>";
                echo "<td>" . $row['curso'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            // Si no hay resultados, muestra que no hay resultados
            echo 'No hay datos';
        }

        // También muestra el botón de volver
        $this->mostrarBotonVolver();
    }

    /*
    FUNCTION mostrarDatosEliminados()
    Muestra que los datos han sido eliminados correctamente
    y también el botón de volver
    */
    public function mostrarDatosEliminados() {
        echo
        '<h1>Datos eliminados correctamente!!</h1>';

        $this->mostrarBotonVolver();
    }
}
?>