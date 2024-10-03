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
    let nombre =document.getElementById('nombre').value;
let correo =document.getElementById('correo').value;
let telefono =document.getElementById('telefono').value;
let contraseña =document.getElementById('nombre').value;
/*funcion para validar */
function validar_parametros() {
    if (nombre==""  || correo==""   || telefono== ""    || contraseña==""  ) {
        
        alert("debes ingresar todos los campos");
        
    }
    
}
    
}


