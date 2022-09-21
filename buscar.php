<?php
if (!isset($_POST['busqueda'])) {
    header('Location: index.php');
}

?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- Caja principal -->
<div id="principal">
    <h1>Búsqueda de entradas</h1>
    <p><em>Mostrando los resultados de: <?= $_POST["busqueda"]; ?></em></p>

    <?php
    $entradas = conseguirEntradas($con, null, null, $_POST['busqueda']);
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
        <div class="alerta alerta-error">No hay resultados para su búsqueda</div>
    <?php endif; ?>

    <div id="ver-todas">
        <a href="index.php" style="width: 100px; text-align:center;">Volver</a>
    </div>
</div> <!-- Fin caja principal -->

<?php require_once 'includes/pie.php'; ?>