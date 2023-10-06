<?php
require 'config/config.php';
require 'config/conexion_producto.php';
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
<body class = "margin general_font1">
    <a href="https://api.whatsapp.com/send?phone=573008936926" 
     target="_blank">
    <img class = "whatsappicon"src="images2/whagifs.gif" alt="whatsapp"></a>
    <!-- cabecera de la pagina web, parte superior -->
    <h3 class= "contactar font_contactar">
        WhatsApp
    </h3>
    <header>
        <div class = "justifyheader">
            <a href="index.php">
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
            <a class = "textvendedor"href="../dcakepasteleria/ingreso_vendedor.php">Portal vendedor</a>
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
            <a class= "product"href="dcakepasteleria/bizcochos.php"> Bizcochos</a>
            <a class= "product"href="dcakepasteleria/bizcochos+con+relleno.php"> Bizcochos con relleno</a>
            <a class= "product"href="#"> Bizcochos con relleno y cobertura</a>
            <a class= "product"href="#"> Postres</a>
            <a class= "product"href="#"> Cupcakes</a>
            <a class= "product"href="#"> Brownies</a>
    </nav>
    <section class = "nonav">
        <div >
            <h3 class = tortas1>
                TORTAS DEL MES
            </h3>
            </div>
            <div>
            <h3 class = tortas1>
                Las mejores tortas son las d D'cake
            </h3>
        </div>
    </section>
        <!-- sección 1 -->
    <section class = "general_section flex text_center">
        <hr>
        <div class = "columna">
             <img class = "sizephoto zoom2"src="images2/torta.jpg" alt="torta de chocolate">
             <h6>
                Torta de chocolate
             </h6>
             <p>
                 Que sugerir no sea un miedo, hazlo con confianza
             </p>
                <img class= "sizephoto"src="/images2/suggestion.png" alt="mapa de dcake">
                <a class = "text"href="../dcakepasteleria/comentarios.php">Quiero hacer una sugerencia</a>
                
        </div>

        <div class = "columna">
             <img class = "sizephoto zoom2"src="images2/torta2.jpg" alt="torta de chocolate">
             <h6>
                Torta de café
             </h6>
             <p>
                Llega a D'cake sin problemas, ponte en plan y ven a visitarnos
             </p>
             <img class= "sizephoto"src="images2/maps.PNG" alt="mapa de dcake">
             <a class = "text "href="https://www.google.com/maps/place/Pasteleria+D'CAKE/@7.8816119,-76.6435956,14z/data=!4m10!1m2!2m1!1scake+pasteleria+apartado!3m6!1s0x8e500dd43ec95391:0xb9ce98772a19f379!8m2!3d7.8769634!4d-76.6091902!15sChhjYWtlIHBhc3RlbGVyaWEgYXBhcnRhZG9aGiIYY2FrZSBwYXN0ZWxlcmlhIGFwYXJ0YWRvkgEJY2FrZV9zaG9w4AEA!16s%2Fg%2F11tcd61t65?entry=ttu" target="_blank">¿Como llegar a D'cake?</a>
        </div>

        <div class = "columna">
             <img class = "sizephoto zoom2"src="images2/torta3.jpg" alt="torta de cafe">
             <h6>
                Torta de chocolate explosión
             </h6>
             <p>
                Sabemos que hay muchas fechas importantes, quieres algo diferente, ¿cierto?
             </p>
             <img class= "sizephoto"src="images2/especial.jpg" alt="mapa de dcake">
             <a class = "text "href="#">Personalizar mi pedido</a>
        </div>

        <div  class = "columna">
             <img class = "sizephoto zoom2"src="images2/torta4.jpg" alt="torta de chocolate">  
             <h6>
                Torta de chocolate fusión
             </h6>
             <p>
                Obten bonos, gana premios y muchas cosas más. Para D'cake son muy importante sus clientes.
             </p>
             <img class= "sizephoto"src="images2/fidelizacion.png" alt="mapa de dcake">
               <a class = "text "href="#">Fidelización</a>
        </div>
        <hr>
    </section>  

    <hr>

    <!-- seccion 2 -->
    <section class = "general_section flex text_center justifyicon">
        <!-- Columna1 -->
        <div>
            <a href="#">
                <img class= "sizeicon zoom"src="images2/tienda.gif" alt="shopdcake">
            </a>
            <h4>
                Sobre nosotros
            </h4>
                <p>
                    Somos un negocio de pasteleria y reposteria casera
                </p>
        </div>
        <!-- Columna2 -->
        <div>
            <a href="#">
               <img class= "sizeicon zoom"src="images2/email2.gif" alt="emaildcake">
            </a>
            <h4>
                Correo
            </h4>
                <p>
                    <a class ="detailemail" href="https://mail.google.com/mail/u/2/#inbox" target="_blank">pasteleriadcake.ap@gmail.com</a>
                </p>
        </div>
        <!-- Columna3 -->
        <div>
            <a href="#">
                <img class= "sizeicon zoom"src="images2/telefono.gif" alt="phonedcake">
            </a>
            <h4>
                Télefono
            </h4>
                 <p>
                   +57 300 893 69 26
                 </p>
        </div>
    </section>

    <hr>

    <!-- sección 3 -->
    <section class= "styles_section3 general_section flex text_center justifytextsection3">
        <!-- Columna1 -->
        <div>
            <h5>
                Otros servicios
            </h5>
                <h5>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                </h5>

        </div>
        <!-- Columna2 -->
        <div>
            <h5>
                Nuestras lineas
            </h5>
                <h5>
                    <p>
                        Lorem 
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
              </h5>

        </div>
        <!-- Columna3 -->
        <div>
            <h5>
                D'cake es una familia
            </h5>
                <h5>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                </h5>
        </div>
        <!-- Columan4 -->
        <div>
            <h5>
                Nuestras sedes
            </h5>
                <h5>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                    <p>
                        Lorem
                    </p>
                </h5>
        </div>
    </section>

    <hr>

    <!-- SECCIÓN 4 -->
    <section class =  "general_section flex justify_icon_s4">
       
         <a  href="#"><img class= "sizeicon-section4"src="images2/facebook.png" alt="facebookdirection"></a>

         <a  href="#"><img class= "sizeicon-section4"src="images2/instagram.png" alt="instagramdirection"></a>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>