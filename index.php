<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Últimas entradas</h1>

	<?php
	$entradas = conseguirUltimasEntradas($con);
	if (!empty($entradas)) :
		while ($entrada = mysqli_fetch_assoc($entradas)) : ?>
			<article class="entrada">
				<h2><?= $entrada["titulo"]; ?></h2>
				<span class="fecha"><?= $entrada["nombre_categoria"] . " | " . $entrada["fecha_creacion"]; ?></span>
				<p><?= substr($entrada["descripcion"], 0, 200) . "..."; ?></p>
			</article>
	<?php
		endwhile;
	endif;
	?>

	<div id="ver-todas">
		<a href="">Ver todas las entradas</a>
	</div>
</div> <!-- Fin principal -->

<?php require_once 'includes/pie.php'; ?>