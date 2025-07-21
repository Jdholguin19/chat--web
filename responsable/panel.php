<?php
require_once '../config.php';
session_start(); // Asegúrate de iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'responsable') {
    header("Location: ../login.php"); // Redirigir si no está autenticado
    exit;
}

// Conectar a la base de datos
$conn = connectDB();

// Obtener el ID del responsable desde la sesión
$responsable_id = $_SESSION['user_id']; // Obtener el ID del responsable desde la sesión

// Obtener los chats asignados al responsable
$stmt = $conn->prepare("SELECT c.id AS chat_id, u.nombre AS cliente_nombre, COUNT(m.id) AS mensajes_no_leidos
                         FROM chats c
                         JOIN users u ON c.cliente_id = u.id
                         LEFT JOIN mensajes m ON c.id = m.chat_id AND m.remitente = 'cliente' AND m.leido = 0
                         WHERE c.responsable_id = ? AND c.abierto = 1
                         GROUP BY c.id");
$stmt->bind_param("i", $responsable_id);
$stmt->execute();
$result = $stmt->get_result();
$chats = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <a href="../logout.php">Cerrar Sesión</a>
    <title>Panel del Responsable</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        #chat-panel {
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        .chat-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .chat-item:last-child {
            border-bottom: none;
        }
        .chat-link {
            text-decoration: none;
            color: #007bff;
        }
        .chat-link:hover {
            text-decoration: underline;
        }
        .unread-count {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div id="chat-panel">
    <h2>Chats Asignados</h2>
    <?php if (count($chats) > 0): ?>
        <?php foreach ($chats as $chat): ?>
            <div class="chat-item">
                <a class="chat-link" href="chat.php?chat_id=<?= $chat['chat_id'] ?>">
                    <?= htmlspecialchars($chat['cliente_nombre']) ?> 
                    <span class="unread-count">(<?= $chat['mensajes_no_leidos'] ?> no leídos)</span>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tienes chats asignados actualmente.</p>
    <?php endif; ?>
</div>

</body>
</html>
