<?php
session_start();
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

$conexion = mysqli_connect("localhost", "root", "", "rol");
$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contraseña='$contraseña'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_fetch_array($resultado);

if ($filas) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['id_cargo'] = $filas['id_cargo'];

    if ($filas['id_cargo'] == 1) { // Administrador
        header("Location: ../html/admin.html");
    } elseif ($filas['id_cargo'] == 2) { // Cliente
        header("Location: ../html/index.php");
    } else {
        echo "<h1 class='bad'>ERROR EN LA AUTENTIFICACION</h1>";
    }
} else {
    echo "<h1 class='bad'>ERROR EN LA AUTENTIFICACION</h1>";
}

mysqli_free_result($resultado);
mysqli_close($conexion);
exit();
?>
