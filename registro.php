<?php
if (isset($_POST)) {

	// Conexión a la base de datos
	require_once 'includes/conexion.php';

	// Recorger los valores del formulario de registro
	$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
	$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
	$email = isset($_POST['email']) ? $_POST['email'] : false;
	$password = isset($_POST['password']) ? $_POST['password'] : false;

	// Array de errores
	$errores = array();

	// Validar los datos antes de guardarlos en la base de datos
	if (!empty($usuario) && !is_numeric($usuario)) {
		$usuario_validado = true;
	} else {
		$usuario_validado = false;
		$errores['usuario'] = "El usuario no es válido";
	}

	if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
		$nombre_validado = true;
	} else {
		$nombre_validado = false;
		$errores['nombre'] = "El nombre no es válido";
	}

	if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
		$apellidos_validado = true;
	} else {
		$apellidos_validado = false;
		$errores['apellidos'] = "Los apellidos no son válido";
	}

	if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$email_validado = true;
	} else {
		$email_validado = false;
		$errores['email'] = "El email no es válido";
	}

	if (!empty($password)) {
		$password_validado = true;
	} else {
		$password_validado = false;
		$errores['password'] = "La contraseña está vacía";
	}

	$guardar_usuario = false;
	if (count($errores) == 0) {
		$guardar_usuario = true;

		// Cifrar password
		$password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

		// Insertar usuario en base de datos
		$sql = "INSERT INTO seg_users_prueba VALUES (null, '$nombre', '$apellidos', '$email', '$usuario', '$password_segura', CURRENT_TIMESTAMP())";
		$result = mysqli_query($con, $sql);

		if ($result) {
			$_SESSION["completado"] = "El registro se ha completado con éxito";
		} else {
			$_SESSION["errores"]["general"] = "Fallo al guardar el usuario";
		}
	} else {
		$_SESSION['errores'] = $errores;
	}
}

header('Location: index.php');
