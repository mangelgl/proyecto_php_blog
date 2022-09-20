<?php
if (isset($_POST)) {

    // Conexión a la base de datos
    require_once 'includes/conexion.php';

    // Recorger los valores del formulario de actualización del usuario
    // Escapar valores en mysql
    $usuario = isset($_POST['usuario']) ? mysqli_real_escape_string($con, trim($_POST['usuario']))  : false;
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($con, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($con, $_POST['apellidos']) : false;

    // Array de errores
    $errores = array();

    // Validar los datos antes de guardarlos en la base de datos
    if (!empty($usuario)) {
        $usuario_validado = true;
    } else {
        $usuario_validado = false;
        $errores['usuario'] = "Por favor, introduce un valor válido.";
    }

    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "Por favor, introduce un valor válido.";
    }

    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "Por favor, introduce un valor válido.";
    }

    $guardar_usuario = false;
    if (count($errores) == 0) {
        $guardar_usuario = true;

        // Comprobar si existe el usuario
        $sql = "SELECT id, nickname FROM seg_users WHERE nickname = '$usuario'";
        $result_usuario = mysqli_query($con, $sql);
        $result_id = mysqli_fetch_assoc($result_usuario);

        if ($result_id["id"] == $_SESSION["usuario"]["id"] || empty($result_id)) {
            $usuario_id = intval($_SESSION["usuario"]["id"]);
            // Actualizar usuario en base de datos
            $sql = "UPDATE seg_users SET 
                        nombre = '$nombre',
                        apellidos = '$apellidos',
                        nickname = '$usuario'
                    WHERE id = $usuario_id";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $_SESSION["usuario"]["nombre"] = $nombre;
                $_SESSION["usuario"]["apellidos"] = $apellidos;
                $_SESSION["usuario"]["nickname"] = $usuario;
                $_SESSION["completado"] = "Tus datos se han actualizado con éxito.";
            } else {
                $_SESSION["errores"]["general"] = "Fallo al actualizar tus datos.";
            }
        } else {
            $_SESSION["errores"]["general"] = "El usuario elegido no está disponible.";
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: mis_datos.php');
