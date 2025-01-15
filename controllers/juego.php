<?php
//se inicia una nueva sesión o reanuda una sesión existente
session_start();

//se incluye el archivo de conexión a la base de datos
require '../includes/db.php';

//se verifica si el usuario no está establecido en la sesión
//si no está autenticado, redirige al inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: ../sesion.php');
    exit(); // Detiene la ejecución del script
}

//se inicializa la puntuación del usuario si aún no existe en la sesión
if (!isset($_SESSION['puntuacion'])) {
    $_SESSION['puntuacion'] = 0; // Puntuación inicial es 0
}

//se inicializa el arreglo de preguntas ya mostradas si aún no existe en la sesión
if (!isset($_SESSION['preguntas'])) {
    $_SESSION['preguntas'] = []; // No se han contestado preguntas al inicio
}

//variable para controlar si se muestra una nueva pregunta
$mostrarPregunta = true;

//variable para almacenar los datos de la pregunta actual
$preguntaActual = null;

// Si el método de solicitud es POST, procesa la respuesta enviada por el usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //se obtiene el ID de la pregunta enviada

    $preguntaId = intval($_POST['pregunta_id']);
    //se consulta la pregunta en la base de datos
    $sql = "SELECT * FROM preguntas WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $preguntaId);
    $stmt->execute();
    $preguntaActual = $stmt->get_result()->fetch_assoc(); //almacena los datos de la pregunta

    //se obtiene la respuesta seleccionada por el usuario y la respuesta correcta
    $respuesta = intval($_POST['respuesta']);
    $correcta = intval($_POST['correcta']);

    //se verifica si la respuesta es correcta
    if ($respuesta === $correcta) {
        $_SESSION['puntuacion'] += 10; //aumenta la puntuación
        $respuestaCorrecta = htmlspecialchars($preguntaActual['opcion' . $correcta]);
        $_SESSION['mensaje'] = "¡Correcto! la respuesta es: " . $respuestaCorrecta; //mensaje de respuesta correcta
    } else {
        //se obtiene y muestra la respuesta correcta
        $respuestaCorrecta = htmlspecialchars($preguntaActual['opcion' . $correcta]);
        $_SESSION['mensaje'] = "Incorrecto. La respuesta correcta era: " . $respuestaCorrecta;
    }

    // se agrega la pregunta a la lista de preguntas contestadas
    $_SESSION['preguntas'][] = $preguntaId;
    $mostrarPregunta = false; //no se muestra una nueva pregunta inmediatamente

    //se verifica si ya se han contestado 5 preguntas para redirigir a la página de resultados
    if (count($_SESSION['preguntas']) >= 5) {
        header('Location: resultado.php'); //redirige a la página de resultados
        exit();
    }
} else {
    //se obtiene una pregunta aleatoria que no haya sido contestada previamente
    $sql = "SELECT * FROM preguntas WHERE id NOT IN (" . implode(',', array_merge($_SESSION['preguntas'], [0])) . ") ORDER BY RAND() LIMIT 1";
    $result = $conexion->query($sql);
    $preguntaActual = $result->fetch_assoc(); //almacena los datos de la nueva pregunta
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"> <!-- Configura la codificación de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Optimiza para dispositivos móviles -->
    <title>Juego - Trivia Aventura</title> <!-- Título de la página -->
    <link rel="stylesheet" href="../css/juego.css"> <!-- Vincula el archivo CSS externo -->
</head>

<body>
    <div class="container">
        <!-- Muestra un mensaje de bienvenida con el nombre del usuario -->
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>
        <p>Puntuación: <?php echo $_SESSION['puntuacion']; ?></p>

        <!-- Verifica si se debe mostrar un mensaje de respuesta o una nueva pregunta -->
        <?php if (!$mostrarPregunta): ?>
            <!-- Muestra el mensaje de respuesta -->
            <p class="mensaje-respuesta"><?php echo $_SESSION['mensaje']; ?></p>

            <!-- Muestra los detalles de la pregunta contestada -->
            <div class="pregunta-contestada">
                <p><?php echo htmlspecialchars($preguntaActual['preguntas']); ?></p>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="opcion <?php echo ($i == $preguntaActual['correcta'] ? 'correcta' : ($i == $_POST['respuesta'] ? 'seleccionada' : '')); ?>">
                        <?php echo htmlspecialchars($preguntaActual["opcion$i"]); ?>
                    </div>
                <?php endfor; ?>
            </div>

            <!-- Mensaje de redirección a la siguiente pregunta -->
            <p>Redirigiendo a la siguiente pregunta en 15 segundos...</p>
            <?php header("Refresh: 15; url=juego.php"); // Redirige automáticamente después de 15 segundos 
            ?>
        <?php else: ?>
            <!-- Formulario para responder la pregunta actual -->
            <form method="POST">
                <p><?php echo htmlspecialchars($preguntaActual['preguntas']); ?></p>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <label>
                        <input type="radio" name="respuesta" value="<?php echo $i; ?>" required>
                        <?php echo htmlspecialchars($preguntaActual["opcion$i"]); ?>
                    </label><br>
                <?php endfor; ?>
                <input type="hidden" name="correcta" value="<?php echo $preguntaActual['correcta']; ?>"> <!-- Respuesta correcta -->
                <input type="hidden" name="pregunta_id" value="<?php echo $preguntaActual['id']; ?>"> <!-- ID de la pregunta -->
                <button type="submit">Responder</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>