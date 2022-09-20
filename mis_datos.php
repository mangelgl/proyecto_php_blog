<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- Caja principal -->
<div id="principal">
    <h1>Mis datos</h1>

    <!-- Mostrar errores -->
    <?php if (isset($_SESSION["completado"])) : ?>
        <div class="alerta alerta-exito"> <?= $_SESSION["completado"] ?> </div>
    <?php elseif (isset($_SESSION["errores"]["general"])) : ?>
        <div class="alerta alerta-error"> <?= $_SESSION["errores"]["general"] . $_SESSION["errores"]["mensaje"] ?> </div>
    <?php endif; ?>

    <form action="actualizar_datos_usuario.php" method="POST">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" value="<?= $_SESSION["usuario"]["nickname"]; ?>" />
        <?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"], "usuario") : ''; ?>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= $_SESSION["usuario"]["nombre"]; ?>" />
        <?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"], "nombre") : ''; ?>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" value="<?= $_SESSION["usuario"]["apellidos"]; ?>" />
        <?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"], "apellidos") : ''; ?>

        <input type="submit" name="submit" value="Actualizar usuario" />
    </form>

    <?php borrarErrores(); ?>

</div> <!-- Fin caja principal -->

<?php require_once 'includes/pie.php'; ?>