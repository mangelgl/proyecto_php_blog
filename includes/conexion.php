<?php

// Conexión
$servidor = 'localhost';
$usuario = 'root';
$password = 'Usuario2022.';
$basededatos = 'proyecto_php_blog';

$con = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($con, "SET NAMES utf8");

session_start();
