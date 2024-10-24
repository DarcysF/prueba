<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro e Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/sesion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container" id="container">
        <!-- Formulario de Registro -->
        <div class="form-container sign-up-container">
            <form action="register.php" method="POST">
                <h1>Crear Cuenta</h1>
                <input id="nombre" type="text" name="name" placeholder="Nombre" required />
                <br>
                <input id="correo" type="email" name="mail" placeholder="Correo electrónico" required />
                <br>
                <input id="correo" type="email" name="mail" placeholder="Correo electrónico" required />
                <br>
                <input id="telefono" type="tel" name="telephone" placeholder="telephone" required />
                <br>
                <input id="contraseña" type="password" name="password" placeholder="Contraseña" required  />
                <button onclick="click()" type="submit">Registrarse</button>
            </form>
        </div>
        <!-- comenatrio -->
        <!-- Formulario de Inicio de Sesión -->
        <div class="form-container sign-in-container">
            <form action="login.php" method="POST">
                <h1>Iniciar Sesión</h1>
                <input type="email" name="mail" placeholder="Correo electrónico" required />
                <br>
                <input type="password" name="password" placeholder="Contraseña" required />
                <button type="submit">Iniciar Sesión</button>
                <a href="recovery.php">¿olvidaste la contraseña?</a>

                <!-- Alerta de error -->
                <?php 
                if (isset($_GET['messages']) && $_GET['messages'] == 'error') {
                ?>
                <div class="alert alert-danger mt-3" role="alert">
                    La contraseña o el correo electrónico son incorrectos.
                </div>
                <?php
                }
                ?>

                <!-- Alerta de otros mensajes -->
                <?php 
                if (isset($_GET['message'])) {
                ?>
                <div class="alert alert-primary" role="alert">
                    <?php 
                    switch ($_GET['message']) {
                    case 'ok':
                        echo 'Por favor, revisa tu correo';
                        break;
                    case 'success_password':
                        echo 'Inicia sesión con tu nueva contraseña';
                        break;
                    default:
                        echo 'Tu correo electronico no esta registrado';
                        break;
                    }
                    ?>
                </div>
                <?php
                }
                ?>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bienvenido de nuevo!</h1>
                    <p>Para mantenerse conectado con nosotros, inicie sesión con su información personal</p>
                    <button class="ghost" id="signIn">Iniciar Sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>¡Hola, Amigo!</h1>
                    <p>Ingrese sus datos personales y comience su viaje con nosotros</p>
                    <button class="ghost" id="signUp">Registrarse</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../js/sesion.js"></script>


    <script>
        function click() {
    let nombre =document.getElementById('nombre').value;
let correo =document.getElementById('correo').value;
let telefono =document.getElementById('telefono').value;
let contraseña =document.getElementById('contraseña').value;
/*funcion para validar */
function validar_parametros() {
    if (nombre==null  || correo==null   || telefono== null    || contraseña==null  ) {

        alert("debes ingresar todos los campos");

    }
    else if(contraseña<8    || contraseña>10){
        alert("la cantidad de caracteres de estar entre 8 y 10 caracteres");
        console.log(contraseña)
        contraseña.value=contraseña;  
        validarContraseña(contraseña);
        limpiar();
    }
 
   


}

}
/*modal */

function validarContraseña(contraseña) {
    const tieneMayuscula = /[A-Z]/.test(contraseña);
    const tieneMinuscula = /[a-z]/.test(contraseña);
    const tieneNumero = /[0-9]/.test(contraseña);
    const tieneCaracterEspecial = /[!@#$%^&*()_+\-=[\]{}|;:,.<>?/`~]/.test(contraseña);

    if (tieneMayuscula && tieneMinuscula && tieneNumero && tieneCaracterEspecial) {
        alert("Contraseña fuerte");
    } else {
        alert("Contraseña débil: Debe incluir al menos una mayúscula, una minúscula, un número y un carácter especial");
    }
}
function limpiar(){

    let nombre =document.getElementById('nombre').value=" ";
    let correo =document.getElementById('correo').value=" ";
    let telefono =document.getElementById('telefono').value=" ";
  let contraseña =document.getElementById('contraseña').value=" ";

}
    </script>
</body>
</html>
