<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Código</title>
    <link rel="stylesheet" href="../css/verificacion.css"> <!-- Enlaza tu archivo CSS -->
</head>
<body>
    <div class="container">
        <h2>Verificación de Código</h2>
        <form action="../includes/procesar_codigo.php" method="POST">
            <div class="form-group">
                <label for="codigo">Código de Verificación</label>
                <input type="text" id="codigo" name="codigo" required>
            </div>
            <button type="submit">Verificar</button>
        </form>
    </div>
</body>
</html>
