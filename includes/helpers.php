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

function conseguirUltimasEntradas($con)
{
	$sql = "SELECT
				e.*,
				c.nombre_categoria
			FROM entradas e
			JOIN categorias c ON e.categoria_id = c.id
			ORDER BY e.id DESC LIMIT 4";
	$entradas = mysqli_query($con, $sql);
	$result = array();

	if ($entradas && mysqli_num_rows($entradas) >= 1) {
		$result = $entradas;
	}

	return $result;
}
