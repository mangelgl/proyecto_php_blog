<?php

// Conexión
$servidor = 'localhost';
$usuario = 'mangel';
$password = 'Usuario2022.';
$basededatos = 'proyecto_php_blog';

$con = mysqli_connect($servidor, $usuario, $password, $basededatos);

if (!isset($_SESSION)) {
    session_start();
}
