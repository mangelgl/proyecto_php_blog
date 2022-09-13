<?php
require_once 'conexion.php';
require_once 'helpers.php';
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title>Blog de Videojuegos</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="./assets/img/favicon_io/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="./assets/img/favicon_io/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="./assets/img/favicon_io/favicon-16x16.png">
	<link rel="icon" type="image/png" sizes="512x512" href="./assets/img/favicon_io/android-chrome-512x512.png">
	<link rel="manifest" href="./assets/img/favicon_io/site.webmanifest">
</head>

<body>
	<!-- CABECERA -->
	<header id="cabecera">
		<!-- LOGO -->
		<div id="logo">
			<a href="index.php">
				Blog de Videojuegos
			</a>
		</div>

		<!-- MENU -->
		<nav id="menu">
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<?php
				$categorias = conseguirCategorias($con);
				while ($categoria = mysqli_fetch_assoc($categorias)) : ?>
					<li>
						<a href="categoria.php?id=<?= $categoria["id"]; ?>"><?= $categoria["nombre_categoria"]; ?></a>
					</li>
				<?php endwhile; ?>
				<li><a href="index.php">Sobre mí</a></li>
				<li><a href="index.php">Contacto</a></li>
			</ul>
		</nav>

		<div class="clearfix"></div>
	</header>

	<div id="contenedor">