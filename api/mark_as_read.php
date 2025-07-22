<?php
require_once '../config.php';
session_start();
header('Content-Type: application/json');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'No autenticado']);
    exit;
}

// Conectar a la base de datos
$conn = connectDB();

// Obtener el chat_id de la solicitud
$chat_id = isset($_GET['chat_id']) ? intval($_GET['chat_id']) : 0;

// Verificar que el chat_id sea válido
if ($chat_id <= 0) {
    echo json_encode(['error' => 'Chat no válido.']);
    exit;
}

// Marcar los mensajes como leídos
$stmt = $conn->prepare("UPDATE mensajes SET leido = 1 WHERE chat_id = ? AND remitente = 'cliente' AND leido = 0");
$stmt->bind_param("i", $chat_id);
$stmt->execute();
$stmt->close();
$conn->close();

// Devolver éxito
echo json_encode(['success' => true]);
?>
