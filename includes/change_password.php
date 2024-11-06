<?php 
require_once __DIR__ . '/MyDatabase.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new MyDatabase();
    }

    public function updatePassword($id, $new_password)
    {
        try {
            $conexion = $this->db->getPDO();
            $stmt = $conexion->prepare("UPDATE users SET password_user = :password_user WHERE id_user = :id_user");

            // Vincular los parámetros
            $stmt->bindParam(':password_user', $new_password);
            $stmt->bindParam(':id_user', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $id = $_POST['id_user'] ?? '';  // Verificar si el ID existe en el POST
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar si el ID de usuario está presente
    if (empty($id)) {
        echo 'Error: El ID de usuario no está presente en la solicitud.';
        exit();
    }

    // Verificar si las contraseñas coinciden
    if ($new_password !== $confirm_password) {
        echo 'Error: Las contraseñas no coinciden.';
        exit();
    }

    // Actualizar la contraseña
    if ($user->updatePassword($id, $new_password)) {
        header("Location: ../public/index.php?message=success_password");
        exit();
    } else {
        header("Location: ../public/index.php?message=error_password");
        exit();
    }
}
?>
