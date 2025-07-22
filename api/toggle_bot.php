<?php
// api/toggle_bot.php
require_once '../config.php';
header('Content-Type: application/json');
session_start();

// Función para registrar errores
function logError($message) {
    $logFile = '../logs/error_log.log';
    $currentDate = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$currentDate] Error: $message\n", FILE_APPEND);
}

// Verificar que sea una solicitud POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Verificar autenticación
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'responsable') {
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

// Validar parámetros
if (!isset($input['chat_id']) || !isset($input['responsable_id'])) {
    echo json_encode(['error' => 'Faltan parámetros necesarios']);
    exit;
}

$chat_id = intval($input['chat_id']);
$responsable_id = intval($input['responsable_id']);

// Verificar que el responsable tenga acceso a este chat
if ($responsable_id !== $_SESSION['user_id']) {
    echo json_encode(['error' => 'No tienes permisos para este chat']);
    exit;
}

$conn = connectDB();

try {
    // Verificar que el responsable esté asignado a este chat
    $verify_stmt = $conn->prepare("SELECT id, bot_activo FROM chats WHERE id = ? AND responsable_id = ?");
    $verify_stmt->bind_param("ii", $chat_id, $responsable_id);
    $verify_stmt->execute();
    $result = $verify_stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['error' => 'Chat no encontrado o sin permisos']);
        $verify_stmt->close();
        $conn->close();
        exit;
    }
    
    $chat = $result->fetch_assoc();
    $nuevo_estado = $chat['bot_activo'] ? 0 : 1; // Alternar estado
    $verify_stmt->close();
    
    // Actualizar el estado del bot en la base de datos
    $update_stmt = $conn->prepare("UPDATE chats SET bot_activo = ? WHERE id = ?");
    $update_stmt->bind_param("ii", $nuevo_estado, $chat_id);
    
    if ($update_stmt->execute()) {
        // Registrar el cambio en los logs (opcional)
        $estado_texto = $nuevo_estado ? 'activado' : 'desactivado';
        logError("Bot $estado_texto para el chat $chat_id por el responsable $responsable_id");
        
        echo json_encode([
            'success' => true,
            'bot_activo' => $nuevo_estado,
            'mensaje' => "Bot " . ($nuevo_estado ? 'activado' : 'desactivado') . " correctamente"
        ]);
    } else {
        echo json_encode(['error' => 'Error al actualizar el estado del bot']);
    }
    
    $update_stmt->close();
    
} catch (Exception $e) {
    logError('Error en toggle_bot.php: ' . $e->getMessage());
    echo json_encode(['error' => 'Error interno del servidor']);
} finally {
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>