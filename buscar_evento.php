<?php
require("conexion.php");

// Indicar que la respuesta de este PHP es un JSON
header('Content-Type: application/json');

$con = conectar_bd();

// Defino un array para devolver las respuestas JSON según cada caso
$respuesta_json = array();

if (isset($_POST["envio2"])) {

    $nombre = $_POST["evento"];

    // Llamada a la función login
    $resultado_busqueda = buscar_evento($con, $nombre);

    // Devuelvo la respuesta en formato JSON
    echo json_encode($resultado_busqueda);
}

function buscar_evento($con, $nombre) {
    // Array para almacenar la respuesta
    $respuesta_json = array();
    $eventos = array();

    // Sanitizar el nombre para evitar inyecciones SQL
    $nombre = mysqli_real_escape_string($con, $nombre);

    // Consulta para buscar el evento
    $consulta_buscar_event = "SELECT * FROM evento WHERE nombre LIKE '$nombre%' ";
    $resultado_buscar_event = mysqli_query($con, $consulta_buscar_event);

    if (mysqli_num_rows($resultado_buscar_event) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado_buscar_event)) {

            // Agregar cada evento encontrado al array
            $evento[] = array(
                "id" => $fila["id_evento"],
                "nombre" => $fila["nombre"],
                "descripcion" => $fila["descripcion"],
                "fecha" => $fila["fecha"],
                "hora" => $fila["hora"],
                "lugar" => $fila["lugar"],
                "precio" => $fila["precio"],
                "rango" => $fila["rango_edad"]
            );
        }
        $respuesta_json['status'] = 1; // se encontró el evento
        $respuesta_json['eventos'] = $evento;
    } else {
        $respuesta_json['status'] = 0; // no se evento
        $respuesta_json['mensaje'] = "No se encontraron eventos.";
    }

    return $respuesta_json;
}