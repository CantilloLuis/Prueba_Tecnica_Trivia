<?php

require __DIR__ . '/../vendor/autoload.php'; // Carga Composer

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__); // Ruta de tu proyecto
$dotenv->load(); // Carga las variables

//acceder a las variables de entorno:
$dbHost = $_ENV['DB_HOST'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];
$dbName = $_ENV['DB_NAME'];
$dbPort = $_ENV['DB_PORT'];

//establecer conexion con la base de datos de MySQL
$conexion = new mysqli($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);

//verificar conexión
if ($conexion->connect_error) {
    echo "Error de conexión: " . $conexion->connect_error;
}
