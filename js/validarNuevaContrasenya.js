function validarNuevaContrasenya() {

    let formulario = document.forms["nuevaContrasenya"];
    let nuevaContrasenya = formulario["nuevaContrasenya"].value;
    let errorValidacion = document.getElementById("error_validacion");


    let expresionRegularNuevaContrasenya = /^(?=.*[a-zA-Z0-9])(?=.*[-_.])[a-zA-Z0-9-_.]{8,}$/;

    if(!expresionRegularNuevaContrasenya.test(nuevaContrasenya)) {
        errorValidacion.innerHTML = "La contraseña debe contener caracteres alfanuméricos de mínimo 8 caracteres y un carácter especial -.";
       return false;
    }

}