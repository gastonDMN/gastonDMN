<?php
require("header.php");
require("header-link.php");

session_start();

// Verifica si la sesión está iniciada, si no redirige al login
if (!isset($_SESSION['nombre_de_usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<body class="busqueda"></div>
<h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_de_usuario']); ?></h1>
<a href="logout.php">Cerrar Sesión</a>
<hr>
<a href="./abm.php"><button id="botonadmin" style="display:none;">Ingreso ABM</button></a>

<form id="form-buscar-evento" class="buscar-evento-form">
    <label for="evento" class="buscar-evento-label">
        <input type="text" name="evento" id="evento" class="buscar-evento-input" placeholder="Ingrese el nombre del evento deseado" required>
        <input type="submit" value="Buscar" name="envio2" class="buscar-evento-submit">
        <input type="reset" value="Cancelar" class="buscar-evento-reset">
    </label>
</form>

<div id="resultado" class="buscar-evento-resultado"></div>



<script>
window.onload = function() {
    // Supongamos que tienes el rol en una variable PHP
    var role = "<?php echo $_SESSION['role']; ?>";
    if (role === 'admin') {
        document.getElementById('botonadmin').style.display = 'block';
    }
};
</script>

<?php require("footer.php"); ?>
</body>