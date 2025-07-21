<?php
session_start(); // Iniciar la sesión

// Función para simular el envío de un mensaje a WhatsApp
function sendWhatsApp($message) {
    $logFile = 'logs/whatsapp.log';
    $currentDate = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$currentDate] Mensaje enviado: $message\n", FILE_APPEND);
}

// Verificar si se ha enviado un mensaje
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['whatsapp_message'])) {
    sendWhatsApp($_POST['whatsapp_message']);
    echo json_encode(['status' => 'success', 'message' => 'Mensaje enviado a WhatsApp.']);
    exit; // Terminar la ejecución después de enviar el mensaje
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="assets/css/stylewhatsapp.css"> <!-- Incluir archivos CSS -->
    <link rel="stylesheet" href="assets/css/stylebanner.css">
</head>
<body>

    <header class="site-header">
        <div class="logo"><img src="assets/image/costasollogo.jpg" alt="Logo CostaSol"></div>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">CostaSol</a></li>
                <li><a href="login.php">Login</a></li>
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

    <button class="Btn" onclick="toggleWhatsAppChat()">   <!-- Svg de la imagen de whatsapp -->
        <div class="sign">
            <svg class="socialSvg whatsappSvg" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
            </svg>
        </div>
        <div class="text">Whatsapp</div>
    </button>

    <div id="whatsapp-chat">
        <div class="card">
            <div class="chat-header">Chat</div>
            <div class="chat-window">
                <ul class="message-list"></ul>
            </div>
            <div class="chat-input">
                <input type="text" class="message-input" id="whatsapp-message" placeholder="Escribe tu mensaje aquí..." required>
                <button class="send-button" onclick="sendWhatsAppMessage()">Enviar</button>
            </div>
        </div>
    </div>

    <script>
        // Función para mostrar/ocultar el mini chat de WhatsApp
        function toggleWhatsAppChat() {
            const chat = document.getElementById('whatsapp-chat');
            chat.style.display = chat.style.display === 'none' ? 'block' : 'none';
        }

        // Función para enviar el mensaje de WhatsApp
        function sendWhatsAppMessage() {
            const message = document.getElementById('whatsapp-message').value;
            const phoneNumber = '593980404040'; // Número de WhatsApp
            const encodedMessage = encodeURIComponent(message);
            const url = `https://api.whatsapp.com/send/?phone=${phoneNumber}&text=${encodedMessage}&type=phone_number&app_absent=0`;

            // Enviar el mensaje al servidor para guardar en el log
            fetch('index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'whatsapp_message': message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Redirigir a la URL de WhatsApp
                    window.open(url, '_blank');
                    document.getElementById('whatsapp-message').value = ''; // Limpiar el campo de entrada
                    toggleWhatsAppChat(); // Ocultar el chat después de enviar
                } else {
                    alert('Error al enviar el mensaje: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al enviar el mensaje.');
            });
        }
    </script>

</body>
</html>
