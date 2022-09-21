<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php $entrada_actual = conseguirEntrada($con, $_GET['id']);
if (!isset($entrada_actual['id'])) {
    header('Location: index.php');
}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- Caja principal -->
<div id="principal">
    <h1><?= $entrada_actual["titulo"]; ?></h1>
    <a href="categoria.php?id=<?= $entrada_actual["categoria_id"]; ?>">
        <h2><?= $entrada_actual["nombre_categoria"]; ?></h2>
    </a>
    <h4><?= $entrada_actual["fecha_creacion"] . " | " . $entrada_actual["usuario"]; ?></h4>

    <p><?= $entrada_actual["descripcion"]; ?></p>

    <?php if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]["id"] == $entrada_actual["usuario_id"]) : ?>
        <a href="editar_entrada.php?id=<?= $entrada_actual["id"] ?>" class="boton boton-verde">Editar entrada</a>
        <a href="borrar_entrada.php?id=<?= $entrada_actual["id"] ?>" class="boton boton-morado">Borrar entrada</a>
    <?php endif; ?>

    <div id="ver-todas">
        <a href="index.php" style="width: 100px; text-align:center;">Volver</a>
    </div>
</div> <!-- Fin caja principal -->

<?php require_once 'includes/pie.php'; ?>