<?php

function mostrarError($errores, $campo)
{
	$alerta = '';
	if (isset($errores[$campo]) && !empty($campo)) {
		$alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . '</div>';
	}

	return $alerta;
}

function borrarErrores()
{
	$borrado = false;

	if (isset($_SESSION["errores"])) {
		$_SESSION["errores"] = null;
	}

	if (isset($_SESSION["completado"])) {
		$_SESSION["completado"] = null;
	}

	session_unset();
	return $borrado;
}

function conseguirCategorias($con)
{
	$sql = "SELECT * FROM categorias";
	$categorias = mysqli_query($con, $sql);
	$result = array();

	if ($categorias && mysqli_num_rows($categorias) >= 1) {
		$result = $categorias;
	}

	return $result;
}
