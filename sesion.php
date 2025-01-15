<?php
//se inicia una nueva sesion o reanuda una existente
session_start();

//se verifica si el formulario ha sido enviado mediante el metodo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //se almacena el nombre del usuario en la sesión, asegurándose de escaparlo para evitar ataques XSS
    $_SESSION['usuario'] = htmlspecialchars($_POST['nombre']);

    //se inicializa la puntuación del usuario en 0 al comenzar el juego
    $_SESSION['puntuacion'] = 0;

    //se redirige al usuario a la página principal del juego
    header('Location: controllers/juego.php');
    exit(); //finalmente se finaliza el script para evitar que se ejecute código adicional
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Aventura - Inicio</title>
    <!-- enlace al archivo de estilos CSS para el diseño de la página -->
    <link rel="stylesheet" href="css/sesion.css">
</head>

<body>
    <div class="container">
        <!-- titulo de bienvenida para el usuario -->
        <h1>¡Bienvenido a Trivia Aventura!</h1>
        <!-- formulario para que el usuario ingrese su nombre -->
        <form method="POST">
            <!-- etiqueta e input para el nombre del usuario -->
            <label for="nombre">Ingresa tu nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" required>
            <!-- boton para enviar el formulario e iniciar el juego -->
            <button type="submit">Iniciar Juego</button>
        </form>
    </div>
</body>

</html>