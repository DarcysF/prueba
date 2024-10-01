<?php
require_once __DIR__ . '/../includes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificamos si se enviaron los campos de correo y contraseña
    if (empty($_POST['mail']) || empty($_POST['password'])) {
        header('Content-Type: application/json'); // Cabecera para JSON
        echo json_encode(['error' => 'Todos los campos son obligatorios']);
        exit;
    }

    $email = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['password']);

    // Crear instancia del usuario e intentar iniciar sesión
    $user = new User();
    $result = $user->login($email, $password);

    // Verificamos si 'success' existe y si es true
    if (isset($result['success']) && $result['success']) {
        // Redirigir a la página 'home.php' si el inicio de sesión es correcto
        header("Location: home.html");
        exit(); // Asegúrate de detener la ejecución después de redirigir
    } else {
        // Si el inicio de sesión falla, devolver el error en formato JSON
        header('Content-Type: application/json'); // Cabecera para JSON
        echo json_encode($result);
    }
} else {
    // Si no es un método POST, retornamos un error
    header('Content-Type: application/json'); // Cabecera para JSON
    echo json_encode(['error' => 'Método no permitido']);
}

