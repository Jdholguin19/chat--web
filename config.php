<?php
// Cargar las variables del archivo .env
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = parse_ini_file(__DIR__ . '/.env');
    foreach ($dotenv as $key => $value) {
        putenv("$key=$value");
    }
}

// Función para conectar a la base de datos
function connectDB() {
    $host = getenv('DB_HOST');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');
    $dbname = getenv('DB_NAME');

    // Crear conexión
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        logError("Connection failed: " . $conn->connect_error);
        die("Error de conexión a la base de datos.");
    }
    return $conn;
}

// Función para registrar errores en el log
function logError($message) {
    $logFile = __DIR__ . '/logs/error.log';
    $timestamp = date("Y-m-d H:i:s");
    file_put_contents($logFile, "[$timestamp] $message" . PHP_EOL, FILE_APPEND);
}
?>
