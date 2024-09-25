<?php
session_start();
session_unset(); // Limpia todas las variables de sesión
session_destroy(); // Destruye la sesión actual
// Elimina la cookie de "Recordarme"
setcookie('nombre_de_usuario', '', time() - 3600, "/"); // Eliminar la cookie
header("Location: login.php");
exit();
?>
