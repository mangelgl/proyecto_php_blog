<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php $categoria_actual = conseguirCategoria($con, $_GET['id']);
if (!isset($categoria_actual['id'])) {
    header('Location: index.php');
}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- Caja principal -->
<div id="principal">
    <h1>Entradas de <?= $categoria_actual["nombre_categoria"]; ?></h1>

    <?php
    $entradas = conseguirEntradas($con, null, $categoria_actual['id']);
    if (!empty($entradas)) :
        while ($entrada = mysqli_fetch_assoc($entradas)) : ?>
            <article class="entrada">
                <h2><a href="entrada.php?id=<?= $entrada["id"]; ?>"><?= $entrada["titulo"]; ?></a></h2>
                <span class="fecha"><?= $entrada["nombre_categoria"] . " | " . $entrada["fecha_creacion"] . " | " . $entrada["usuario"]; ?></span>
                <p><?= substr($entrada["descripcion"], 0, 200) . "..."; ?></p>
            </article>
        <?php
        endwhile;
    else :
        ?>
        <div class="alerta alerta-error">No hay entradas en esta categoría</div>
    <?php endif; ?>

    <div id="ver-todas">
        <a href="index.php" style="width: 100px; text-align:center;">Volver</a>
    </div>
</div> <!-- Fin caja principal -->

<?php require_once 'includes/pie.php'; ?>