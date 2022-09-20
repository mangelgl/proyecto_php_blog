<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- Caja principal -->
<div id="principal">
    <h1>Crear categorías</h1>
    <p>Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.</p>
    <form action="guardar_entradas.php" method="POST">
        <label for="titulo">Título</label>
        <input type="text" name="titulo">
        <?php echo isset($_SESSION["errores_entrada"]) ? mostrarError($_SESSION["errores_entrada"], "titulo") : ''; ?>

        <label for="descripcion">Descripción</label>
        <textarea type="text" name="descripcion"></textarea> <br>
        <?php echo isset($_SESSION["errores_entrada"]) ? mostrarError($_SESSION["errores_entrada"], "descripcion") : ''; ?>

        <label for="categoria">Categoría</label>
        <select name="categorias" id="">
            <?php
            $categorias = conseguirCategorias($con);
            if (!empty($categorias)) :
                while ($categoria = mysqli_fetch_assoc($categorias)) : ?>
                    <option value="<?= $categoria["id"]; ?>"><?= $categoria["nombre_categoria"]; ?></option>
            <?php endwhile;
            endif; ?>
        </select>
        <?php echo isset($_SESSION["errores_entrada"]) ? mostrarError($_SESSION["errores_entrada"], "categoria") : ''; ?>

        <input type="submit" value="Crear entrada">
    </form>

    <?php borrarErrores(); ?>

    <!--     <div id="ver-todas">
        <a href="#">Ver todas las entradas</a>
    </div> -->
</div> <!-- Fin caja principal -->

<?php require_once 'includes/pie.php'; ?>