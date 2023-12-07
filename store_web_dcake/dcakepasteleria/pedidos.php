<?php
require '../config/conexion_usuario.php';
// var_dump($_POST);

// Consulta para obtener todos los pedidos
$sql = "SELECT fecha, id_usuario, nombre_usuario, id_pedido, total FROM store_web_dcake.pedido";
$result = $conn->query($sql);

// Comprobar si hay resultados
if ($result->rowCount() > 0) {
    $pedido = $result->fetchAll(PDO::FETCH_ASSOC);
} else {
    $pedido = array(); // Si no hay pedidos, crea un array vacío
}

$conn = null; // Cerrar la conexión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Style.css"> 
    <link rel="shortcut icon" href="/images2/icologo.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"] {
            padding: 8px;
            margin-bottom: 10px;
            width: 200px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .eliminar-btn {
            background-color: #f44336;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .modal-btn {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .modal-btn.cancelar {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <div style="margin: 20px;">
        <h1>Pedidos</h1>
        <input type="text" id="buscador" placeholder="Buscar por ID o por fecha">
        <button onclick="buscar()">Buscar</button>

        <table id="tablaPedidos">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Id Usuario</th>
                    <th>Nombre de usuario</th>
                    <th>Id Pedido</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $contador = 1;
                foreach ($pedido as $pedido) {
                    echo "<tr id='row_{$pedido['id_pedido']}'>";
                    echo "<td>$contador</td>";
                    echo "<td>{$pedido['fecha']}</td>";
                    echo "<td>{$pedido['id_usuario']}</td>";
                    echo "<td>{$pedido['nombre_usuario']}</td>";
                    echo "<td>{$pedido['id_pedido']}</td>";
                    echo "<td>{$pedido['total']}</td>";
                    echo "<td>
                    <button class='eliminar-btn' onclick='confirmarEliminar({$pedido['id_pedido']})'>Eliminar</button>
                    <button class='confirmar-btn-success' onclick='confirmarPedido({$pedido['id_pedido']})'>Confirmar</button>
                    <button class='detalles-btn' onclick='VerDetalles({$pedido['id_pedido']})'>Ver detalles</button>
                    </td>";
                    echo "</tr>";
                    $contador++;
                }
                ?>
            </tbody>
        </table>
    </div>

 <!-- Modal de confirmación para eliminar pedido -->
 <div id="modalEliminar" class="modal">
        <div class="modal-content">
            <p>¿Estás seguro de eliminar este pedido? Tu acción no podrá ser revertida.</p>
            <input type="hidden" id="idPedidoEliminar" value="">
            <button class="modal-btn-ml" onclick="eliminarPedido()">Sí</button>
            <button class="modal-btn cancelar" onclick="cerrarModal()">No</button>
        </div>
    </div>

     <!-- Modal para ver detalles del pedido -->
 <div id="modalDetalles" class="modal">
        <div class="modal-content">
            <p>¿Estás seguro de eliminar este pedido? Tu acción no podrá ser revertida.</p>
            <input type="hidden" id="idPedidoDetalles" value="">
        </div>
    </div>

    <script>
        function buscar() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("buscador");
            filter = input.value.toUpperCase();
            table = document.getElementById("tablaPedidos");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Cambia a [2] para buscar por la columna de Usuario
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function confirmarEliminar(idPedido) {
            var modal = document.getElementById("modalEliminar");
            modal.style.display = "block";

            // Guardar el ID del usuario a eliminar en un campo oculto del modal
            document.getElementById("idPedidoEliminar").value = idPedido;
        }

        function eliminarPedido() {
            // Obtener el ID del usuario a eliminar desde el campo oculto
            var idPedido = document.getElementById("idPedidoEliminar").value;

            // Realizar una solicitud AJAX al servidor para eliminar el usuario
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../config/eliminar_pedido.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Actualizar la tabla después de eliminar el usuario
                    var tableRow = document.getElementById("row_" + idPedido);
                    if (tableRow) {
                        tableRow.remove();
                    }

                    // Una vez implementada la eliminación, cierra el modal
                    cerrarModal();
                }
            };

            xhr.send("idPedido=" + idPedido);
        }

        function cerrarModal() {
            var modal = document.getElementById("modalEliminar");
            modal.style.display = "none";
        }
    </script>
</body>
</html>