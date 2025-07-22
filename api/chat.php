<?php
require_once '../config.php';
header('Content-Type: application/json');

// Manejar la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    // Validar parámetros básicos
    if (!isset($input['mensaje'])) {
        echo json_encode(['error' => 'Falta el mensaje']);
        exit;
    }

    $conn = connectDB();
    
    try {
        // Determinar el tipo de remitente
        if (isset($input['cliente_id'])) {  // Mensaje desde cliente
            $tipo_remitente = 'cliente';
            $user_id = $input['cliente_id'];
            
            // Registrar acceso del cliente
            registerAccess($conn, $user_id);
            
            // Buscar o crear chat
            $chat_id = getOrCreateChat($conn, $user_id);
            
            // Guardar mensaje del cliente
            saveMessage($conn, $chat_id, 'cliente', $input['mensaje'], 0);
            
            // Generar y guardar respuesta automática del bot
            $respuesta_bot = getBotResponse($input['mensaje'], $conn);
            saveMessage($conn, $chat_id, 'bot', $respuesta_bot, 1);
            
            echo json_encode([
                'success' => true,
                'mensaje_cliente' => $input['mensaje'],
                'respuesta_bot' => $respuesta_bot,
                'chat_id' => $chat_id
            ]);
            
        } elseif (isset($input['responsable_id']) && isset($input['chat_id'])) {  // Mensaje desde responsable
            $tipo_remitente = 'resp';
            $user_id = $input['responsable_id'];
            $chat_id = $input['chat_id'];
            
            // Guardar mensaje del responsable
            saveMessage($conn, $chat_id, 'resp', $input['mensaje'], 0);
            
            echo json_encode([
                'success' => true,
                'mensaje_responsable' => $input['mensaje'],
                'chat_id' => $chat_id
            ]);
            
        } else {
            echo json_encode(['error' => 'Faltan parámetros necesarios']);
        }
        
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    } finally {
        $conn->close();
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}

function getOrCreateChat($conn, $cliente_id) {
    // Buscar chat abierto existente
    $stmt = $conn->prepare("SELECT id FROM chats WHERE cliente_id = ? AND abierto = 1 LIMIT 1");
    $stmt->bind_param("i", $cliente_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['id'];
    }
    
    // Si no existe, crear nuevo chat
    $responsable_id = assignResponsable($conn);
    if ($responsable_id === null) {
        throw new Exception('No hay responsables disponibles');
    }

    $stmt = $conn->prepare("INSERT INTO chats (cliente_id, responsable_id, abierto) VALUES (?, ?, 1)");
    $stmt->bind_param("ii", $cliente_id, $responsable_id);
    $stmt->execute();
    $chat_id = $stmt->insert_id;
    $stmt->close();
    
    // Registrar asignación
    $stmt = $conn->prepare("INSERT INTO asignaciones (cliente_id, responsable_id, fecha) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $cliente_id, $responsable_id);
    $stmt->execute();
    $stmt->close();
    
    return $chat_id;
}

function saveMessage($conn, $chat_id, $remitente, $contenido, $leido) {
    $stmt = $conn->prepare("INSERT INTO mensajes (chat_id, remitente, contenido, fecha, leido) VALUES (?, ?, ?, NOW(), ?)");
    $stmt->bind_param("issi", $chat_id, $remitente, $contenido, $leido);
    if (!$stmt->execute()) {
        throw new Exception("Error al guardar mensaje: " . $conn->error);
    }
    $stmt->close();
}

function assignResponsable($conn) {
    $query = "SELECT r.user_id 
              FROM responsables r
              LEFT JOIN chats c ON r.user_id = c.responsable_id AND c.abierto = 1
              GROUP BY r.user_id
              ORDER BY COUNT(c.id) ASC, RAND()
              LIMIT 1";
    
    $result = $conn->query($query);
    return ($result->num_rows > 0) ? $result->fetch_assoc()['user_id'] : null;
}

function getBotResponse($mensaje, $conn) {
    $stmt = $conn->prepare("SELECT texto, palabras_clave FROM mensajes_pred WHERE tipo = 'bot'");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $keywords = array_map('trim', explode(',', $row['palabras_clave']));
        foreach ($keywords as $keyword) {
            if (stripos($mensaje, $keyword) !== false) {
                return $row['texto'];
            }
        }
    }
    return "Gracias por tu mensaje. Un responsable te atenderá pronto.";
}

function registerAccess($conn, $user_id) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $stmt = $conn->prepare("INSERT INTO accesos (user_id, fecha, ip) VALUES (?, NOW(), ?)");
    $stmt->bind_param("is", $user_id, $ip);
    $stmt->execute();
    $stmt->close();
}
