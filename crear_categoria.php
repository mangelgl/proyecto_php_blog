<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- Caja principal -->
<div id="principal">
    <h1>Crear categorías</h1>
    <p>Añade nuevas categorías al blog para que los usuarios puedan usarlas al crear sus entradas.</p>
    <form action="guardar_categoria.php" method="POST">
        <label for="nombre_categoria">Nombre</label>
        <input type="text" name="nombre_categoria" id="inp-categoria">
        <?php echo isset($_SESSION["errores_categoria"]) ? mostrarError($_SESSION["errores_categoria"], "nombre_categoria") : ''; ?>

        <input type="submit" value="Crear categoría">
    </form>

    <?php borrarErrores(); ?>

    <!--     <div id="ver-todas">
        <a href="#">Ver todas las entradas</a>
    </div> -->
</div> <!-- Fin caja principal -->

<?php require_once 'includes/pie.php'; ?>