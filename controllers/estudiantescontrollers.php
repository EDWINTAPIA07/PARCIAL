<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de estudiantes
require_once('../models/estudiantesmodels.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase estudiantesmodels
$estudiantes = new estudiantesmodels();

switch ($_GET["op"]) {
    // Obtener todos los registros de estudiantes
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de estudiantes
        $datos = $estudiantes->todos(); // Recuperar todos los registros de estudiantes desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de estudiantes
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de estudiante por su ID
    case 'uno':
        $estudiante_id = $_POST["estudiante_id"];
        $datos = $estudiantes->uno($estudiante_id); // Recuperar un registro de estudiante desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo registro de estudiante
    case 'insertar':
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $grado = $_POST["grado"];
        $datos = $estudiantes->insertar($nombre, $apellido, $fecha_nacimiento, $grado); // Insertar el nuevo registro de estudiante en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un registro de estudiante existente
    case 'actualizar':
        $estudiante_id = $_POST["estudiante_id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $grado = $_POST["grado"];
        $datos = $estudiantes->actualizar($estudiante_id, $nombre, $apellido, $fecha_nacimiento, $grado); // Actualizar el registro de estudiante en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un registro de estudiante
    case 'eliminar':
        $estudiante_id = $_POST["estudiante_id"];
        $datos = $estudiantes->eliminar($estudiante_id); // Eliminar el registro de estudiante de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
?>
