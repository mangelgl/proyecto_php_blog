<?php

if (isset($_POST)) {
    // Conexión con la base de datos
    require_once 'includes/conexion.php';

    $nombre = isset($_POST["nombre_categoria"]) ? mysqli_real_escape_string($con, $_POST["nombre_categoria"]) : null;

    // Array de errores
    $errores = array();

    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre_categoria'] = "Por favor, introduce un nombre válido.";
    }

    if (count($errores) == 0) {
        $sql = "INSERT INTO categorias VALUES(null, '$nombre',null)";
        $result = mysqli_query($con, $sql);
        header('Location: index.php');
    } else {
        $_SESSION["errores_categoria"] = $errores;
        header('Location: crear_categoria.php');
    }
}
