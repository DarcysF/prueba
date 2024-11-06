<?php
session_start();

class CodeVerification {
    public function verifyCode($codigo) {
        if (isset($_SESSION['codigo_verificacion']) && isset($_SESSION['codigo_expiracion']) && isset($_SESSION['id_user'])) {
            $codigo_guardado = $_SESSION['codigo_verificacion'];
            $expiracion = $_SESSION['codigo_expiracion'];

            if ($codigo == $codigo_guardado && time() < $expiracion) {
                // Código correcto, redirige a change.php sin `id_user` en la URL
                header("Location: ../public/change.php");
                exit();
            } else {
                echo "Código expirado o incorrecto.";
            }
        } else {
            echo "Código no existe.";
        }
    }
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $verificacion = new CodeVerification();
    $verificacion->verifyCode($codigo);
}
?>
