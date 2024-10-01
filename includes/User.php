<?php
require_once __DIR__ . '/MyDatabase.php';

class User {
    private $db;
    public function __construct() {
        $this->db = new MyDatabase();
    }

    // Registro de usuario
    public function register($name, $email, $telephone, $password, $rol = 2, $state = 2) {
        try {
            // Validación básica
            if (empty($name) || empty($email) || empty($telephone) || empty($password)) {
                return ['error' => 'Todos los campos son obligatorios'
                ];
            }

            // Insertar el usuario en la base de datos
            $stmt = $this->db->getPDO()->prepare("
                INSERT INTO users (name_user, mail_user, telephone_user, password_user, id_rol_user, id_state_user) 
                VALUES (:name_user, :mail_user, :telephone_user, :password_user, :id_rol_user, :id_state_user)
            ");
            $stmt->execute([
                ':name_user' => $name,
                ':mail_user' => $email,
                ':telephone_user' => $telephone,
                ':password_user' => $password,
                ':id_rol_user' => $rol,
                ':id_state_user' => $state
            ]);

            return ['message' => 'Usuario registrado exitosamente'];

        } catch (PDOException $e) {
            error_log('Error en el registro de usuario: ' . $e->getMessage());
            if ($e->getCode() == 23000) {
                return ['error' => 'El correo o teléfono ya está en uso'];
            } else {
                return ['error' => 'Error al registrar el usuario: ' . $e->getMessage()];
            }
        }
    }    

    // Inicio de sesión de usuario
    public function login($email, $password) {
        try {
            // Validación básica
            if (empty($email) || empty($password)) {
                return [
                    'success' => false, // Aseguramos que siempre retornamos 'success'
                    'error' => 'El correo y la contraseña son obligatorios'
                ];
            }
    
            // Buscar al usuario por su correo
            $stmt = $this->db->getPDO()->prepare("SELECT * FROM Users WHERE mail_user = :mail_user");
            $stmt->execute([':mail_user' => $email]);
    
            // Verificar si se encontró un usuario
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
                // Registrar la contraseña ingresada y la almacenada para depuración (temporal)
                error_log("Contraseña ingresada: " . $password);
                error_log("Contraseña almacenada: " . $user['password_user']);
    
                // Comparar las contraseñas en texto plano
                if ($password === $user['password_user']) {
                    return [
                        'success' => true, // Retornamos true si el login es exitoso
                        'message' => 'Usuario logueado exitosamente'
                    ];
                } else {
                    return [
                        'success' => false, // Retornamos false si la contraseña es incorrecta
                        'error' => 'Contraseña incorrecta'
                    ];
                }
            } else {
                return [
                    'success' => false, // Retornamos false si no se encuentra el usuario
                    'error' => 'Usuario no encontrado o credenciales incorrectas'
                ];
            }
    
        } catch (PDOException $e) {
            error_log('Error en el login de usuario: ' . $e->getMessage());
            return [
                'success' => false, // Retornamos false si ocurre un error
                'error' => 'Error al iniciar sesión: ' . $e->getMessage()
            ];
        }
    }
    
    
}
?>