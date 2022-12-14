<?php

if (isset($_POST)) {
    // Conexión con la base de datos
    require_once 'includes/conexion.php';

    $titulo = isset($_POST["titulo"]) ? mysqli_real_escape_string($con, $_POST["titulo"]) : null;
    $descripcion = isset($_POST["descripcion"]) ? mysqli_real_escape_string($con, $_POST["descripcion"]) : null;
    $categoria = isset($_POST["categorias"]) ?  intval($_POST["categorias"]) : null;
    $usuario = $_SESSION["usuario"]["id"];

    // Array de errores
    $errores = array();

    if (!empty($titulo)) {
        $titulo_validado = true;
    } else {
        $titulo_validado = false;
        $errores['titulo'] = "El título no puede estar vacía.";
    }

    if (!empty($descripcion)) {
        $descripcion_validada = true;
    } else {
        $descripcion_validada = false;
        $errores['descripcion'] = "La descripción no puede estar vacía.";
    }

    if (!empty($categoria) && is_numeric($categoria)) {
        $categoria_validada = true;
    } else {
        $categoria_validada = false;
        $errores['categoria'] = "La categoría no puede estar vacía.";
    }


    if (count($errores) == 0) {
        if (isset($_GET['editar'])) {
            $entrada_id = $_GET['editar'];
            $usuario_id = $_SESSION["usuario"]["id"];
            $sql = "UPDATE entradas SET 
                        titulo = '$titulo',
                        descripcion = '$descripcion',
                        categoria_id = $categoria
                    WHERE id = $entrada_id AND usuario_id = $usuario_id";
        } else {
            $sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria, '$titulo', '$descripcion', CURRENT_TIMESTAMP())";
        }

        $result = mysqli_query($con, $sql);
        header('Location: index.php');
    } else {
        $_SESSION["errores_entrada"] = $errores;
        if (isset($_GET["editar"])) {
            header("Location: editar_entrada.php?id=" . $entrada_id);
        } else {
            header('Location: crear_entradas.php');
        }
    }
}
