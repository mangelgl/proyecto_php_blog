<?php

// Iniciar la sesión y conexión a la bd
require_once 'includes/conexion.php';

// Recoger datos del formulario
if (isset($_POST)) {

    if (isset($_SESSION["error_login"])) {
        unset($_SESSION["error_login"]);
    }

    $nickname = trim($_POST["nickname"]);
    $password = trim($_POST["password"]);


    // Consultar las credenciales del usuario
    $sql = "SELECT * FROM seg_users 
    WHERE nickname = '$nickname'";
    $result = mysqli_query($con, $sql);
    $error = mysqli_error($con);

    if ($result && mysqli_num_rows($result) == 1) {
        //Comprobar la contraseña
        $usuario = mysqli_fetch_assoc($result);
        $verify = password_verify($password, $usuario["password"]);

        if ($verify) {
            // Utilizar una sesión para guardar los datos del usuario logueado
            $_SESSION["usuario"] = $usuario;
        } else {
            // Si algo falla, enviar una sesión con el fallo
            $_SESSION["error_login"] = "Login incorrecto";
        }
    } else {
        $_SESSION["error_login"] = "Login incorrecto";
    }
}

// Redirección al index.php
header('Location: index.php');
