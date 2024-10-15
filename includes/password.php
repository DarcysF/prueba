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
        echo "El script ha empezado correctamente.<br>";
    
        $stmt = $this->db->getPDO()->prepare("SELECT mail_user, id_state_user FROM Users WHERE mail_user = :mail_user AND id_rol_user = 2 AND id_state_user = 2");
        $stmt->bindParam(':mail_user', $mail);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // echo "Usuario encontrado: " . $result['mail_user'] . "<br>";
            // echo "Estado: " . $result['id_state_user'] . "<br>";
    
            // Configuración de PHPMailer
            $mailPHPMailer = new PHPMailer(true); // Crear una instancia de PHPMailer
    
            try {
                echo "Configurando PHPMailer...<br>";
                
                $mailPHPMailer->SMTPDebug = SMTP::DEBUG_SERVER; // Mostrar información de depuración
                $mailPHPMailer->isSMTP();
                $mailPHPMailer->Host       = 'smtp-mail.outlook.com';
                $mailPHPMailer->SMTPAuth   = true;
                $mailPHPMailer->Username   = 'frynetquina@outlook.es';
                $mailPHPMailer->Password   = '1002980092Jp'; // Considera utilizar variables de entorno para esto
                $mailPHPMailer->Port       = 587;
                // $mailPHPMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilitar TLS
                
                echo "Configuración de correo completada...<br>";
    
                // Recipientes
                $mailPHPMailer->setFrom('frynetquina@outlook.es', 'Darcyn Embus Quina');
                $mailPHPMailer->addAddress($result['mail_user'], 'Usuario'); // Usar el correo del usuario encontrado
    
                // Contenido
                $mailPHPMailer->isHTML(true);
                $mailPHPMailer->Subject = 'Recuperación de contraseña';
                $mailPHPMailer->Body    = 'hola, este es un correo genrado para recuperar contraseña <a href="localhost/"';
                $mailPHPMailer->AltBody = 'Este es el cuerpo en texto plano.';
                // $mailPHPMailer->send();
                echo "Enviando correo...<br>";
    
                //Cambia esta línea para llamar a send() en la instancia correcta
                if ($mailPHPMailer->send()) {
                    echo 'El mensaje ha sido enviado.';
                } else {
                    echo 'El mensaje no pudo ser enviado. Error del Mailer: ' . $mailPHPMailer->ErrorInfo;
                }
    
            } catch (Exception $e) {
                echo "Error al enviar el correo. Error del Mailer: {$mailPHPMailer->ErrorInfo}";
            }
    
        } else {
            echo "No se encontró el correo electrónico o el estado no es válido.<br>";
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
