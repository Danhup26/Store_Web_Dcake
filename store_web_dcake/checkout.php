<?php

require 'config/config.php';
require 'config/conexion_producto.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if($productos != null){
    foreach($productos as $clave => $cantidad){

        $sql = $con-> prepare("SELECT Codigo,Nombre,Precio, Descuento, $cantidad AS cantidad FROM store_web_dcake.producto WHERE Codigo = ? AND Activo = 1 AND id_categoria = 1");
        $sql -> execute([$clave]);
        $lista_carrito[]= $sql -> fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'cake pasteleria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/Style.css"> 
    <link rel="shortcut icon" href="/images2/icologo.ico">
</head>

<body class = "margin">
    <a href="https://api.whatsapp.com/send?phone=573008936926" 
     target="_blank">
    <img class = "whatsappicon"src="/images2/whagifs.gif" alt="whatsapp"></a>
    <!-- cabecera de la pagina web, parte superior -->
    <h3 class= "contactar font_contactar">
        WhatsApp
    </h3>
    <header>
        <div class = "justifyheader">
                    <a href="/index.php">
                 <img class = "logo zoomlogo"src="/images2/dcakelogo.png" alt="dcake logo oficial">
            </a>
          <input class = "searchinput" type="text" placeholder = "¿Que desea degustar?">
        </div>
        <div>
            <a href="#">
                <img class= "iconcarrito" src="/images2/carrito.gif" alt="">
            </a>
            <a href="#">
                <img class= "iconvendedor"src="/images2/vendedor.gif" alt="">
            </a>
            <a href="#">
                <img class = "iconestrella"src="/images2/estrella.gif" alt="">
            </a>

            <a class = "textmicarrito" href="../clases/carrito.php">
                 Mi carrito<span id = "num_cart" class = "badge bg-secondary"><?php echo $num_cart; ?></span>
            </a>
            <a class = "textvendedor"href="#">Ingreso a vendedor</a>
            <a class = "textfidelizate"href="#">Fidelizate</a>
        </div>
          <nav class = infoprincipal>
            <a class = font_textinfo href="#">Télefono: (604) 34 233 23</a>
            <a class = font_textinfo href="#">Servicio al cliente</a>
            <a class = font_textinfo href="#">Ayuda</a>
          </nav>
    </header>

    <main >
        <div class = "container"> 
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lista_carrito == null){
                        echo '<tr><td colspan= "5" class = "text-center"><b>Lista vacia</b></td></tr>';
                    }else{

                        $total = 0;
                        foreach($lista_carrito as $producto){
                            $_id = $producto['Codigo'];
                            $nombre = $producto['Nombre'];
                            $precio = $producto['Precio'];
                            $descuento = $producto['Descuento'];
                            $cantidad = $producto['cantidad'];
                            $precio_desc = $precio -(($precio * $descuento) / 100);
                            $subtotal = $cantidad * $precio_desc;
                            $total += $subtotal;
                            ?>
                
                    <tr>
                        <td class="nombre_producto"> <?php echo $nombre?></td>
                        <td class = "precio-producto"> <?php echo MONEDA . number_format($precio_desc, 2, ',' , '.'); ?> </td>
                        <td>
                            <input class = "cantidad-producto"type ="number" min="1" max ="10" step="1" value= "<?php echo 
                            $cantidad ?>" size ="5" id="cantidad_<?php echo $_id; ?>" 
                            onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                        </td>
                        <td class ="subtotal" > 
                            <div id="subtotal_<?php echo $_id ?>" name = "subtotal[]"><?php echo 
                            MONEDA . number_format($subtotal, 2, ',' , '.'); ?></div>
                        </td>    
                        <td> <a href="#" id= "eliminar" class= "btn btn-warning btn-sm" data-bs-id ="<?php 
                        echo $_id ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan = "3"></td>
                        <td colspan = "2">
                        <p class = "h3" id = "total"><?php echo MONEDA . number_format($total, 2 , ',', '.' ); ?></p>
                        </td>
                    </tr>      
                </tbody>
            <?php } ?>                
            </table>    
        </div>

        <div class = "row">
            <div class = "col-md-4 offset-md-6 d-grid gap-2"> 
            <a href="#" id= "pedido" class= "btn btn-success btn-sm" data-bs-id ="<?php 
                        echo $_id ?>" data-bs-toggle="modal" data-bs-target="#pedidoModal">Pagar por WhatsApp</a></td>
            </div>
        </div>
    </main>

     <!-- Modal1  -->
        <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="eliminaModalLabel">Borrar producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estas seguro de eliminar este producto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                <button id = "btn-elimina"type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
            </div>
            </div>
        </div>
        </div>


     <!-- CONTIENE COMPRA A REALIZAR    -->
    <!-- Modal2 -->
    <div class="modal fade" id="pedidoModal" tabindex="-1" aria-labelledby="pedidoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="pedidoModalLabel">Datos del pedido</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="procesar_pedido.php" method="post">
                    <!-- Campos de nombre, dirección, teléfono, correo, etc. -->
                    <label class= "input-group flex-nowrap " for="nombre">Nombre:</label>
                    <input class="form-control" type="text" name="nombre" required><br><br>

                    <label class= "input-group flex-nowrap" for="direccion">Dirección:</label>
                    <input class="form-control" type="text" name="direccion" required><br><br>

                    <label class= "input-group flex-nowrap" for="telefono">Télefono:</label>
                    <input class="form-control" type="text" name="telefono" required><br><br>

                    <label class= "input-group flex-nowrap" for="correo">Correo:</label>
                    <input class="form-control" type="text" name="correo" required><br><br>

                    <!-- Agrega una lista para mostrar los productos seleccionados -->
                    <h2>Productos Seleccionados:</h2>
                    <ul id="lista-productos"></ul>
                    <main >
        <div class = "container"> 
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lista_carrito == null){
                        echo '<tr ><td colspan= "5" class = "text-center"><b>Lista vacia</b></td></tr>';
                    }else{

                          $total = 0;
                        foreach($lista_carrito as $producto){
                            $_id = $producto['Codigo'];
                            $nombre = $producto['Nombre'];
                            $precio = $producto['Precio'];
                            $descuento = $producto['Descuento'];
                            $cantidad = $producto['cantidad'];
                            $precio_desc = $precio -(($precio * $descuento) / 100);
                            $subtotal = $cantidad * $precio_desc;
                            $total += $subtotal;
                            ?>
                
                    <tr class="producto-seleccionado">
                        <td class="product"> <?php echo $nombre?></td>
                        <td class="price"> <?php echo MONEDA . number_format($precio_desc,2, ',' , '.'); ?></td>
                        <td class="cant"> <?php echo $cantidad ?></td>
                        <td class ="subtotal"> 
                            <div id="subtotal_<?php echo $_id ?>" name = "subtotal[]"><?php echo 
                            MONEDA . number_format($subtotal, 2, ',' , '.'); ?></div>
                        </td>    
                        
                    <?php }?>
                    <tr>
                        <td colspan = "3"></td>
                        <td colspan = "2">
                        <p class = "h3" id = "total"><?php echo MONEDA . number_format($total, 2 , ',', '.' ); ?></p>
                        </td>
                    </tr>      
                </tbody>
            <?php } ?>                
            </table>    
        </div>
    </main>                   
