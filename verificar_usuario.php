<?php
require('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $con = conectar_bd();
    $nombre_de_usuario = mysqli_real_escape_string($con, $_GET['nombre_de_usuario']);
    $correo_electronico = mysqli_real_escape_string($con, $_GET['correo_electronico']);

    $sql_verificar = "SELECT * FROM usuarios WHERE nombre_de_usuario = ? OR correo_electronico = ?";
    $stmt_verificar = $con->prepare($sql_verificar);
    $stmt_verificar->bind_param("ss", $nombre_de_usuario, $correo_electronico);
    $stmt_verificar->execute();
    $resultado = $stmt_verificar->get_result();

    $response = ['existe' => false];
    if ($resultado->num_rows > 0) {
        $response['existe'] = true;
    }

    echo json_encode($response);

    $stmt_verificar->close();
    $con->close();
}
?>
