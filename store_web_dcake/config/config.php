<?php
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "$");

// Verifica si la sesión ya está activa
if (session_status() == PHP_SESSION_NONE) {
    // Si no está activa, inicia la sesión
    session_start();
}

// Calcula el número de productos en el carrito
$num_cart = isset($_SESSION['carrito']['productos']) ? count($_SESSION['carrito']['productos']) : 0;
?>