</form>
</div>
            <div class="modal-footer">
                <!-- Botón "Ir a WhatsApp" -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                <button id="btn-ir-whatsapp" type="button" class="btn btn-success">Ir a WhatsApp</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        // ACTUALIZAR PRODUCTOS
        let eliminaModal = document.getElementById('eliminaModal')
        eliminaModal.addEventListener('show.bs.modal', function(event){

            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
            buttonElimina.value = id
        })          
        
        function actualizaCantidad(cantidad, id)
        {
            let url = 'clases/actualizar_carrito.php'
            let formData = new FormData()
            formData.append('action', 'agregar')
            formData.append('Codigo', id)
            formData.append('cantidad', cantidad)

            fetch(url,{
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if(data.ok){
                    let divsubtotal = document.getElementById('subtotal_' + id)
                    divsubtotal.innerHTML = data.sub
                
                    let total = 0.00
                    let list = document.getElementsByName('subtotal[]')
                    
                    for(let i = 0; i < list.length; i++){
                        total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
                    }

                    total = new Intl.NumberFormat('en-IN',{
                        minimumFractionDigits: 3
                    }).format(total)
                    document.getElementById('total').innerHTML = '<?php echo MONEDA;?>'+ total
                } 
            })
        }
        // JAVASCRIPT FUNCION ELIMINAR
        function eliminar()
        {
            let botonElimina = document.getElementById('btn-elimina')
            let id = botonElimina.value

            let url = 'clases/actualizar_carrito.php'
            let formData = new FormData()
            formData.append('action', 'eliminar')
            formData.append('Codigo', id)

            fetch(url,{
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if(data.ok){
                    location.reload()
                } 
            })
        }
    </script>

 <!-- REDIRECIONAR A WHATSAPP  -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtén los elementos del formulario
        const nombreInput = document.querySelector('input[name="nombre"]');
        const direccionInput = document.querySelector('input[name="direccion"]');
        const telefonoInput = document.querySelector('input[name="telefono"]');
        const correoInput = document.querySelector('input[name="correo"]');
        const irAWhatsappButton = document.getElementById('btn-ir-whatsapp');

        // Agrega un evento al botón "Ir a WhatsApp"
        irAWhatsappButton.addEventListener('click', function() {
            // Obtén los valores de los campos del formulario
            const nombre = nombreInput.value;
            const direccion = direccionInput.value;
            const telefono = telefonoInput.value;
            const correo = correoInput.value;

            // Construye el mensaje de WhatsApp con los detalles del pedido
            let mensaje = `D'cake pasteleria.\n\nProceso de pedido:\n\nPedido de: ${nombre}\nDirección: ${direccion}\nTeléfono: ${telefono}\nCorreo: ${correo}\nBANCOLOMBIA-AHORRO A LA MANO\n 030-089369-26`;

            // Obtén los productos seleccionados dinámicamente
            const productos = document.querySelectorAll('.producto-seleccionado');
            productos.forEach(function(producto) {
                //const nombreProducto = producto.querySelector('.nombre_producto').textContent;
                const nombreProducto = producto.querySelector('.product').textContent;
                const precioProducto = producto.querySelector('.price').textContent;
                const cantidadProducto = producto.querySelector('.cant').textContent;
                const subtotalProducto = producto.querySelectorAll('.subtotal').textContent;
                mensaje += `\nProducto: ${nombreProducto}\nPrecio: ${precioProducto}\nCantidad: ${cantidadProducto}\n`;
            });

            // URL de WhatsApp para enviar el mensaje
            const whatsappUrl = `https://api.whatsapp.com/send?phone=573008936926&text=${encodeURIComponent(mensaje)}`;

            // Abre WhatsApp en una nueva ventana o pestaña
            window.open(whatsappUrl, '_blank');
        });
    });

</script>
</body>
</html>