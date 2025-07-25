<?php
// responsable/chat.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config.php';
session_start();

// Verificar si el usuario está autenticado y es un responsable
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'responsable') {
    header("Location: ../login.php");
    exit;
}

// Conectar a la base de datos
$conn = connectDB();

// Obtener el chat_id de la URL
$chat_id = isset($_GET['chat_id']) ? intval($_GET['chat_id']) : 0;

// Verificar que el chat_id sea válido
if ($chat_id <= 0) {
    echo "Chat no válido.";
    exit;
}

// Obtener los mensajes del chat, el cliente_id y el estado del bot
$stmt = $conn->prepare("SELECT m.contenido, m.fecha, m.remitente, c.cliente_id, c.bot_activo FROM mensajes m JOIN chats c ON m.chat_id = c.id WHERE m.chat_id = ? ORDER BY m.fecha ASC");
$stmt->bind_param("i", $chat_id);
$stmt->execute();
$result = $stmt->get_result();
$mensajes = $result->fetch_all(MYSQLI_ASSOC);

// Obtener el cliente_id y estado del bot
$cliente_id = $mensajes[0]['cliente_id'] ?? null;
$bot_activo = $mensajes[0]['bot_activo'] ?? 1; // Por defecto activo

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Responsable - CostaSol</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/stylechatres.css">
    <style>
        .bot-control {
            margin: 10px 0;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .bot-toggle-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .bot-active {
            background-color: #28a745;
            color: white;
        }
        
        .bot-inactive {
            background-color: #dc3545;
            color: white;
        }
        
        .bot-status {
            font-weight: bold;
            margin-left: 10px;
        }
        
        .bot-status.active {
            color: #28a745;
        }
        
        .bot-status.inactive {
            color: #dc3545;
        }
    </style>
</head>
<body>

    <header class="site-header">
        <div class="logo"><img src="../assets/image/costasollogo.jpg" alt="Logo CostaSol"></div>
        <nav class="navbar">
            <ul>
                <li><a href="../index.php">CostaSol</a></li>
                <li><a href="panel.php" class="logout-btn"><i class="fas fa-arrow-left"></i> Volver</a></li>
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

    <div id="chat-container">
        <div class="chat-header">
            <h2>Chat con Cliente</h2>
            <!-- Control del Bot -->
            <div class="bot-control">
                <span>Estado del Bot:</span>
                <span id="bot-status" class="bot-status <?= $bot_activo ? 'active' : 'inactive' ?>">
                    <?= $bot_activo ? 'ACTIVO' : 'INACTIVO' ?>
                </span>
                <button id="toggle-bot" class="bot-toggle-btn <?= $bot_activo ? 'bot-active' : 'bot-inactive' ?>">
                    <i class="fas <?= $bot_activo ? 'fa-robot' : 'fa-user' ?>"></i>
                    <?= $bot_activo ? 'Desactivar Bot' : 'Activar Bot' ?>
                </button>
            </div>
        </div>
        <div id="messages">
        <?php foreach ($mensajes as $mensaje): ?>
            <?php 
                $senderName = '';
                $messageClass = '';
                
                // Determinar el nombre del remitente y la clase CSS
                switch($mensaje['remitente']) {
                    case 'cliente':
                        $senderName = 'Cliente';
                        $messageClass = 'cliente';
                        break;
                    case 'bot':
                        $senderName = 'Bot';
                        $messageClass = 'cliente'; // O puedes crear una clase específica para bot
                        break;
                    case 'resp':
                        $senderName = 'Responsable';
                        $messageClass = 'responsable';
                        break;
                    default:
                        $senderName = 'Sistema';
                        $messageClass = 'cliente';
                }
            ?>
            <div class="message <?= $messageClass ?>">
                <div class="message-sender">
                    <?= htmlspecialchars($senderName) ?>
                </div>
                <div><?= htmlspecialchars($mensaje['contenido']) ?></div>
                <div class="message-time"><?= $mensaje['fecha'] ?></div>
            </div>
        <?php endforeach; ?>
        </div>
        <div id="message-input">
            <input type="text" id="message" placeholder="Escribe tu mensaje..." required>
            <button id="send-button">
                <i class="fas fa-paper-plane"></i> 
                Enviar
            </button>
        </div>
    </div>

    <script>
        let botActivo = <?= json_encode($bot_activo) ?>;

        // Función para alternar el estado del bot
        function toggleBot() {
            fetch('http://localhost/chat-web/api/toggle_bot.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    chat_id: <?= json_encode($chat_id) ?>,
                    responsable_id: <?= json_encode($_SESSION['user_id']) ?>
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    botActivo = data.bot_activo;
                    updateBotUI();
                } else {
                    alert('Error al cambiar el estado del bot: ' + (data.error || 'Error desconocido'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al cambiar el estado del bot.');
            });
        }

        // Función para actualizar la UI del bot
        function updateBotUI() {
            const toggleBtn = document.getElementById('toggle-bot');
            const statusSpan = document.getElementById('bot-status');
            
            if (botActivo) {
                toggleBtn.className = 'bot-toggle-btn bot-active';
                toggleBtn.innerHTML = '<i class="fas fa-robot"></i> Desactivar Bot';
                statusSpan.textContent = 'ACTIVO';
                statusSpan.className = 'bot-status active';
            } else {
                toggleBtn.className = 'bot-toggle-btn bot-inactive';
                toggleBtn.innerHTML = '<i class="fas fa-user"></i> Activar Bot';
                statusSpan.textContent = 'INACTIVO';
                statusSpan.className = 'bot-status inactive';
            }
        }

        // Event listener para el botón de toggle del bot
        document.getElementById('toggle-bot').addEventListener('click', toggleBot);

        // Función para cargar mensajes
        function loadMessages() {
            fetch('http://localhost/chat-web/api/get_messages.php?chat_id=<?= json_encode($chat_id) ?>')
                .then(response => response.json())
                .then(data => {
                    const messagesContainer = document.getElementById('messages');
                    messagesContainer.innerHTML = ''; // Limpiar mensajes anteriores
                    data.mensajes.forEach(mensaje => {
                        let senderName = '';
                        let messageClass = '';
                        
                        // Determinar el nombre del remitente y la clase CSS
                        switch(mensaje.remitente) {
                            case 'cliente':
                                senderName = 'Cliente';
                                messageClass = 'cliente';
                                break;
                            case 'bot':
                                senderName = 'Bot';
                                messageClass = 'cliente'; // O puedes crear una clase específica para bot
                                break;
                            case 'resp':
                                senderName = 'Responsable';
                                messageClass = 'responsable';
                                break;
                            default:
                                senderName = 'Sistema';
                                messageClass = 'cliente';
                        }
                        
                        messagesContainer.innerHTML += `
                            <div class="message ${messageClass}">
                                <div class="message-sender">${senderName}</div>
                                <div>${mensaje.contenido}</div>
                                <div class="message-time">${mensaje.fecha}</div>
                            </div>`;
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
                    responsable_id: <?= json_encode($_SESSION['user_id']) ?>, // ID del responsable
                    chat_id: <?= json_encode($chat_id) ?> // ID del chat
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Error: ' + data.error);
                } else {
                    // Limpiar el campo de entrada
                    messageInput.value = '';
                    // Cargar mensajes actualizados
                    loadMessages();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al enviar el mensaje.');
            });
        }

        // Event listeners
        document.getElementById('send-button').addEventListener('click', sendMessage);

        document.getElementById('message').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Auto scroll al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const messagesDiv = document.getElementById('messages');
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
    </script>

</body>
</html>