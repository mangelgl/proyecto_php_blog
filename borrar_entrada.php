<?php
require_once 'includes/conexion.php';

if (isset($_SESSION["usuario"]) && isset($_GET["id"])) {
    $usuario_id = $_SESSION["usuario"]["id"];
    $entrada_id = $_GET["id"];
    $sql = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";
    $result = mysqli_query($con, $sql);
}

header('Location:index.php');
