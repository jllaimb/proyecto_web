function validarMiCuenta() {

    let formulario = document.forms["miCuenta"];
    let nombre = formulario["nombre"].value;
    let errorValidacion = document.getElementById("error_validacion3");


    let expresionRegularNombreApellidos = /^[a-zA-Z\s]+$/;

    if(!expresionRegularNombreApellidos.test(nombre)) {
        errorValidacion.innerHTML = "El nombre debe contener caracteres alfabéticos.";
       return false;
    }

    let apellidos = formulario["apellidos"].value;

    if(!expresionRegularNombreApellidos.test(apellidos)) {
        errorValidacion.innerHTML = "El apellido debe contener caracteres alfabéticos.";
       return false;
    }

    let NIF = formulario["NIF"].value;
    let expresionRegularNIF = /^[0-9]{8}[A-Z]$/;

    if(!expresionRegularNIF.test(NIF)) {
        errorValidacion.innerHTML = "El NIF debe contener 8 caracteres númericos y una letra en mayúscula.";
       return false;
    }


    let correo = formulario["correo"].value;
    let expresionRegularCorreo = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if(!expresionRegularCorreo.test(correo.toLowerCase())) {
        errorValidacion.innerHTML = "El correo no tiene el formato correcto.";
       return false;
    }

    let telefono = formulario["telf"].value;
    let expresionRegularTelefono = /^\d{9}$/;


    if(!expresionRegularTelefono.test(telefono)) {
        errorValidacion.innerHTML = "El número de teléfono debe ser númerico y de 9 cifras.";
       return false;
    }


    let codigoPostal = formulario["CP"].value;
    let expresionRegularcodigoPostal = /^\d{5}$/;


    if(!expresionRegularcodigoPostal.test(codigoPostal)) {
        errorValidacion.innerHTML = "El código postal debe ser de caracter númerico y de 5 cifras.";
       return false;
    }


    




    

}