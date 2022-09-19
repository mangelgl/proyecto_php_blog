<!-- BARRA LATERAL -->
<aside id="sidebar">

	<?php if (isset($_SESSION["usuario"])) : ?>
		<div id="usuario-logueado" class="bloque">
			<h4>Bienvenido, <?= $_SESSION["usuario"]["nombre"] . " " . $_SESSION["usuario"]["apellidos"]; ?></h4>
			<!-- Botones -->
			<a href="#" class="boton boton-verde">Crear entradas</a>
			<a href="crear_categoria.php" class="boton boton-morado">Crear categorías</a>
			<a href="#" class="boton boton-naranja">Mis datos</a>
			<a href="cerrar_sesion.php" class="boton boton-logout">Cerrar sesión</a>
		</div>
	<?php endif; ?>

	<?php if (!isset($_SESSION["usuario"])) : ?>

		<div id="login" class="bloque">
			<h3>Identificate</h3>
			<?php if (isset($_SESSION["error_login"])) : ?>
				<div class="alerta alerta-error">
					<?= $_SESSION["error_login"]; ?>
				</div>
			<?php endif; ?>

			<form action="login.php" method="POST">
				<input type="text" name="nickname" placeholder="Usuario" />
				<input type="password" name="password" autocomplete="off" placeholder="Password" />

				<input type="submit" value="Entrar" />
			</form>
		</div>

		<div id="register" class="bloque">
			<h3>Regístrate</h3>

			<!-- Mostrar errores -->
			<?php if (isset($_SESSION["completado"])) : ?>
				<div class="alerta alerta-exito"> <?= $_SESSION["completado"] ?> </div>
			<?php elseif (isset($_SESSION["errores"]["general"])) : ?>
				<div class="alerta alerta-error"> <?= $_SESSION["errores"]["general"] . $_SESSION["errores"]["mensaje"] ?> </div>
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
	<?php endif; ?>
</aside>