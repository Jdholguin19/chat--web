<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once '../config.php';
session_start(); // Asegúrate de iniciar la sesión

// Conectar a la base de datos
$conn = connectDB();

// Obtener el ID del cliente desde la sesión
$cliente_id = $_SESSION['user_id'];

// Verificar si el cliente ya tiene un chat abierto
$stmt = $conn->prepare("SELECT id FROM chats WHERE cliente_id = ? AND abierto = 1");
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si hay un chat abierto, obtener el chat_id
    $row = $result->fetch_assoc();
    $chat_id = $row['id'];
} else {
    // Si no hay chat abierto, asignar un responsable y crear un nuevo chat
    $responsable_id = assignResponsable($conn);
    if ($responsable_id === null) {
        echo "No hay responsables disponibles.";
        exit;
    }

    // Crear un nuevo registro en la tabla chats
    $stmt = $conn->prepare("INSERT INTO chats (cliente_id, responsable_id, abierto) VALUES (?, ?, 1)");
    $stmt->bind_param("ii", $cliente_id, $responsable_id);
    $stmt->execute();
    $chat_id = $stmt->insert_id; // Obtener el ID del nuevo chat
    $stmt->close();

    // Crear un registro en la tabla asignaciones
    $stmt = $conn->prepare("INSERT INTO asignaciones (cliente_id, responsable_id, fecha) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $cliente_id, $responsable_id);
    $stmt->execute();
    $stmt->close();
}

// Obtener mensajes anteriores del chat
$stmt = $conn->prepare("SELECT contenido, fecha FROM mensajes WHERE chat_id = ? ORDER BY fecha ASC");
$stmt->bind_param("i", $chat_id);
$stmt->execute();
$result = $stmt->get_result();
$mensajes = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

// Función para asignar un responsable con menos chats activos
function assignResponsable($conn) {
    // Seleccionar al responsable con menos chats activos
    $stmt = $conn->prepare("SELECT r.user_id FROM responsables r
                             LEFT JOIN chats c ON r.user_id = c.responsable_id AND c.abierto = 1
                             GROUP BY r.user_id
                             ORDER BY COUNT(c.id) ASC
                             LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['user_id']; // Devolver el ID del responsable
    }

    return null; // No hay responsables disponibles
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Cliente - CostaSol</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/stylechatcli.css">
</head>
<body>
    <header class="site-header">
        <div class="logo"><img src="../assets/image/costasollogo.jpg" alt="Logo CostaSol"></div>
        <nav class="navbar">
            <ul>
                <li><a href="../index.php">CostaSol</a></li>
                <li><a href="chat.php">Chat</a></li>
            </ul>
        </nav>
        <div class="social-icons">
            <!-- Svg de facebook -->
            <a href="https://es-es.facebook.com/costasolec/" target="_blank">
                <svg class="socialSvg" viewBox="-0.002 0 176.015 176" fill="#646464ff" width="30" height="30">
                    <path d="M171.63 40.85C167.68 25 151 8.31 135.15 4.36A262 262 0 0 0 88 0a262 262 0 0 0-47.15 4.36C25 8.31 8.32 25 4.37 40.85a256.4 256.4 0 0 0 0 94.3C8.32 151 25 167.7 40.85 171.64A262 262 0 0 0 88 176q6.72 0 13.4-.35a268.5 268.5 0 0 0 33.75-4c15.89-3.94 32.53-20.6 36.48-36.49A262.4 262.4 0 0 0 176 86.49a262 262 0 0 0-4.37-45.64m-55.75 36.74-1.77 15.32a2.86 2.86 0 0 1-2.82 2.57h-16l-.08 45.45a2.05 2.05 0 0 1-2 2.07H77a2 2 0 0 1-2-2.08V95.48H63a2.87 2.87 0 0 1-2.84-2.9l-.06-15.33a2.88 2.88 0 0 1 2.84-2.92H75v-14.8C75 42.35 85.2 33 100.16 33h12.26a2.88 2.88 0 0 1 2.85 2.92v12.91a2.88 2.88 0 0 1-2.85 2.92h-7.52c-8.13 0-9.71 4-9.71 9.77v12.81h17.87a2.89 2.89 0 0 1 2.82 3.26"></path>
                </svg>
            </a>

            <!-- Svg de linkedin -->
            <a href="https://www.linkedin.com/company/constructorathaliavictoria" target="_blank">
                <svg class="socialSvg" viewBox="-0.003 0 176.004 176" fill="#646464ff" width="30" height="30">
                    <path d="M171.63 40.84C167.68 25 151 8.31 135.15 4.36A262 262 0 0 0 88 0a262 262 0 0 0-47.15 4.36C25 8.31 8.32 25 4.37 40.84a256.5 256.5 0 0 0 0 94.31C8.32 151 25 167.7 40.85 171.63c8.89 1.61 17.54 2.77 26.11 3.48 1.86.16 3.71.29 5.56.41 5.17.32 10.32.48 15.48.48 4.48 0 8.94-.13 13.4-.36a268.5 268.5 0 0 0 33.75-4c15.85-3.94 32.53-20.64 36.48-36.49 1.28-7.05 2.27-14 3-20.87q.84-8.09 1.17-16.09.24-5.86.21-11.71a262 262 0 0 0-4.38-45.64M61 139.28a3.71 3.71 0 0 1-3.71 3.72H41.48a3.7 3.7 0 0 1-3.71-3.72V73a3.71 3.71 0 0 1 3.71-3.72h15.81A3.72 3.72 0 0 1 61 73ZM49.39 63a15 15 0 1 1 15-15 15 15 0 0 1-15 15m94.25 76.54a3.41 3.41 0 0 1-3.42 3.42h-17a3.41 3.41 0 0 1-3.42-3.42v-31.05c0-4.64 1.36-20.32-12.13-20.32-10.45 0-12.58 10.73-13 15.55v35.86A3.42 3.42 0 0 1 91.3 143H74.88a3.41 3.41 0 0 1-3.41-3.42V72.71a3.41 3.41 0 0 1 3.41-3.42H91.3a3.42 3.42 0 0 1 3.42 3.42v5.78c3.88-5.83 9.63-10.31 21.9-10.31 27.17 0 27 25.38 27 39.32Z"></path>                
                </svg>
            </a>
        </div>
    </header>

    <div class="main-content">
        <div id="chat-container">
            <div class="chat-header">
                <h2>Chat con Soporte</h2>
                <a href="../logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
            
            <div id="messages">
                <?php foreach ($mensajes as $mensaje): ?>
                    <div class="message">
                        <strong>Cliente:</strong> <?= htmlspecialchars($mensaje['contenido']) ?> 
                        <em>(<?= $mensaje['fecha'] ?>)</em>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div id="message-input">
                <input type="text" id="message" placeholder="Escribe tu mensaje..." required>
                <button id="send-button">
                    <i class="fas fa-paper-plane"></i> Enviar
                </button>
            </div>
        </div>
    </div>

<script>
    // Función para cargar mensajes
    function loadMessages() {
        fetch('http://localhost/chat-web/api/get_messages.php?chat_id=<?= json_encode($chat_id) ?>')
            .then(response => response.json())
            .then(data => {
                const messagesContainer = document.getElementById('messages');
                messagesContainer.innerHTML = ''; // Limpiar mensajes anteriores
                data.mensajes.forEach(mensaje => {
                    messagesContainer.innerHTML += `<div class="message"><strong>Cliente:</strong> ${mensaje.contenido} <em>(${mensaje.fecha})</em></div>`;
                });
                messagesContainer.scrollTop = messagesContainer.scrollHeight; // Desplazar hacia abajo
            })
            .catch(error => console.error('Error al cargar mensajes:', error));
    }

    // Llamar a loadMessages cada 2 segundos
    setInterval(loadMessages, 2000);

    // Función para enviar mensaje
    function sendMessage() {
        const messageInput = document.getElementById('message');
        const message = messageInput.value;

        if (message.trim() === '') {
            alert('Por favor, escribe un mensaje.');
            return;
        }

        // Enviar el mensaje al servidor
        fetch('http://localhost/chat-web/api/chat.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                mensaje: message,
                cliente_id: <?= json_encode($_SESSION['user_id']) ?> // Enviar el ID del cliente
            })
        })
        .then(response => response.json())
        .then(data => {
            // Mostrar el mensaje enviado en el feed
            const messagesDiv = document.getElementById('messages');
            messagesDiv.innerHTML += `<div class="message"><strong>Cliente:</strong> ${message} <em>(Ahora)</em></div>`;
            messagesDiv.innerHTML += `<div class="message"><strong>Bot:</strong> ${data.respuesta_bot} <em>(Ahora)</em></div>`;
            messagesDiv.scrollTop = messagesDiv.scrollHeight; // Desplazar hacia abajo
            messageInput.value = ''; // Limpiar el campo de entrada
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un problema al enviar el mensaje.');
        });
    }

    // Event listeners
    document.getElementById('send-button').addEventListener('click', sendMessage);

    // Permitir enviar mensaje con Enter
    document.getElementById('message').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
</script>

</body>
</html>