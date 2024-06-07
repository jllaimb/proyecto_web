function validarLogin() {

    let formulario = document.forms["logueo"];
    let correo = formulario["email"].value;
    let errorValidacion = document.getElementById("error_validacion");


    let expresionRegularCorreo = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!expresionRegularCorreo.test(correo.toLowerCase())) {
        errorValidacion.innerHTML = "El correo no tiene el formato adecuado.";
       return false;
    }

}

