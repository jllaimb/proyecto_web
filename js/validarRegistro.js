function validarRegistro() {

    let formulario = document.forms["registro"];
    let nombre = formulario["nombre"].value;
    let errorValidacion = document.getElementById("error_validacion2");


    let expresionRegularNombreApellidos = /^[a-zA-Z]+$/;

    if(!expresionRegularNombreApellidos.test(nombre)) {
        errorValidacion.innerHTML = "El nombre debe contener caracteres alfabéticos.";
       return false;
    }

    let apellidos = formulario["apellidos"].value;

    if(!expresionRegularNombreApellidos.test(apellidos)) {
        errorValidacion.innerHTML = "El apellido debe contener caracteres alfabéticos.";
       return false;
    }


    let correo = formulario["correo"].value;
    let expresionRegularCorreo = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if(!expresionRegularCorreo.test(correo.toLowerCase())) {
        errorValidacion.innerHTML = "El correo no tiene el formato correcto.";
       return false;
    }

    let NIF = formulario["NIF"].value;
    let expresionRegularNIF = /^[0-9]{8}[A-Z]$/;

    if(!expresionRegularNIF.test(NIF)) {
        errorValidacion.innerHTML = "El NIF debe contener 8 caracteres númericos y una letra en mayúscula.";
       return false;
    }

    let contrasenya = formulario["contrasenya"].value;
    let expresionRegularContrasenya = /^(?=.*[a-zA-Z0-9])(?=.*[-_.])[a-zA-Z0-9-_.]{8,}$/;
    
    if(!expresionRegularContrasenya.test(contrasenya)) {
        errorValidacion.innerHTML = "La contraseña debe contener caracteres alfanuméricos de mínimo 8 caracteres y un carácter especial -.";
       return false;
    }

}