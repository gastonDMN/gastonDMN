<?php

require("conexion.php");
$con = conectar_bd();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id_usuarios"];
    $telefono = $_POST["telefono"];
    $nombre = $_POST["nombre"];
    $fecha = $_POST["fecha_nacimiento"];
    $email = $_POST["correo_electronico"];
    $nombreUser = $_POST["nombre_de_usuario"];
    $contra = $_POST["contrasenia"];
    $contrah = password_hash($contra, PASSWORD_DEFAULT);

    if (isset($_POST["agregar"])) {
        insertar_datos($con, $telefono, $nombre, $fecha, $email, $nombreUser, $contrah);
    } elseif (isset($_POST["actualizar"])) {
        actualizar_datos($con, $id, $telefono, $nombre, $fecha, $email, $nombreUser, $contrah);
    } elseif (isset($_POST["eliminar"])) {
        eliminar_datos($con, $id);
    }

    echo consultar_datos($con);
}

function insertar_datos($con, $telefono, $nombre, $fecha, $email, $nombreUser, $contrah) {
    $fecha_formato_mysql = date('Y-m-d', strtotime($fecha));
    $consulta_insertar = "INSERT INTO usuarios (telefono, nombre, fecha_nacimiento, correo_electronico, nombre_de_usuario, contrasenia) 
                          VALUES ('$telefono', '$nombre', '$fecha_formato_mysql', '$email', '$nombreUser', '$contrah')";
    mysqli_query($con, $consulta_insertar);
}




function actualizar_datos($con, $id, $telefono, $nombre, $fecha, $email, $nombreUser, $contrah) {
    $consulta_actualizar = "UPDATE usuarios SET telefono='$telefono', nombre='$nombre', fecha_nacimiento='$fecha', 
                            correo_electronico='$email', nombre_de_usuario='$nombreUser', contrasenia='$contrah' 
                            WHERE id_usuarios='$id'";
    mysqli_query($con, $consulta_actualizar);
}

function eliminar_datos($con, $id) {
    $consulta_eliminar = "DELETE FROM usuarios WHERE id_usuarios='$id'";
    mysqli_query($con, $consulta_eliminar);
}

function consultar_datos($con) {
    $consulta = "SELECT * FROM usuarios";
    $resultado = mysqli_query($con, $consulta);

    $salida = "<table><tr><th>ID</th><th>Telefono</th><th>Nombre</th><th>Fecha Nacimiento</th><th>Email</th><th>Nombre de Usuario</th><th>Acciones</th></tr>";

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $salida .= "<tr>
                        <td>{$fila['id_usuarios']}</td>
                        <td>{$fila['telefono']}</td>
                        <td>{$fila['nombre']}</td>
                        <td>{$fila['fecha_nacimiento']}</td>
                        <td>{$fila['correo_electronico']}</td>
                        <td>{$fila['nombre_de_usuario']}</td>
                        <td>
                            <button onclick='actualizarUsuario({$fila['id_usuarios']})'>Actualizar</button>
                            <button onclick='eliminarUsuario({$fila['id_usuarios']})'>Eliminar</button>
                        </td>
                    </tr>";
    }
    $salida .= "</table>";

    return $salida;
}

require("footer.php");

?>


