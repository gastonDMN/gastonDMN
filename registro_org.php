<?php 
require("header-link.php");
?>
<body class="registro">
<div class="container">
    <div class="image-section">
        <div class="overlay-text">
            <h2 class="image-heading">¡Vive el momento, celebra cada instante!</h2>
            <p class="image-paragraph">"Descubre y explora los eventos más emocionantes cerca de ti, y vive cada experiencia al máximo."</p>
        </div>
    </div>
    <div class="form-section">
        <div class="login-link">
            <span>¿Ya tienes usuario?</span>
            <a href="login.php">Iniciar Sesión</a>
            <br>
            <br>
            <span>¿No sos organizador?</span>
            <a href="registro.php">Registrarme</a>
        </div>
      
        <div class="logo">
            <img src="./img/logooriginal-removebg-preview.png" alt="Eventual Logo">
        </div>
        <h2 class="form-heading">Comienza totalmente gratis!</h2>
        <p class="form-paragraph">Ingresa la siguiente información para registrarte</p>

        <form  id="from-regis" action="registrar_usuario.php" method="POST">
        <div class="input-group">
                <input class="register-input" type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                <input class="register-input" type="text" id="nombre_de_usuario" name="nombre_de_usuario" placeholder="Nombre de usuario" required>
                <input class="register-input" type="text" id="nombre" name="direccion" placeholder="Dirección" required>

            </div>
            <div class="input-group">
                <input class="register-input" type="tel" id="telefono" name="telefono" placeholder="Teléfono" required>
                <input class="register-input" type="date" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha De Nacimiento" required>
            </div>
            <input class="register-input" type="email" id="correo_electronico" name="correo_electronico" placeholder="Correo Electrónico" required>
            <input class="register-input" type="password" id="contrasenia" name="contrasenia" placeholder="Contraseña" required>
            <label>
                <input type="checkbox" required> 
                Al seleccionar esta opción, confirmas que has leído y aceptas los <a href="#">Términos y Condiciones</a> y la <a href="#">Política de Privacidad</a>.
            </label>
                <button class="register-button" type="submit">Crear una cuenta</button>
            </form>
        </div>
    </div>
</body>

<?php require("footer.php"); ?>