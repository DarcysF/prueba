<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

require_once __DIR__ . '/MyDatabase.php';

class Password {
    private $db;

    public function __construct() {
        $this->db = new MyDatabase();
    }

    public function recovery($mail) {
        $stmt = $this->db->getPDO()->prepare("SELECT id_user, mail_user FROM Users WHERE mail_user = :mail_user AND id_rol_user = 2 AND id_state_user = 2");
        $stmt->bindParam(':mail_user', $mail);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $codigo_verificacion = mt_rand(100000, 999999); // Código de 6 dígitos
            $_SESSION['codigo_verificacion'] = $codigo_verificacion;
            $_SESSION['codigo_expiracion'] = time() + (5 * 60); // Expiración en 5 minutos
            $_SESSION['id_user'] = $result['id_user']; // Guarda el id_user en sesión

            // Configuración de PHPMailer
            $mailPHPMailer = new PHPMailer(true);

            try {
                $mailPHPMailer->SMTPDebug = SMTP::DEBUG_SERVER; // Mostrar información de depuración
                $mailPHPMailer->isSMTP();
                $mailPHPMailer->Host       = 'smtp.gmail.com';
                $mailPHPMailer->SMTPAuth   = true;
                $mailPHPMailer->Username   = 'darcyfryneth@gmail.com';
                $mailPHPMailer->Password   = 'voweksljafamipml'; // Considera utilizar variables de entorno para esto
                $mailPHPMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailPHPMailer->Port       = 587;

                // Recipientes
                $mailPHPMailer->setFrom('darcyfryneth@gmail.com', 'Darcyn Embus Quina');
                $mailPHPMailer->addAddress($result['mail_user'], 'Usuario');

                // Contenido
                $mailPHPMailer->isHTML(true);
                $mailPHPMailer->Subject = 'Restablecer Password - Biblioteca Virtual';
                $mailPHPMailer->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña. '
                                        . 'Tu código de verificación es: <strong>' . $codigo_verificacion . '</strong>. '
                                        . 'Por favor, visita la página de <a href="localhost/prueba/public/verificacion.php?id_user=' . $result['id_user'] . '">Recuperación de contraseña</a>';
            
                $mailPHPMailer->send();
                header("Location: ../public/index.php?message=ok");

            } catch (Exception $e) {
                header("Location: ../public/index.php?message=error");
            }

        } else {
            header("Location: ../public/index.php?message=not_found");
        }
    }
}

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST['mail']; // Captura el correo electrónico del formulario
    $password = new Password(); // Crea una instancia de la clase
    $password->recovery($mail); // Llama al método de recuperación
}
?>
