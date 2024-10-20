<?php
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
    
            // Configuración de PHPMailer
            $mailPHPMailer = new PHPMailer(true); // Crear una instancia de PHPMailer
    
            try {
                
                $mailPHPMailer->SMTPDebug = SMTP::DEBUG_SERVER; // Mostrar información de depuración
                $mailPHPMailer->isSMTP();
                $mailPHPMailer->Host       = 'smtp.gmail.com';
                $mailPHPMailer->SMTPAuth   = true;
                $mailPHPMailer->Username   = 'darcyfryneth@gmail.com';
                $mailPHPMailer->Password   = 'cczbyqqihdbqlymb'; // Considera utilizar variables de entorno para esto
                $mailPHPMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilitar TLS
                $mailPHPMailer->Port       = 587;                
                // echo "Configuración de correo completada...<br>";
    
                // Recipientes
                $mailPHPMailer->setFrom('darcyfryneth@gmail.com', 'Darcyn Embus Quina');
                $mailPHPMailer->addAddress($result['mail_user'], 'Usuario'); // Usar el correo del usuario encontrado
    
                // Contenido
                $mailPHPMailer->isHTML(true);
                $mailPHPMailer->Subject = 'Restablecercontraseña';
                $mailPHPMailer->Subject = 'Recuperación de contraseña';
                $mailPHPMailer->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña, por favor, visita la página de <a href="localhost/prueba/public/change.php?id_user='.$result['id_user'].'">Recuperación de contraseña</a>';
            
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
