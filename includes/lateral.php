<?php require_once 'includes/helpers.php'; ?>
<!-- BARRA LATERAL -->
<aside id="sidebar">

	<div id="login" class="bloque">
		<h3>Identificate</h3>
		<form action="login.php" method="POST">
			<input type="email" name="email" placeholder="Email o usuario" />
			<input type="password" name="password" autocomplete="off" placeholder="Password" />

			<input type="submit" value="Entrar" />
		</form>
	</div>

	<div id="register" class="bloque">
		<h3>Regístrate</h3>

		<!-- Mostrar errores -->
		<?php if (isset($_SESSION["completado"])) : ?>
			<div class="alerta alerta-exito"> <?= $_SESSION["completado"] ?> </div>
		<?php else : ?>
			<div class="alerta alerta-error"> <?= $_SESSION["errores"]["general"] ?> </div>
		<?php endif; ?>

		<form action="registro.php" method="POST">
			<input type="text" name="usuario" placeholder="Usuario" />
			<?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"], "usuario") : ''; ?>

			<input type="text" name="nombre" placeholder="Nombre" />
			<?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"], "nombre") : ''; ?>

			<input type="text" name="apellidos" placeholder="Apellidos" />
			<?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"], "apellidos") : ''; ?>

			<input type="email" name="email" placeholder="Email" />
			<?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"], "email") : ''; ?>

			<input type="password" name="password" autocomplete="off" placeholder="Password" />
			<?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"], "password") : ''; ?>

			<input type="submit" name="submit" value="Registrar" />
		</form>

		<?php borrarErrores(); ?>
	</div>
</aside>