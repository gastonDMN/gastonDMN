<?php
require('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = conectar_bd();
    
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($con, $_POST['telefono']);
    $fecha_nacimiento = mysqli_real_escape_string($con, $_POST['fecha_nacimiento']);
    $correo_electronico = mysqli_real_escape_string($con, $_POST['correo_electronico']);
    $nombre_de_usuario = mysqli_real_escape_string($con, $_POST['nombre_de_usuario']);
    $contrasenia = mysqli_real_escape_string($con, $_POST['contrasenia']);
    $hashed_pass = password_hash($contrasenia, PASSWORD_BCRYPT);
    
    // Consulta para insertar los datos del nuevo usuario
    $consulta = "INSERT INTO usuarios (nombre, telefono, fecha_nacimiento, correo_electronico, nombre_de_usuario, contrasenia) 
                 VALUES ('$nombre', '$telefono', '$fecha_nacimiento', '$correo_electronico', '$nombre_de_usuario', '$hashed_pass')";
    
    // Ejecutar la consulta y verificar si fue exitosa
    if (mysqli_query($con, $consulta)) {
        // Redirigir al login tras el registro exitoso
        echo "<script>
                alert('Registro exitoso. Ahora puedes iniciar sesión.');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($con);
    }

    mysqli_close($con);
}

require('footer.php');
?>
