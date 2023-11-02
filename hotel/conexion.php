<?php
// Conexión
$conectar = mysqli_connect("localhost", "root", "", "prueba");

if (mysqli_connect_errno()) {
    echo "Error de conexión a la base de datos: " . mysqli_connect_error();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["identificacion"])&& isset($_POST["nombre"]) && isset($_POST["tipo_habit"]) && isset($_POST["num_person"]) && isset ($_POST["fecha"])) {
        // Insertar 
        $identificacion = $_POST["indetificacion"];
        $nombre = $_POST["nombre"];
        $tipo_habit = $_POST["tipo_habit"];
        $num_person = $_POST["num_person"];
        $fecha = $_POST["fecha"];

        $insertar = "INSERT INTO reserva (identificacion,nombre, tipo_habit,num_person, fecha) VALUES (?, ?, ?, ? ,?)";
        $stmt = mysqli_prepare($conectar, $insertar);
        mysqli_stmt_bind_param($stmt, "sss",$identificacion,$nombre , $tipo_habit, $num_person, $fecha);

        if (mysqli_stmt_execute($stmt)) {
            echo "Datos insertados con éxito.";
        } else {
            echo "Error al insertar datos: " . mysqli_error($conectar);
        }

        mysqli_stmt_close($stmt);
    }

    if (isset($_POST["eliminar"])) {
        // Eliminar 
        $id_eliminar = $_POST["eliminar"];

        
        $eliminar = "DELETE FROM reserva WHERE identificacion = ?";
        $stmt = mysqli_prepare($conectar, $eliminar);
        mysqli_stmt_bind_param($stmt, "s", $id_eliminar);

        if (mysqli_stmt_execute($stmt)) {
            echo "Datos eliminados con éxito.";
        } else {
            echo "Error al eliminar datos: " . mysqli_error($conectar);
        }

        mysqli_stmt_close($stmt);
    }

    if (isset($_POST["actualizar_identificacion"]) && isset($_POST["nuevo_nombre"]) && isset($_POST["nuevo_tipo_habit"]) &&  isset($_POST["nuevo_num_person"]) && isset(["nuevo_fecha"])) {
        // Actualizar 
        $id_actualizar = $_POST["actualizar_identificacion"];
        $nuevo_nombre = $_POST["nuevo_nombre"];
        $nuevo_tipo_habit = $_POST["nuevo_tipo_habit"];
        $nuevo_num_person = $_POST["nuevo_num_person"];
        $nuevo_fecha = $_POST["nuevo_fecha"];

        
        $actualizar = "UPDATE reserva SET num_person = ?, fecha = ? WHERE identificacion = ?";
        $stmt = mysqli_prepare($conectar, $actualizar);
        mysqli_stmt_bind_param($stmt, "sss", $nuevo_nombre, $nuevo_tipo_habit, $id_actualizar,$nuevo_fecha,$nuevo_num_person);

        if (mysqli_stmt_execute($stmt)) {
            echo "Datos actualizados con éxito.";
        } else {
            echo "Error al actualizar datos: " . mysqli_error($conectar);
        }

        mysqli_stmt_close($stmt);
    }
}

// Consultar 
$consultar = "SELECT * FROM reserva";
$resultado = mysqli_query($conectar, $consultar);

echo "<table border='1'>";
echo "<tr>";
echo "<th>identifiacion</th>";
echo "<th>Nombre</th>";
echo "<th>tipo de habitacion</th>";
echo "<th>numero de personas</th>";
echo "<th>fecha</th>";
echo "</tr>";

foreach ($resultado as $result) {
    echo "<tr>";
    echo "<td>" . $result["identificacion"] . "</td>";
    echo "<td>" . $result["nombre"] . "</td>";
    echo "<td>" . $result["tipo_habit"] . "</td>";
    echo "<td>" . $result["num_person"] . "</td>";
    echo "<td>" . $result["fecha"] . "</td>";
    
    echo "<td><form method='post'><input type='hidden' name='eliminar' value='" . $result["identificacion"] . "'><input type='submit' value='Eliminar'></form></td>";
    echo "<td>
              <form method='post'>
                <input type='hidden' name='actualizar_identificacion' value='" . $result["identificacion"] . "'>
                <input type='text' name='nuevo_nombre' placeholder='Nuevo nombre'>
                <input type='text' name='nuevo_tipo_habit' placeholder='Nuevo tipo_habit'>
                <input type='text' name='nuevo_num_person' placeholder='Nuevo num_person'>
                <input type='text' name='nuevo_fecha' placeholder='Nuevo fecha'>
                <input type='submit' value='Actualizar'>
              </form>
           </td>";
    echo "</tr>";
}

echo "</table>";


mysqli_close($conectar);
?>
