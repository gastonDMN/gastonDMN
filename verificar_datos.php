<?php
require("conexion.php");
$con = conectar_bd();

$nombreUser = $_GET["nombreUser"];
$id = isset($_GET["id"]) ? $_GET["id"] : null;

$consulta = "SELECT * FROM usuarios WHERE nombre_de_usuario='$nombreUser'";

if ($id !== null) {
    $consulta .= " AND id_usuarios != '$id'";
}

$resultado = mysqli_query($con, $consulta);
echo json_encode(["existe" => mysqli_num_rows($resultado) > 0]);
?>
