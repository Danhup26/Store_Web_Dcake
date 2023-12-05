<?php

require '../config/config.php';
require '../config/conexion_producto.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = isset($_POST['Codigo']) ? $_POST['Codigo'] : 0;

    if ($action == 'agregar') {
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        $respuesta = agregar($id, $cantidad);
        if ($respuesta > 0) {
            $datos['ok'] = true;
        } else {
            $datos['ok'] = false;
        }
        $datos['sub'] = MONEDA . number_format($respuesta, 2, ',', '.');
        $datos['total'] = MONEDA . number_format(calcularTotal(), 2, ',', '.'); // Agregar el total al retorno
    } elseif ($action == 'eliminar') {
        $datos['ok'] = eliminar($id);
        $datos['total'] = MONEDA . number_format(calcularTotal(), 2, ',', '.'); // Agregar el total al retorno
    } else {
        $datos['ok'] = false;
    }
} else {
    $datos['ok'] = false;
}

echo json_encode($datos);

function agregar($id, $cantidad)
{
    $res = 0;
    if ($id > 0 && $cantidad > 0 && is_numeric($cantidad)) {
        if (isset($_SESSION['carrito']['productos'][$id])) {
            $_SESSION['carrito']['productos'][$id] = $cantidad;

            $db = new Database();
            $con = $db->conectar();
            $sql = $con->prepare("SELECT Precio, Descuento FROM store_web_dcake.producto WHERE Codigo =? AND Activo = 1 AND id_categoria = 1 LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $precio = $row['Precio'];
            $descuento = $row['Descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
            $res = $cantidad * $precio_desc;

            // Enviar el nuevo total al frontend
            return $res;
        }
    }
    return $res;
}

function calcularTotal()
{
    $total = 0;
    foreach ($_SESSION['carrito']['productos'] as $id => $cantidad) {
        $db = new Database();
        $con = $db->conectar();
        $sql = $con->prepare("SELECT Precio, Descuento FROM store_web_dcake.producto WHERE Codigo =? AND Activo = 1 AND id_categoria = 1 LIMIT 1");
        $sql->execute([$id]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $precio = $row['Precio'];
        $descuento = $row['Descuento'];
        $precio_desc = $precio - (($precio * $descuento) / 100);
        $total += $cantidad * $precio_desc;
    }

    return $total;
}

function eliminar($id)
{
    if ($id > 0) {
        if (isset($_SESSION['carrito']['productos'][$id])) {
            unset($_SESSION['carrito']['productos'][$id]);
            return true;
        }
    }
    return false;
}
