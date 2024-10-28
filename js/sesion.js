// Cambiar entre formularios de registro e inicio de sesión
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

/*validaciones js */

    



function click() {
let nombre =document.getElementById('#nombre').value;
let correo =document.getElementById('#correo').value;
let telefono =document.getElementById('#telefono').value;
let contraseña =document.getElementById('#contraseña').value;
/*funcion para validar */
function validar_parametros() {
    if (nombre==null  || correo==null   || telefono== null    || contraseña==null  ) {

        alert("debes ingresar todos los campos");

    }
    else if(contraseña<=8    || contraseña>=10){
        alert("la cantidad de caracteres de estar entre 8 y 10 caracteres");
        console.log(contraseña)
        contraseña.value=contraseña;  
      
        limpiar();
    }
    validarContraseña(contraseña);
 
   


}

}


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

    let nombre =document.getElementById('#nombre').value=" ";
    let correo =document.getElementById('#correo').value=" ";
    let telefono =document.getElementById('#telefono').value=" ";
  let contraseña =document.getElementById('#contraseña').value=" ";

}
