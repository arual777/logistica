<?php
if (isset($_SESSION['usuario'])) {
    session_unset();
    session_destroy();
    header("Location:view/login.php?cerrarSesion");
} else {
    header("Location:view/login.php?cerrarSesion");
    exit();
}
