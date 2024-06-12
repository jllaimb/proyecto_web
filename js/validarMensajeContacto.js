function validarMensajeContacto() {

    let formulario = document.forms["mensajeContacto"];
    let nombre = formulario["nombre"].value;
    let errorValidacion = document.getElementById("error_validacion2");


    let expresionRegularNombreApellidos = /^[a-zA-Z\s]+$/;

    if(!expresionRegularNombreApellidos.test(nombre)) {
        errorValidacion.innerHTML = "El nombre debe contener caracteres alfabéticos.";
       return false;
    }

    let correo = formulario["correo"].value;
    let expresionRegularCorreo = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if(!expresionRegularCorreo.test(correo.toLowerCase())) {
        errorValidacion.innerHTML = "El correo no tiene el formato correcto.";
       return false;
    }

   

}