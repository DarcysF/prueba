<?php
require_once __DIR__ . '/../includes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificamos si se enviaron los campos de correo y contraseña
    if (empty($_POST['mail']) || empty($_POST['password'])) {
        header('Location: index.php?message=error'); // Redirigir a la página con mensaje de error
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
        header("Location: home.php");
        exit(); // Asegúrate de detener la ejecución después de redirigir
    } else {
        // Si el inicio de sesión falla, redirigir con mensaje de error
        header('Location: index.php?messages=error'); // Cambia a la página correcta
        exit();
    }
} else {
    // Si no es un método POST, retornamos un error
    header('Location: index.php?messages=error'); // Cambia a la página correcta
    exit();
}
