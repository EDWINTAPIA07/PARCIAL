<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de asignaciones
require_once('../models/asignacionesmodels.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase asignacionesmodels
$asignaciones = new asignacionesmodels();

switch ($_GET["op"]) {
    // Obtener todos los registros de asignaciones
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de asignaciones
        $datos = $asignaciones->todos(); // Recuperar todos los registros de asignaciones desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de asignaciones
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de asignación por su ID
    case 'uno':
        $asignacion_id = $_POST["asignacion_id"];
        $datos = $asignaciones->uno($asignacion_id); // Recuperar un registro de asignación desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo registro de asignación
    case 'insertar':
        $estudiante_id = $_POST["estudiante_id"];
        $profesor_id = $_POST["profesor_id"];
        $nombre_clase = $_POST["nombre_clase"];
        $datos = $asignaciones->insertar($estudiante_id, $profesor_id, $nombre_clase); // Insertar el nuevo registro de asignación en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un registro de asignación existente
    case 'actualizar':
        $asignacion_id = $_POST["asignacion_id"];
        $estudiante_id = $_POST["estudiante_id"];
        $profesor_id = $_POST["profesor_id"];
        $nombre_clase = $_POST["nombre_clase"];
        $datos = $asignaciones->actualizar($asignacion_id, $estudiante_id, $profesor_id, $nombre_clase); // Actualizar el registro de asignación en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un registro de asignación
    case 'eliminar':
        $asignacion_id = $_POST["asignacion_id"];
        $datos = $asignaciones->eliminar($asignacion_id); // Eliminar el registro de asignación de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
?>
