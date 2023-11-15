<?php
// Conexión
$conectar = mysqli_connect("localhost", "root", "", "hotel_roquet");

if (mysqli_connect_errno()) {
    echo "Error de conexión a la base de datos: " . mysqli_connect_error();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["identificacion"]) && isset($_POST["nombre"]) && isset($_POST["tipo_habitacion"]) && isset($_POST["num_personas"]) && isset($_POST["fecha_inicio"]) && isset($_POST["fecha_fin"]) && isset($_POST["dias_reserva"]) && isset($_POST["estado"]) && isset($_POST["num_reserva"]) && isset($_POST["num_habitacion"]) && isset($_POST["precio_total"])) {
        // Insertar 
        $identificacion = $_POST["identificacion"];
        $nombre = $_POST["nombre"];
        $tipo_habitacion = $_POST["tipo_habitacion"];
        $num_personas = $_POST["num_personas"];
        $fecha_inicio = $_POST["fecha_inicio"];
        $fecha_fin = $_POST["fecha_fin"];
        $dias_reserva = $_POST["dias_reserva"];
        $estado = $_POST["estado"];
        $num_reserva = $_POST["num_reserva"];
        $num_habitacion = $_POST["num_habitacion"];
        $precio_total = $_POST["precio_total"];

        $insertar = "INSERT INTO reserva (identificacion, nombre, tipo_habitacion, num_personas, fecha_inicio, fecha_fin, dias_reserva, estado, num_reserva, num_habitacion, precio_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conectar, $insertar);
        mysqli_stmt_bind_param($stmt, "sssssssssss", $identificacion, $nombre, $tipo_habitacion, $num_personas, $fecha_inicio, $fecha_fin, $dias_reserva, $estado, $num_reserva, $num_habitacion, $precio_total);

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

    if (isset($_POST["actualizar_identificacion"]) && isset($_POST["nuevo_nombre"]) && isset($_POST["nuevo_tipo_habitacion"]) && isset($_POST["nuevo_num_personas"]) && isset($_POST["nuevo_fecha_inicio"]) && isset($_POST["nuevo_fecha_fin"]) && isset($_POST["nuevo_dias_reserva"]) && isset($_POST["nuevo_estado"])) {
        // Actualizar 
        $id_actualizar = $_POST["actualizar_identificacion"];
        $nuevo_nombre = $_POST["nuevo_nombre"];
        $nuevo_tipo_habitacion = $_POST["nuevo_tipo_habitacion"];
        $nuevo_num_personas = $_POST["nuevo_num_personas"];
        $nuevo_fecha_inicio = $_POST["nuevo_fecha_inicio"];
        $nuevo_fecha_fin = $_POST["nuevo_fecha_fin"];
        $nuevo_dias_reserva = $_POST["nuevo_dias_reserva"];
        $nuevo_estado = $_POST["nuevo_estado"];

        $actualizar = "UPDATE reserva SET nombre = ?, tipo_habitacion = ?, num_personas = ?, fecha_inicio = ?, fecha_fin = ?, dias_reserva = ?, estado = ? WHERE identificacion = ?";
        $stmt = mysqli_prepare($conectar, $actualizar);
        mysqli_stmt_bind_param($stmt, "sssssssss", $nuevo_nombre, $nuevo_tipo_habitacion, $nuevo_num_personas, $nuevo_fecha_inicio, $nuevo_fecha_fin, $nuevo_dias_reserva, $nuevo_estado, $id_actualizar);

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
echo "<th>Identificación</th>";
echo "<th>Nombre</th>";
echo "<th>Tipo de Habitación</th>";
echo "<th>Número de Personas</th>";
echo "<th>Fecha de Inicio</th>";
echo "<th>Fecha de Fin</th>";
echo "<th>Días de Reserva</th>";
echo "<th>Estado</th>";
echo "<th>Número de Reserva</th>"; // Agregado
echo "<th>Número de Habitación</th>"; // Agregado
echo "<th>Total en Pesos Colombianos</th>"; // Agregado
echo "</tr>";

foreach ($resultado as $result) {
    echo "<tr>";
    echo "<td>" . $result["identificacion"] . "</td>";
    echo "<td>" . $result["nombre"] . "</td>";
    echo "<td>" . $result["tipo_habitacion"] . "</td>";
    echo "<td>" . $result["num_personas"] . "</td>";
    echo "<td>" . $result["fecha_inicio"] . "</td>";
    echo "<td>" . $result["fecha_fin"] . "</td>";
    echo "<td>" . $result["dias_reserva"] . "</td>";
    echo "<td>" . $result["estado"] . "</td>";
    echo "<td>" . $result["num_reserva"] . "</td>"; // Agregado
    echo "<td>" . $result["num_habitacion"] . "</td>"; // Agregado
    echo "<td>" . $result["precio_total"] . "</td>"; // Agregado
    echo "<td><form method='post'><input type='hidden' name='eliminar' value='" . $result["identificacion"] . "'><input type='submit' value='Eliminar'></form></td>";
    echo "<td>
              <form method='post'>
                <input type='hidden' name='actualizar_identificacion' value='" . $result["identificacion"] . "'>
                <input type='text' name='nuevo_nombre' placeholder='Nuevo nombre'>
                <input type='text' name='nuevo_tipo_habitacion' placeholder='Nuevo tipo de habitación'>
                <input type='text' name='nuevo_num_personas' placeholder='Nuevo número de personas'>
                <input type='text' name='nuevo_fecha_inicio' placeholder='Nueva fecha de inicio'>
                <input type='text' name='nuevo_fecha_fin' placeholder='Nueva fecha de fin'>
                <input type='text' name='nuevo_dias_reserva' placeholder='Nuevos días de reserva'>
                <input type='text' name='nuevo_estado' placeholder='Nuevo estado'>
                <input type='submit' value='Actualizar'>
              </form>
           </td>";
    echo "</tr>";
}

echo "</table>";

mysqli_close($conectar);
?>
