<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once('../config/config.php');

class profesoresmodels
{
    // Obtiene todos los registros de profesores
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `profesores`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Obtiene un registro de profesor específico por ID
    public function uno($profesor_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `profesores` WHERE `profesor_id` = $profesor_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Inserta un nuevo profesor en la base de datos
    public function insertar($nombre, $apellido, $especialidad, $email)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `profesores` (`nombre`, `apellido`, `especialidad`, `email`) 
                       VALUES ('$nombre', '$apellido', '$especialidad', '$email')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Devuelve el ID del nuevo profesor
            } else {
                return $con->error; // Devuelve el error si la consulta falla
            }
        } catch (Exception $th) {
            return $th->getMessage(); // Devuelve el mensaje de excepción si ocurre un error
        } finally {
            $con->close(); // Cierra la conexión a la base de datos
        }
    }

    // Actualiza la información de un profesor existente
    public function actualizar($profesor_id, $nombre, $apellido, $especialidad, $email)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `profesores` 
                       SET `nombre` = '$nombre', `apellido` = '$apellido', `especialidad` = '$especialidad', `email` = '$email' 
                       WHERE `profesor_id` = $profesor_id";
            if (mysqli_query($con, $cadena)) {
                return $profesor_id; // Devuelve el ID del profesor actualizado
            } else {
                return $con->error; // Devuelve el error si la consulta falla
            }
        } catch (Exception $th) {
            return $th->getMessage(); // Devuelve el mensaje de excepción si ocurre un error
        } finally {
            $con->close(); // Cierra la conexión a la base de datos
        }
    }

    // Elimina un registro de profesor específico por ID
    public function eliminar($profesor_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `profesores` WHERE `profesor_id` = $profesor_id";
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
