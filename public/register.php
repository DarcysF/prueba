<?php
require_once __DIR__ . '/../includes/User.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST);
    if (!isset($_POST['name']) || !isset($_POST['mail']) || !isset($_POST['telephone']) || !isset($_POST['password'])) {
        echo json_encode(['error' => 'Todos los campos son obligatorios']);
        exit;
    }

    $user = new User();
    $result = $user->register($_POST['name'], $_POST['mail'],$_POST['telephone'], $_POST['password']);
    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Método no permitido']);
}


?>
