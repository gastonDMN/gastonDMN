<?php 
require('conexion.php');
session_start();
$con = conectar_bd();

if (isset($_POST["recupera"])) {

    // Limpiar el nombre de usuario ingresado para evitar inyecciones SQL
    $usuario = mysqli_real_escape_string($con, $_POST['username']);

    // Consulta SQL para obtener el correo electrónico
    $consulta = "SELECT correo_electronico FROM usuarios WHERE nombre_de_usuario = '$usuario'";
    $resultado = mysqli_query($con, $consulta);

    // Verificar si se encontró el usuario
    if (mysqli_num_rows($resultado) > 0) {
        // Obtener el correo electrónico de la consulta
        $fila = mysqli_fetch_assoc($resultado);
        $correo = $fila['correo_electronico'];

        // Guardar el correo electrónico en una sesión o variable
        $_SESSION['correo_usuario'] = $correo; // O guarda en otra variable si prefieres

        // Mostrar o utilizar el correo electrónico
        echo "El correo electrónico asociado al usuario '$usuario' es: $correo";
    } else {
        echo "No se encontró ningún usuario con el nombre '$usuario'.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($con);
}
?>