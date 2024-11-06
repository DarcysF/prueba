<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: index.php?message=error_session");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/password.css">
    <title>Recupera tu contraseña</title>
</head>
<body class="text-center">

    <main class="form-signin w-100 m-auto">
        <?php
        // Comprobar si id_user está en la sesión
        if (!isset($_SESSION['id_user'])) {
            echo '<p class="text-danger">Error: El ID de usuario no está presente en la sesión. Vuelva a intentar desde el enlace de recuperación de contraseña.</p>';
            exit();  // Detener la ejecución si no hay id_user
        }
        $id_user = $_SESSION['id_user'];
        ?>

        <form action="../includes/change_password.php" method="POST">
            <h3>Biblioteca Virtual</h3>
            <h2 class="h3 mb-3 fw-normal">Recupera tu contraseña</h2>
            
            <div class="form-floating my-3">
                <input type="password" class="form-control" id="newPassword" name="new_password" required>
                <label for="newPassword">Nueva contraseña</label>
            </div>

            <div class="form-floating my-3">
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                <label for="confirmPassword">Confirmar nueva contraseña</label>
            </div>

            <!-- Campo oculto para enviar id_user al script de cambio de contraseña -->
            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

            <button class="w-100 btn btn-lg btn-primary" type="submit">Recuperar contraseña</button>
        </form>
    </main>

</body>
</html>
