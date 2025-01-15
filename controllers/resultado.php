<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../sesion.php');
    exit();
}

// Incluir el archivo de conexión
require '../includes/db.php';


// Insertar la puntuación del usuario en la base de datos
$stmt = $conexion->prepare("INSERT INTO ranking (usuario, puntuacion) VALUES (?, ?)");
$stmt->bind_param("si", $_SESSION['usuario'], $_SESSION['puntuacion']);
$stmt->execute();
$stmt->close();

// Obtener el ranking ordenado por puntuación
$resultado = $conexion->query("SELECT usuario, puntuacion FROM ranking ORDER BY puntuacion DESC LIMIT 10");

// Mensaje basado en la puntuación
$mensaje = $_SESSION['puntuacion'] > 20
    ? "¡Excelente trabajo, vas por buen camino!"
    : "¡Puedes hacerlo mejor, ánimo que tú puedes!";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - Trivia Aventura</title>
    <link rel="stylesheet" href="../css/resultado.css">
</head>

<body>
    <div class="container">
        <h1>¡Juego Terminado!</h1>
        <p>Gracias por jugar, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>.</p>
        <p>Puntuación final: <strong><?php echo $_SESSION['puntuacion']; ?></strong></p>
        <p class="message"><?php echo $mensaje; ?></p>
        <h2>Ranking</h2>
        <ol>
            <?php while ($fila = $resultado->fetch_assoc()): ?>
                <li><?php echo htmlspecialchars($fila['usuario']) . " - " . $fila['puntuacion']; ?></li>
            <?php endwhile; ?>
        </ol>
        <a href="reiniciar.php">Reiniciar Juego</a>
    </div>
</body>

</html>