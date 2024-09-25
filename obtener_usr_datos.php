<?php
require("conexion.php");
$con = conectar_bd();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $consulta = "SELECT * FROM usuarios WHERE id_usuarios='$id'";
    $resultado = mysqli_query($con, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        echo json_encode($fila);
    } else {
        echo json_encode(["error" => "No se encontraron datos."]);
    }
} else {
    echo json_encode(["error" => "ID no proporcionado."]);
}
?>
