<?php
session_start();
session_unset(); // Destruye todas las variables de sesión
session_destroy(); // Destruye la sesión

header("Location: ../html/login.html"); // Redirige a la página de inicio de sesión
exit();
?>
