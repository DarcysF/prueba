// Cambiar entre formularios de registro e inicio de sesión
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');



signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
})







/******************************************** */
const nombre = document.querySelector('#nombre').value;
const correo = documesnt.querySelector('#correo').value;
const telefono = document.querySelector('#telefono').value;
const contraseña = document.querySelector('#contraseña').value;
const submitBtn = document.querySelector('#submitBtn');
const formulario=document.querySelector('form');
formulario.addEventListener("submit", evento=>{

   if(nombre.value.length<10){
       evento.preventDefault();
       alert('nombre muy corto ')

   }


});

function validar_campos() {
   
    // Validación de campos vacíos
    if (nombre == null || correo== null || telefono== null  || contraseña== null ) {
        alert("Debes ingresar todos los campos");
        limpiar();
        submitBtn.disabled = true;  // Deshabilitar botón
        return false;
    }
    else{
        submitBtn.enable = true;  // habilitamos el  botón

    }
    
   /* // Validar fuerza de la contraseña
    const esContrasenaFuerte = validarContraseña(contraseña);
    
    if (!esContrasenaFuerte) {
        submitBtn.disabled = true;  // Deshabilitar botón
        return false;
    }
    
    submitBtn.disabled = false;  // Habilitar botón si todo es válido
    return true;*/
}

// Función de validación que se ejecuta al enviar el formulario
/*function validar_parametros() {
    return validar_campos();
}
*/
// Evento de click que llama a la función de validación
function click() {
    console.log("hola mundfo")
    validar_parametros();
    console.log("Validación realizada");

}

// Validación de la fuerza de la contraseña
/*function expresiones(contraseña) {
    const tieneMayuscula = /[A-Z]/.test(contraseña);
    const tieneMinuscula = /[a-z]/.test(contraseña);
    const tieneNumero = /[0-9]/.test(contraseña);
    const tieneCaracterEspecial = /[!@#$%^&*()_+\-=[\]{}|;:,.<>?/`~]/.test(contraseña);

    if (tieneMayuscula && tieneMinuscula && tieneNumero && tieneCaracterEspecial) {
        alert("Contraseña fuerte");
        return true;
    } else {
        alert("Contraseña débil: Debe incluir al menos una mayúscula, una minúscula, un número y un carácter especial");
        return false;
    }
}*/

// Función para limpiar los campos
function limpiar() {
    document.getElementById('nombre').value = "";
    document.getElementById('correo').value = "";
    document.getElementById('telefono').value = "";
    document.getElementById('contraseña').value = "";
    document.getElementById('submitBtn').disabled = true;  // Deshabilitar el botón después de limpiar
}