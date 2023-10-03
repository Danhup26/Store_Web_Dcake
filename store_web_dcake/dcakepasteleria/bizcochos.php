<?php

require '../config/config.php';
require '../config/conexion_producto.php';

$db = new Database();
$con = $db->conectar();

$sql = $con-> prepare("SELECT Codigo,Nombre,Precio FROM store_web_dcake.producto WHERE Activo = 1 AND id_categoria = 1");
$sql -> execute();
$resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
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
                    <a href="/index.php">
                 <img class = "logo zoomlogo"src="/images2/dcakelogo.png" alt="dcake logo oficial">
            </a>
          <input class = "searchinput" type="text" placeholder = "¿Que desea degustar?">
        </div>
          <nav class = infoprincipal>
            <a class = font_textinfo href="#">Télefono: (604) 34 233 23</a>
            <a class = font_textinfo href="#">Servicio al cliente</a>
            <a class = font_textinfo href="#">Ayuda</a>
          </nav>
    </header>

    <nav class = "general_nav1 "> 
            <!-- barra de navegacion -->
            <a class= "product"href="/dcakepasteleria/bizcochos.php"> Bizcochos</a>
            <a class= "product"href="bizcochos+con+relleno.php"> Bizcochos con relleno</a>
            <a class= "product"href="#"> Bizcochos con relleno y cobertura</a>
            <a class= "product"href="#"> Postres</a>
            <a class= "product"href="#"> Cupcakes</a>
            <a class= "product"href="#"> Brownies</a>
    </nav>
    
    <div class = "BIZCOCHOS">
        <h2 >
            BIZCOCHOS
        </h2>
    </div>

    <section class = " torta_naranja">
    <?php  foreach($resultado as $row){?>
        <div class = "col_producto">
            <?php 
            $id = $row["Codigo"];
            $imagen = "../images/producto/bizcochos/$id/principalimg.jpg";

            if(!file_exists($imagen)){
                $imagen = "../images/nofoto.jpg";
            }
            ?>
            <img class = "bizcocho"src="<?php echo $imagen; ?>" alt="">
            <h3 class = text_bizcocho_naranja>
                <?php echo $row['Nombre'] ?>
            </h3>
            <p class = "precio">
                <?php echo number_format ($row['Precio'],2, ',','.'); ?>
            </p>

            <p class = "btn btn-primary btn-lg center">
                 <a href="detalles.php?Codigo=<?php echo $row['Codigo']; ?>&token=<?php echo hash_hmac("sha1", $row['Codigo'], KEY_TOKEN); ?>" class="text_detalle">Detalles</a>
            </p>
            <p class = "btn btn-secondary btn-lg">
                <a class = "text_agregar"href="#">Añadir a mi carrito</a>
            </p>
            <?php } ?>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>