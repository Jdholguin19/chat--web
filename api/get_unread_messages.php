<?php
require_once '../config.php';
session_start();
header('Content-Type: application/json');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'responsable') {
    echo json_encode(['error' => 'No autenticado']);
    exit;
}

// Conectar a la base de datos
$conn = connectDB();
$responsable_id = $_SESSION['user_id'];

// Obtener los chats asignados al responsable
$stmt = $conn->prepare("SELECT c.id AS chat_id, COUNT(m.id) AS mensajes_no_leidos
                         FROM chats c
                         LEFT JOIN mensajes m ON c.id = m.chat_id AND m.remitente = 'cliente' AND m.leido = 0
                         WHERE c.responsable_id = ? AND c.abierto = 1
                         GROUP BY c.id");
$stmt->bind_param("i", $responsable_id);
$stmt->execute();
$result = $stmt->get_result();
$chats = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

// Devolver los chats con el conteo de mensajes no leídos
echo json_encode(['chats' => $chats]);
?>
