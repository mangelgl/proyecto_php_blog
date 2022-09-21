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
		unset($_SESSION["errores"]);
		$borrado = true;
	}

	if (isset($_SESSION["errores_entrada"])) {
		$_SESSION["errores_entrada"] = null;
		unset($_SESSION["errores_entrada"]);
		$borrado = true;
	}

	if (isset($_SESSION["errores_categoria"])) {
		$_SESSION["errores_categoria"] = null;
		unset($_SESSION["errores_categoria"]);
		$borrado = true;
	}

	if (isset($_SESSION["completado"])) {
		$_SESSION["completado"] = null;
		unset($_SESSION["completado"]);
		$borrado = true;
	}

	//session_unset();
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

function conseguirCategoria($con, $id)
{
	$sql = "SELECT * FROM categorias WHERE id = $id";
	$categorias = mysqli_query($con, $sql);
	$result = array();

	if ($categorias && mysqli_num_rows($categorias) >= 1) {
		$result = mysqli_fetch_assoc($categorias);
	}

	return $result;
}

function conseguirEntradas($con, $limit = null, $categoria = null, $busqueda = null)
{
	$categoria = intval($categoria);
	$sql = "SELECT
				e.*,
				c.nombre_categoria,
				CONCAT(u.nombre,' ',u.apellidos) as usuario
			FROM entradas e
			JOIN categorias c ON e.categoria_id = c.id
			JOIN seg_users u ON e.usuario_id = u.id";
	if (!empty($categoria) && is_int($categoria)) {
		$sql .= " WHERE e.categoria_id = $categoria";
	}

	if (!empty($busqueda)) {
		$sql .= " WHERE e.titulo LIKE '%$busqueda%'";
	}
	$sql .= " ORDER BY e.id DESC";
	if ($limit) $sql .= " LIMIT 4";
	$entradas = mysqli_query($con, $sql);
	$result = array();

	if ($entradas && mysqli_num_rows($entradas) >= 1) {
		$result = $entradas;
	}

	return $result;
}

function conseguirEntrada($con, $id)
{
	$sql = "SELECT
				e.*,
				c.nombre_categoria,
				CONCAT(u.nombre,' ',u.apellidos) as usuario
			FROM entradas e
			JOIN categorias c ON e.categoria_id = c.id
			JOIN seg_users u ON e.usuario_id = u.id
			WHERE e.id = $id";
	/* if (!empty($categoria) && is_int($categoria)) {
		$sql .= " WHERE e.categoria_id = $categoria";
	} */
	$entrada = mysqli_query($con, $sql);
	$result = array();

	if ($entrada && mysqli_num_rows($entrada) >= 1) {
		$result = mysqli_fetch_assoc($entrada);
	}

	return $result;
}
