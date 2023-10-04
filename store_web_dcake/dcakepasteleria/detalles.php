
<?php

require '../config/config.php';
require '../config/conexion_producto.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['Codigo']) ? $_GET['Codigo'] :  '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token == '') {
    echo 'Error en la petición'; 
     exit;
} else{

    $token_tmp = hash_hmac("sha1", $id, KEY_TOKEN);

    if($token == $token_tmp){

        $sql = $con-> prepare("SELECT count(Codigo) FROM store_web_dcake.producto WHERE Codigo =? AND Activo = 1 AND id_categoria = 1");
        $sql -> execute([$id]);
        if($sql -> fetchColumn() >0){

            $sql = $con-> prepare("SELECT Nombre, Descripción, Precio, Descuento FROM store_web_dcake.producto WHERE Codigo =? AND Activo = 1 AND id_categoria = 1 
            LIMIT 1");
            $sql -> execute([$id]);
            $row = $sql-> fetch(PDO::FETCH_ASSOC);
            $nombre = $row['Nombre'];
            $descripcion = $row['Descripción'];
            $precio = $row['Precio'];
            $descuento = $row['Descuento'];
            // Sacar descuento
            $precio_desc = $precio - (($precio * $descuento) / 100);

            //Imagenes dinamicas
            $dir_images = '../images/producto/bizcochos/'. $id .'/';

            $rutaImg = $dir_images . '/principalimg.jpg';

            if(!file_exists($rutaImg)){
                $rutaImg = '/images/nofoto.jpg';
            }

            $imagenes = array();
            if(file_exists($dir_images))
            {
                $dir = dir($dir_images);

             while(($archivo = $dir ->read()) != false) {
                    if($archivo != 'principalimg.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg') )){
                        $imagenes[] = $dir_images . $archivo; 
                    }
             }
             $dir-> close();
            }
        }
    } else{
        echo 'Error en el procesamiento';
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'cake pasteleria</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&family=Sedgwick+Ave+Display&display=swap" rel="stylesheet">
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
            <a href="../index.php">
                 <img class = "logo zoomlogo"src="/images2/dcakelogo.png" alt="dcake logo oficial">
            </a>
          <input class = "searchinput" name = "busqueda" type="text" placeholder = "¿Que desea degustar?">
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

            <a class = "textmicarrito" href="../checkout.php">
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

    <nav class = "general_nav1 "> 
            <!-- barra de navegacion -->
            <a class= "product"href="bizcochos.php"> Bizcochos</a>
            <a class= "product"href="#"> Bizcochos con relleno</a>
            <a class= "product"href="#"> Bizcochos con relleno y cobertura</a>
            <a class= "product"href="#"> Postres</a>
            <a class= "product"href="#"> Cupcakes</a>
            <a class= "product"href="#"> Brownies</a>
    </nav>
    <main class = "container-sm">
        <div class = "d-flex  d-grid gap-3">
            <div>
                <div>
                    <h1><?php echo $nombre;?></h1>
                </div>
                <div id="carouselExample" class="carousel slide">
                     <div class="carousel-inner">
                     <div class="carousel-item active">
                        <img class = "bizcocho"src="<?php echo $rutaImg;?>" class="d-block w-100">
                        </div>

                        <?php  foreach( $imagenes as $img){?>
                    <div class="carousel-item">
                        <img class = "bizcocho"src="<?php echo $img;?>" class="d-block w-100">
                    </div>
                    <?php }?>
                    </div>
                        <button class="carouselImages" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carouselImages" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                         </button>
                    </div>
                </div>
            </div>

            <?php if($descuento > 0 ) { ?>
            <div>
                 <p><del><?php echo MONEDA . number_format($precio, 2, ',','.'); ?></del></p>
            </div>   

            <div> 
                <h2>
                <?php echo MONEDA . number_format($precio_desc, 2, ',','.'); ?>
                <small class = "text-success"><?php echo $descuento; ?>% de descuento</small>
                </h2>
            </div>   

            <?php } else {?> 
            <div class = "d-grid gap-3 col-9 mx.10">       
                <h2><?php echo MONEDA . number_format($precio, 2, ',','.'); ?></h2>
            </div> 

            <?php } ?>

            <div class = "d-grid gap-3 col-9 descrip">
                <h4>Descripción</h4>
                <p class ="tt-desc-posi"> <?php echo $descripcion;?> </p>
            </div>
        
            <div class = "d-grid gap-3 col-5 mx.auto">
                <button class ="btn btn-primary btn-lg" type="button">Comprar ahora</button>
                <button class ="btn btn-primary btn-lg" type="button" onclick = "addProducto(<?php echo 
                $id; ?>, '<?php echo $token_tmp;?>')">Añadir al carrito</button>

                 </div>  
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        function addProducto(id, token){
            let url = '../clases/carrito.php'
            let formData = new FormData()
            formData.append('Codigo', id)
            formData.append('token', token)

            fetch(url,{
                method: 'POST',
                body: formData,
                mode: 'cors'
             }).then(response => response.json())
             .then(data => {
                if(data.ok){
                    let elemento = document.getElementById("num_cart")
                    elemento.innerHTML = data.numero
                }else {
      console.error("Error en la respuesta:", data.error);
    }
  })
  .catch(error => {
    console.error("Error en la solicitud:", error);
  });
            }
    </script>
</body>
</html>