<?php
session_start(); // Iniciar la sesión
require_once 'config.php'; 

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['user_id'])) {
    // Redirigir según el rol
    if ($_SESSION['role'] === 'cliente') {
        header("Location: cliente/chat.php");
    } elseif ($_SESSION['role'] === 'responsable') {
        header("Location: responsable/panel.php"); // Cambia esto a la ruta correcta para responsables
    }
    exit;
}

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Conectar a la base de datos
    $conn = connectDB();

    // Verificar las credenciales del usuario
    $stmt = $conn->prepare("SELECT id, pass, role FROM users WHERE email = ?"); // Obtener el rol
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['pass'])) {
            // Iniciar sesión
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role']; // Almacenar el rol en la sesión

            // Registrar el acceso
            registerAccess($conn, $row['id']);

            // Redirigir al panel del usuario según su rol
            if ($row['role'] === 'cliente') {
                header("Location: cliente/chat.php");
            } elseif ($row['role'] === 'responsable') {
                header("Location: responsable/panel.php"); // Cambia esto a la ruta correcta para responsables
            }
            exit;
        } else {
            $error_message = "Contraseña incorrecta.";
        }
    } else {
        $error_message = "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
}

// Función para registrar el acceso del usuario
function registerAccess($conn, $user_id) {
    $stmt = $conn->prepare("INSERT INTO accesos (user_id, fecha, ip) VALUES (?, NOW(), ?)");
    $ip_address = $_SERVER['REMOTE_ADDR']; // Obtener la dirección IP del usuario
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
    <title>Iniciar Sesión - CostaSol</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/stylelogin.css">
</head>
<body>
    <!-- Header -->
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

    <!-- Contenedor principal del login -->
    <div class="login-container">
        <div class="login-wrapper">
            <div class="login-header">
                <h2>Bienvenido</h2>
                <p>Ingresa tus credenciales para continuar</p>
            </div>

            <?php if (isset($error_message)): ?>
                <div class="error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>

                <!-- Contenedor del login verifica que este bien ingresado los datos -->
            <form method="POST" action="" id="loginForm">
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i> Correo Electrónico
                    </label>
                    <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com">
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> Contraseña
                    </label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>

                <button type="submit" class="login-button" id="loginButton">
                    Iniciar Sesión
                </button>
            </form>

            <div class="back-to-home">
                <a href="index.php">
                    <i class="fas fa-arrow-left"></i> Volver al inicio
                </a>
            </div>
        </div>
    </div>

    <script>
        // Agregar efecto de carga al enviar el formulario
        document.getElementById('loginForm').addEventListener('submit', function() {
            const button = document.getElementById('loginButton');
            button.classList.add('loading');
            button.disabled = true;
        });

        // Efecto de focus en los inputs
        const inputs = document.querySelectorAll('.form-group input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>