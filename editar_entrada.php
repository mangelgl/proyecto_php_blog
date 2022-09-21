<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php $entrada_actual = conseguirEntrada($con, $_GET['id']);
if (!isset($entrada_actual['id'])) {
    header('Location: index.php');
}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>
<div id="principal">
    <h1>Editar entradas</h1>
    <p>Edita tu entrada <?= $entrada_actual["titulo"]; ?></p>
    <form action="guardar_entradas.php?editar=<?= $entrada_actual["id"]; ?>" method="POST">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" value="<?= $entrada_actual["titulo"] ?>">

        <label for="descripcion">Descripción</label>
        <textarea type="text" name="descripcion"><?= $entrada_actual["descripcion"]; ?></textarea> <br>

        <label for="categoria">Categoría</label>
        <select name="categorias" id="">
            <?php
            $categorias = conseguirCategorias($con);
            if (!empty($categorias)) :
                while ($categoria = mysqli_fetch_assoc($categorias)) : ?>
                    <option value="<?= $categoria["id"]; ?>" <?= ($categoria["id"] == $entrada_actual["categoria_id"]) ? 'selected="selected"' : '' ?>>
                        <?= $categoria["nombre_categoria"]; ?>
                    </option>
            <?php endwhile;
            endif; ?>
        </select>
        <?php echo isset($_SESSION["errores_entrada"]) ? mostrarError($_SESSION["errores_entrada"], "categoria") : ''; ?>

        <input type="submit" value="Editar entrada">
    </form>

    <?php borrarErrores(); ?>

</div> <!-- Fin caja principal -->

<?php require_once 'includes/pie.php'; ?>