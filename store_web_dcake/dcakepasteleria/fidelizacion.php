<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fidelización</title>
    <!-- Agregar enlaces a Bootstrap CSS y JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Fidelización</h2>
        <form action="procesar_registro.php" method="post">
            <!-- Campos de información personal -->
            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" class="form-control" id="nombres" name="nombres" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="form-group">
                <label for="identificacion">Identificación:</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion" required>
            </div>
            <!-- Campos de contacto -->
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="confirmar_email">Confirmar Correo Electrónico:</label>
                <input type="email" class="form-control" id="confirmar_email" name="confirmar_email" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <!-- Campos de inicio de sesión -->
            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmar_password">Confirmar Contraseña:</label>
                <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" required>
            </div>
            <!-- Botón de Registrarme -->
            <button type="submit" class="btn btn-primary">Registrarme</button>
        </form>
        <!-- Botón de "Ya tengo una cuenta" y Opciones de Registro -->
        <p class="mt-3">¿Ya tienes una cuenta? <a href="/dcakepasteleria/seccionfide.php">Iniciar sesión</a></p>
        <p class="mt-3">O regístrate con:</p>
        <a href="#" class="btn btn-danger">Registrarme con Gmail</a>
        <a href="#" class="btn btn-primary">Registrarme con Hotmail</a>
    </div>

    <!-- Agregar enlaces a Bootstrap JS al final del archivo para un mejor rendimiento -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
