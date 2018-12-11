$(document).ready(function () {
    userLogin.init();
});

var userLogin = {

    init: function () {

        $("#formUserLogin").on("submit", function (e) {
            e.preventDefault();

            hidePanelError();
            var formIsValid = userLogin.valid();

            if(formIsValid.valid == false){
                showPanelErrorSimple(formIsValid.message);
            }else{
                userLogin.auth();
            }
            
        });

    },

    auth: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formUserLogin");

        // Envia una petición ajax a la siguiente URL: localhost/login/auth

        $.ajax({
            url: url + "login/auth",
            method: "POST",
            data: fd,
            contentType: false,
            processData: false,
            dataType: "json"
        })
            .done(function (response) {

                if (response.result == false) {

                    if (response.validationsErrors == true) {

                        alertify.error(response.message);
                        showPanelError(response.errors);

                    } else {
                        alertify.error(response.message);
                    }

                } else {
                    alertify.success(response.message);
                }

                if (response.redirect) {
                    setTimeout(function(){ redirect(response.urlRedirect); }, 1000);
                }

            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function() {
                hideSpinner();
            });

    },

    valid: function(){

        var formIsValid = {
            valid: true,
            message: ""
        };

        var fieldValid = $('#txtUsuario').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El usuario es requerido. <br>";
        }

        var fieldValid = $('#txtContrasena').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "La contraseña es requerida. <br>";
        }

        return formIsValid;

    }

}