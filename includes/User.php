<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
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
                    echo ('
                        <head>
                            <title>Error al registrarse</title>
                        </head>
                        <div id="responseMessage" class="respuesta">
                            <p style="color: red;">Todos los campos son obligatorios, redirigiendo al inicio</p>
                            <div class="img">
                                <img src="../img/sin-datos.gif" alt="icono de error">
                            </div>
                        </div>
                        <script>
                            setTimeout(function() {
                                window.location.href = "../public/index.php";
                            }, 4000);
                        </script>
                    ');
                    return;
                }

                // Validación de existencia de campos
                if ($this->validacion_campos_existentes($email)) {
                    echo ('
                        <head>
                            <title>El usuario ya existe</title>
                        </head>
                        <div id="responseMessage" class="respuesta">
                            <p style="color: red;">El correo ingresado ya existe, si tienes una cuenta creada te redirigiremos para que puedas recuperar tu contraseña, de lo contrario intenta con otro correo</p>
                          
                            <div class="img">
                                <img src="../img/no.gif" alt="icono de negacion">
                            </div>
                        </div>
                        <script>
                            setTimeout(function() {
                                window.location.href = "../public/index.php";
                            }, 7000);
                        </script>
                    ');
                    return;
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
                echo ('
                    <head>
                        <title>Bienvenido</title>
                        <link rel="shortcut icon" href="../img/icono__bienvenida.png" type="image/x-icon">
                    </head>
                    <div id="responseMessage" class="respuesta">
                        <p style="color: red;">Bienvenido a nuestra biblioteca virtual</p>
                        <div class="img">
                            <img src="../img/exito.gif" alt="icono de éxito">
                        </div>
                    </div>
                    <script>
                        setTimeout(function() {
                            window.location.href = "../public/home.php";
                        }, 5000);
                    </script>
                ');

            } catch (PDOException $e) {
                error_log('Error en el registro de usuario: ' . $e->getMessage());
                if ($e->getCode() == 23000) {
                    echo '<h1>El correo o teléfono ya está en uso</h1>';
                } else {
                    echo '<h1>Error al registrar el usuario: ' . $e->getMessage() . '</h1>';
                }
            }
        }

        // Método para validar si el correo o teléfono ya existen
        private function validacion_campos_existentes($email) {
            $consulta = "SELECT * FROM users WHERE mail_user = :mail_user ";
            $stmt = $this->db->getPDO()->prepare($consulta);
            $stmt->execute([
                ':mail_user' => $email
                
            ]);

            return $stmt->rowCount() > 0; // Retorna true si existe un registro, false si no


            
        }

        // Inicio de sesión de usuario
        public function login($email, $password) {
            try {
                // Validación básica
                if (empty($email) || empty($password)) {
                    return [
                        'success' => false,
                        'error' => 'El correo y la contraseña son obligatorios'
                    ];
                }

                // Buscar al usuario por su correo
                $stmt = $this->db->getPDO()->prepare("SELECT * FROM users WHERE mail_user = :mail_user");
                $stmt->execute([':mail_user' => $email]);

                // Verificar si se encontró un usuario
                if ($stmt->rowCount() > 0) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Comparar las contraseñas en texto plano
                    if ($password === $user['password_user']) {
                        return [
                            'success' => true,
                            'message' => 'Usuario logueado exitosamente'
                        ];
                    } else {
                        return [
                            'success' => false,
                            'error' => 'Contraseña incorrecta'
                        ];
                    }
                } else {
                    return [
                        'success' => false,
                        'error' => 'Usuario no encontrado o credenciales incorrectas'
                    ];
                }
            } catch (PDOException $e) {
                error_log('Error en el login de usuario: ' . $e->getMessage());
                return [
                    'success' => false,
                    'error' => 'Error al iniciar sesión: ' . $e->getMessage()
                ];
            }
        }
    }
    ?>
</body>
</html>
