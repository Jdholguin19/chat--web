<?php
require_once '../config.php';
header('Content-Type: application/json');
session_start();

// Función para registrar errores en un archivo de log
function logError($message) {
    $logFile = __DIR__ . '../logs/error_log.log'; // Ruta del archivo de log
    $timestamp = date("Y-m-d H:i:s");
    file_put_contents($logFile, "[$timestamp] $message" . PHP_EOL, FILE_APPEND);
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    logError('Acceso no autenticado.');
    echo json_encode(['error' => 'No autenticado']);
    exit;
}

// Conectar a la base de datos
$conn = connectDB();

// Obtener el chat_id de la solicitud
$chat_id = isset($_GET['chat_id']) ? intval($_GET['chat_id']) : 0;

// Verificar que el chat_id sea válido
if ($chat_id <= 0) {
    logError('Chat ID no válido: ' . $chat_id);
    echo json_encode(['error' => 'Chat no válido.']);
    exit;
}

try {
    // Obtener los mensajes del chat
    $stmt = $conn->prepare("SELECT contenido, fecha, remitente FROM mensajes WHERE chat_id = ? ORDER BY fecha ASC");
    $stmt->bind_param("i", $chat_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $mensajes = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    
    // Devolver los mensajes en formato JSON
    echo json_encode(['mensajes' => $mensajes]);

} catch (Exception $e) {
    logError('Error al obtener mensajes: ' . $e->getMessage());
    echo json_encode(['error' => 'Error al obtener mensajes.']);
} finally {
    $conn->close();
}
?>
