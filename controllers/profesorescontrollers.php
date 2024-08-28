<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de profesores
require_once('../models/profesoresmodels.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase profesoresmodels
$profesores = new profesoresmodels();

switch ($_GET["op"]) {
    // Obtener todos los registros de profesores
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de profesores
        $datos = $profesores->todos(); // Recuperar todos los registros de profesores desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de profesores
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de profesor por su ID
    case 'uno':
        $profesor_id = $_POST["profesor_id"];
        $datos = $profesores->uno($profesor_id); // Recuperar un registro de profesor desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo registro de profesor
    case 'insertar':
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $especialidad = $_POST["especialidad"];
        $email = $_POST["email"];
        $datos = $profesores->insertar($nombre, $apellido, $especialidad, $email); // Insertar el nuevo registro de profesor en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un registro de profesor existente
    case 'actualizar':
        $profesor_id = $_POST["profesor_id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $especialidad = $_POST["especialidad"];
        $email = $_POST["email"];
        $datos = $profesores->actualizar($profesor_id, $nombre, $apellido, $especialidad, $email); // Actualizar el registro de profesor en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un registro de profesor
    case 'eliminar':
        $profesor_id = $_POST["profesor_id"];
        $datos = $profesores->eliminar($profesor_id); // Eliminar el registro de profesor de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
?>
