<html>
<body class="logincitoc">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<?php
session_start();

// Verifica si ya hay una sesión activa
if (isset($_SESSION['nombre_de_usuario'])) {
    header("Location: home_usuario.php");
    exit();
}

// Si no hay sesión pero existe la cookie, restablecemos la sesión
if (!isset($_SESSION['nombre_de_usuario']) && isset($_COOKIE['nombre_de_usuario'])) {
    $_SESSION['nombre_de_usuario'] = $_COOKIE['nombre_de_usuario'];
    header("Location: home_usuario.php");
    exit();
}
?>


<div class="cLOGIN h-100">

<!-- Mostrar error si existe -->
<?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <p style="color: red;">Usuario o contraseña incorrectos.</p>
        <?php endif; ?>

    <div class="row h-100">
           
        <!-- lado izquierdo de la página donde se encuentra la imagen -->
        <div class="col-md-6 izquierdac d-none d-md-block"></div>

        <!-- lado derecho de la página con el formulario de inicio de sesión -->
        <div class="col-md-6 derechac">

                <div class="logo-loginc">
                     <img src="./img/logooriginal-removebg-preview.png">
                 </div>

                <div class="loginc">

                     <div class="registratec mt-3">
                         <a href="registro.php"><p>¿No tienes cuenta?</p>Regístrate aquí</a>
                      </div>

                      <h2>Bienvenido de vuelta!</h2>

                     <p class="subtituloc text-center mt-2"><i>ingresa la siguiente información para poder iniciar sesión</i></p>

                    <!--aqui comienza el formulario-->
                    <form method="post" action="procesar.php">
                        
                         <!-- input donde le usuario ingresa su nombre -->
                         <div>
                          <input type="text" class="inputtc" name="nombre" id="nombre" oninput="this.value.replace(/[^a-zA-Z0-9_]/g, '')"  placeholder="Usuario" required>
                         </div>

                        
                          <!-- input donde el usuario ingesa su contraseña -->
                        <div>
                              <input type="password" class="inputtc"  name="pass" id="pass" placeholder="Contraseña" required>
                        </div>


                           <!-- checkbox de recordatorio -->
                           <div class="caja-checkc form-check">
                             <input type="checkbox" name="recordar_sesion" value="1">
                             <label>Recordarme</label>
                           </div>

                          <!-- link para la contraseña olvidada -->
                           <div class="contra-olvidadac mt-3">
                              <a class="contra-olvidadac" href="#">¿Olvidaste tu contraseña?</a>
                           </div>
                        

                         <!-- Botón de inicio de sesión -->
                         <button type="submit" class="botonc btn-primary w-100" value="Ingresar" name="envio">Iniciar sesión</button>

                    </form>
                </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


