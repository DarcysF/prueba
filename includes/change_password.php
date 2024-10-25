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
            // Obtener la conexión a la base de datos desde MyDatabase
            $conexion = $this->db->getPDO();

            // Preparar la consulta con parámetros
            $stmt = $conexion->prepare("UPDATE users SET password_user = :password_user WHERE id_user = :id_user");

            // Vincular los parámetros de manera segura
            $stmt->bindParam(':password_user', $new_password);
            $stmt->bindParam(':id_user', $id, PDO::PARAM_INT);

            // Ejecutar la consulta y verificar si se realizó correctamente
            if ($stmt->execute()) {
                return true; // Indicar que se actualizó correctamente
            } else {
                // Mostrar el error si la ejecución falla
                echo "Error al actualizar la contraseña";
                print_r($stmt->errorInfo());
                return false;
            }
        } catch (PDOException $e) {
            // En caso de error, mostrar el mensaje de error
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}

// Controlador que usa la clase User sin exponer el query

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $id = $_POST['id_user'];
    $new_password = $_POST['new_password'];

    // Verificar si el ID de usuario está presente
    if (empty($id)) {
        echo 'El ID de usuario no está presente.';
        exit();
    }

    // Actualizar la contraseña
    if ($user->updatePassword($id, $new_password)) {
        // Redirigir si todo salió bien
        header("Location: ../public/index.php?message=success_password");
        exit();
    } else {
        // Manejar el error si la actualización falló
        header("Location: ../public/index.php?message=error_password");
        exit();
    }
}
