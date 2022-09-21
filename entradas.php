<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- Caja principal -->
<div id="principal">
    <h1>Listado de entradas</h1>

    <?php
    $entradas = conseguirEntradas($con);
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
        <a href="index.php" style="width: 100px; text-align:center;">Volver</a>
    </div>
</div> <!-- Fin caja principal -->

<?php require_once 'includes/pie.php'; ?>