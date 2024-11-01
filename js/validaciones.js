




function validarFormulario(event) {
    event.preventDefault(); // Evita el envío del formulario

    // Limpiar mensajes de error previos
    const mensajesError = document.getElementById('mensajesError');
    mensajesError.innerHTML = '';

    // Obtener valores del formulario
    const nombre = document.querySelector('input[name="name"]').value;
    const email = document.querySelector('input[name="mail"]').value;
    const telefono = document.querySelector('input[name="telephone"]').value;
    const password = document.querySelector('input[name="password"]').value;
 

 


    let errores = [];


    

    // Validación del nombre
    if (nombre.length < 3) {
        errores.push("El nombre debe tener al menos 3 caracteres.");
    }

    // Validación del correo electrónico
    if (!/\S+@\S+\.\S+/.test(email)) {
        errores.push("El formato del correo electrónico no es válido.");
    }

    // Validación del teléfono
    if (!/^[0-9]{10}$/.test(telefono)) {
        errores.push("El teléfono debe tener exactamente 10 dígitos numéricos.");
    }

    // Validación de la contraseña
    if (password.length < 8 || password.length > 10) {
        errores.push("La contraseña debe tener entre 8 y 10 caracteres.");
    }
    if (!/[A-Z]/.test(password)) {
        errores.push("La contraseña debe incluir al menos una letra mayúscula.");
    }
    if (!/[0-9]/.test(password)) {
        errores.push("La contraseña debe incluir al menos un número.");
    }
    if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        errores.push("La contraseña debe incluir al menos un símbolo especial.");
    }

    // Mostrar errores o enviar el formulario
    if (errores.length > 0) {
        for (const error of errores) {
            mensajesError.innerHTML += `<div class="alert alert-danger">${error}</div>`;
        }
        return false; // No enviar el formulario
    } else {
       // Para pruebas, quita esta línea en producción
        document.getElementById('form').submit(); // Envía el formulario si no hay errores
        return true; // Enviar el formulario
    }
}
