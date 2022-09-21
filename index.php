<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Últimas entradas</h1>

	<?php
	$entradas = conseguirEntradas($con, true);
	if (!empty($entradas)) :
		while ($entrada = mysqli_fetch_assoc($entradas)) : ?>
			<article class="entrada">
				<h2><a href="entrada.php?id=<?= $entrada["id"]; ?>"><?= $entrada["titulo"]; ?></a></h2>
				<span class="fecha"><?= $entrada["nombre_categoria"] . " | " . $entrada["fecha_creacion"] . " | " . $entrada["usuario"]; ?></span>
				<p><?= substr($entrada["descripcion"], 0, 200) . "..."; ?></p>
			</article>
	<?php
		endwhile;
	endif;
	?>

	<div id="ver-todas">
		<a href="entradas.php">Ver todas las entradas</a>
	</div>
</div> <!-- Fin principal -->

<?php require_once 'includes/pie.php'; ?>