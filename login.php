<?php
session_start();
require_once 'config.php'; // Asegúrate de incluir tu archivo de configuración

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['user_id'])) {
    // Redirigir según el rol
    if ($_SESSION['role'] === 'cliente') {
        header("Location: cliente/chat.php");
    } elseif ($_SESSION['role'] === 'responsable') {
        header("Location: responsable/panel.php");
    }
    exit;
}

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Conectar a la base de datos
    $conn = connectDB();

    // Verificar las credenciales del usuario
    $stmt = $conn->prepare("SELECT id, pass, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['pass'])) {
            // Iniciar sesión
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            // Registrar el acceso
            registerAccess($conn, $row['id']);

            // Redirigir al panel del usuario según su rol
            if ($row['role'] === 'cliente') {
                header("Location: cliente/chat.php");
            } elseif ($row['role'] === 'responsable') {
                header("Location: responsable/panel.php");
            }
            exit;
        } else {
            $error_message = "Contraseña incorrecta.";
            logError("Intento de inicio de sesión fallido para el email: $email");
        }
    } else {
        $error_message = "Usuario no encontrado.";
        logError("Usuario no encontrado: $email");
    }

    $stmt->close();
    $conn->close();
}

// Función para registrar el acceso del usuario
function registerAccess($conn, $user_id) {
    $stmt = $conn->prepare("INSERT INTO accesos (user_id, fecha, ip) VALUES (?, NOW(), ?)");
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $stmt->bind_param("is", $user_id, $ip_address);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Estilos omitidos para brevedad */
    </style>
</head>
<body>

<div id="login-form">
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error_message)): ?>
        <div class="error"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" id="login-button">Iniciar Sesión</button>
    </form>
</div>

</body>
</html>
