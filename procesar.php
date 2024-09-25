<?php
require('conexion.php');
session_start();

if (isset($_POST["envio"])) {
    $con = conectar_bd();
    $nombre_de_usuario = mysqli_real_escape_string($con, $_POST['nombre']);
    $contrasenia = mysqli_real_escape_string($con, $_POST['pass']);

    // Primero, verificar si el usuario es un administrador
    $sql_admin = "SELECT * FROM administrador WHERE nombre_usuario = ?";
    $stmt_admin = $con->prepare($sql_admin);
    $stmt_admin->bind_param("s", $nombre_de_usuario);
    $stmt_admin->execute();
    $resultado_admin = $stmt_admin->get_result();

    if ($resultado_admin->num_rows > 0) {
        // El usuario es administrador
        $fila_admin = $resultado_admin->fetch_assoc();

        // Verificar la contraseña de admin
        if ($contrasenia == $fila_admin['contrasenia']) {
            // Iniciar sesión como administrador
            $_SESSION['nombre_de_usuario'] = $nombre_de_usuario;
            $_SESSION['role'] = 'admin'; // Asignar rol de administrador

            // Si seleccionó "Recordarme", establecer cookie válida por 7 días
            if (isset($_POST['recordar_sesion'])) {
                setcookie('nombre_de_usuario', $nombre_de_usuario, time() + (7 * 24 * 60 * 60), "/"); // 7 días
            }

            // Redirigir a la página de administrador
            header("Location: home_usuario.php");
            exit();
        }
    } 
    
    // Si no es administrador, verificar si es usuario normal
    $sql = "SELECT * FROM usuarios WHERE nombre_de_usuario = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $nombre_de_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();

        // Verificar la contraseña de usuario
        if (password_verify($contrasenia, $fila['contrasenia'])) {
            // Iniciar sesión como usuario
            $_SESSION['nombre_de_usuario'] = $nombre_de_usuario;
            $_SESSION['role'] = 'user'; // Asignar rol de usuario normal

            // Si seleccionó "Recordarme", establecer cookie válida por 7 días
            if (isset($_POST['recordar_sesion'])) {
                setcookie('nombre_de_usuario', $nombre_de_usuario, time() + (7 * 24 * 60 * 60), "/"); // 7 días
            }

            // Redirigir a la página del usuario
            header("Location: home_usuario.php");
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        // Usuario no existe
        header("Location: login.php?error=1");
        exit();
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: login.php");
    exit();
}
