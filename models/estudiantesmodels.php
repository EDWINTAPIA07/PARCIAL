<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once('../config/config.php');

class estudiantesmodels
{
    // Obtiene todos los registros de estudiantes
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `estudiantes`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Obtiene un registro de estudiante específico por ID
    public function uno($estudiante_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `estudiantes` WHERE `estudiante_id` = $estudiante_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Inserta un nuevo estudiante en la base de datos
    public function insertar($nombre, $apellido, $fecha_nacimiento, $grado)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `estudiantes` (`nombre`, `apellido`, `fecha_nacimiento`, `grado`) 
                       VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$grado')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Devuelve el ID del nuevo estudiante
            } else {
                return $con->error; // Devuelve el error si la consulta falla
            }
        } catch (Exception $th) {
            return $th->getMessage(); // Devuelve el mensaje de excepción si ocurre un error
        } finally {
            $con->close(); // Cierra la conexión a la base de datos
        }
    }

    // Actualiza la información de un estudiante existente
    public function actualizar($estudiante_id, $nombre, $apellido, $fecha_nacimiento, $grado)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `estudiantes` 
                       SET `nombre` = '$nombre', `apellido` = '$apellido', `fecha_nacimiento` = '$fecha_nacimiento', `grado` = '$grado' 
                       WHERE `estudiante_id` = $estudiante_id";
            if (mysqli_query($con, $cadena)) {
                return $estudiante_id; // Devuelve el ID del estudiante actualizado
            } else {
                return $con->error; // Devuelve el error si la consulta falla
            }
        } catch (Exception $th) {
            return $th->getMessage(); // Devuelve el mensaje de excepción si ocurre un error
        } finally {
            $con->close(); // Cierra la conexión a la base de datos
        }
    }

    // Elimina un registro de estudiante específico por ID
    public function eliminar($estudiante_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `estudiantes` WHERE `estudiante_id` = $estudiante_id";
            if (mysqli_query($con, $cadena)) {
                return 1; // Devuelve 1 si la eliminación fue exitosa
            } else {
                return $con->error; // Devuelve el error si la consulta falla
            }
        } catch (Exception $th) {
            return $th->getMessage(); // Devuelve el mensaje de excepción si ocurre un error
        } finally {
            $con->close(); // Cierra la conexión a la base de datos
        }
    }
}
?>
