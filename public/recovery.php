<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro e Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/recovery.css">
</head>
<body>
    <div class="container">
        <div class="form-container recovery">
            <form action="../includes/password.php" method="POST">
                <h1>Ingresa Correo electronico</h1>
                <input type="email" name="mail" placeholder="Correo electrónico" required />
                <button type="submit">Recuperar contraseña</button>
            </form>
        </div>
    </div>

</body>
</html>
