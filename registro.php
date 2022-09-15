<?php
if (isset($_POST)) {

	// Conexión a la base de datos
	require_once 'includes/conexion.php';

	// Iniciar la sesión
	if (!isset($_SESSION)) {
		session_start();
	}

	// Recorger los valores del formulario de registro
	// Escapar valores en mysql
	$usuario = isset($_POST['usuario']) ? mysqli_real_escape_string($con, trim($_POST['usuario']))  : false;
	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($con, $_POST['nombre']) : false;
	$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($con, $_POST['apellidos']) : false;
	$email = isset($_POST['email']) ? mysqli_real_escape_string($con, trim($_POST['email'])) : false;
	$password = isset($_POST['password']) ? mysqli_real_escape_string($con, trim($_POST['password'])) : false;

	// Array de errores
	$errores = array();

	// Validar los datos antes de guardarlos en la base de datos
	if (!empty($usuario)) {
		$usuario_validado = true;
	} else {
		$usuario_validado = false;
		$errores['usuario'] = "Por favor, introduce un valor válido.";
	}

	if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
		$nombre_validado = true;
	} else {
		$nombre_validado = false;
		$errores['nombre'] = "Por favor, introduce un valor válido.";
	}

	if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
		$apellidos_validado = true;
	} else {
		$apellidos_validado = false;
		$errores['apellidos'] = "Por favor, introduce un valor válido.";
	}

	if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$email_validado = true;
	} else {
		$email_validado = false;
		$errores['email'] = "Por favor, introduce un email válido.";
	}

	if (!empty($password)) {
		$password_validado = true;
	} else {
		$password_validado = false;
		$errores['password'] = "La contraseña no puede estar vacía.";
	}

	$guardar_usuario = false;
	if (count($errores) == 0) {
		$guardar_usuario = true;

		// Cifrar password
		$password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

		// Insertar usuario en base de datos
		$sql = "INSERT INTO seg_users VALUES (null, '$nombre', '$apellidos', '$email', '$usuario', '$password_segura', CURRENT_TIMESTAMP())";
		$result = mysqli_query($con, $sql);
		$error = mysqli_errno($con) . mysqli_error($con);

		if (!$error) {
			$_SESSION["completado"] = "El registro se ha completado con éxito";
		} else {
			$_SESSION["errores"]["general"] = "Fallo al guardar el usuario";
			$_SESSION["errores"]["mensaje"] = $error;
		}
	} else {
		$_SESSION['errores'] = $errores;
	}
}

header('Location: index.php');
