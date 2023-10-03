
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'cake pasteleria</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&family=Sedgwick+Ave+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/Style.css"> 
    <link rel="shortcut icon" href="../images2/icologo.ico">
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
            <a class= "product"href="bizcochos.php"> Bizcochos</a>
            <a class= "product"href="bizcochos+con+relleno.php"> Bizcochos con relleno</a>
            <a class= "product"href="#"> Bizcochos con relleno y cobertura</a>
            <a class= "product"href="#"> Postres</a>
            <a class= "product"href="#"> Cupcakes</a>
            <a class= "product"href="#"> Brownies</a>
    </nav>

    <h2 class = "text_sugerir">
    Que sugerir no sea un miedo, hazlo con confianza.
    </h2>

    <form action="" method ="POST" class ="formulario1">
        <p class = "text_sugerir">HAZ TU COMENTARIO O SUGERENCIA PARA QUE D'CAKE SEA MEJOR</p>
        <?php
            include("../config/conexion_comentario.php");
            include("../config/comentarios_registro.php");
        ?>

        <input class = "control1" type="text" name ="correo_electronico" id ="correo" placeholder = "Tu correo (opcional)" >    
    
        <input class = "control2" type="text" name = "texto" id ="comentario" placeholder = "Haz tu comentario aquí">

        <p class = "text_sugerir"> Envie su comentario cuando este listo </p>

        <input class ="boton" type="submit" name ="envio">

        <p class = text_sugerir> ¿Por qué debo comentar?</p>
    </form>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

    