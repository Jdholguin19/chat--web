<?php
require_once '../config.php';
header('Content-Type: application/json');
session_start();

// Función para registrar errores en un archivo de log
function logError($message) {
    $logFile = '../logs/error_log.log'; // Ruta del archivo de log
    $currentDate = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$currentDate] Error: $message\n", FILE_APPEND);
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
    $conn->close();
    exit;
}

try {
    // Verificar que el usuario tenga acceso al chat
    $user_id = $_SESSION['user_id'];
    // Cambiar user_type por role para que coincida con tus otros archivos
    $user_role = $_SESSION['role'] ?? 'cliente'; // Asumir cliente por defecto
   
   
    // Construir la consulta de verificación según el tipo de usuario
    if ($user_role === 'responsable') {
        // Si es responsable, verificar que esté asignado a este chat
        $verify_stmt = $conn->prepare("SELECT id FROM chats WHERE id = ? AND responsable_id = ?");
        $verify_stmt->bind_param("ii", $chat_id, $user_id);
    } else {
        // Si es cliente, verificar que sea su chat
        $verify_stmt = $conn->prepare("SELECT id FROM chats WHERE id = ? AND cliente_id = ?");
        $verify_stmt->bind_param("ii", $chat_id, $user_id);
    }
   
    $verify_stmt->execute();
    $verify_result = $verify_stmt->get_result();
   
    if ($verify_result->num_rows === 0) {
        logError("Usuario {$user_id} ({$user_role}) sin acceso al chat {$chat_id}");
        echo json_encode(['error' => 'Sin acceso a este chat.']);
        $verify_stmt->close();
        $conn->close();
        exit;
    }
    $verify_stmt->close();
   
    // Obtener los mensajes del chat incluyendo el campo remitente
    $stmt = $conn->prepare("SELECT remitente, contenido, fecha FROM mensajes WHERE chat_id = ? ORDER BY fecha ASC");
    $stmt->bind_param("i", $chat_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    $mensajes = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
   
    // Marcar mensajes como leídos si es necesario
    if ($user_role === 'cliente') {
        // Marcar mensajes del bot y responsable como leídos por el cliente
        $update_stmt = $conn->prepare("UPDATE mensajes SET leido = 1 WHERE chat_id = ? AND remitente IN ('bot', 'resp') AND leido = 0");
        $update_stmt->bind_param("i", $chat_id);
        $update_stmt->execute();
        $update_stmt->close();
    } elseif ($user_role === 'responsable') {
        // Marcar mensajes del cliente como leídos por el responsable
        $update_stmt = $conn->prepare("UPDATE mensajes SET leido = 1 WHERE chat_id = ? AND remitente = 'cliente' AND leido = 0");
        $update_stmt->bind_param("i", $chat_id);
        $update_stmt->execute();
        $update_stmt->close();
    }
   
    // Devolver los mensajes en formato JSON
    echo json_encode([
        'success' => true,
        'mensajes' => $mensajes,
        'chat_id' => $chat_id
    ]);
} catch (Exception $e) {
    logError('Error al obtener mensajes: ' . $e->getMessage());
    echo json_encode(['error' => 'Error al obtener mensajes.']);
} finally {
    // Cerrar conexión solo si está abierta
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>