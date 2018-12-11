$(document).ready(function () {
    newPassword.init();
});

var newPassword = {

    init: function () {

        $("#formNewPassword").on("submit", function (e) {
            e.preventDefault();

            hidePanelError();
            var formIsValid = newPassword.valid();

            if (formIsValid.valid == false) {
                showPanelErrorSimple(formIsValid.message);
            } else {
                newPassword.updatePasswordWithCode();
            }

        });

    },

    updatePasswordWithCode: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formNewPassword");

        // Envia una petición ajax a la siguiente URL: localhost/login/updatePasswordWithCode

        $.ajax({
            url: url + "login/updatePasswordWithCode",
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
                    setTimeout(function(){ redirect(response.urlRedirect); }, 3000);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    valid: function () {

        var formIsValid = {
            valid: true,
            message: ""
        };

        var fieldValid = $('#txtIdUsuario').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Código del usuario es obligatorio. <br>";
        }

        var fieldValid = $('#txtCode').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Código de verificación es obligatorio. <br>";
        }

        var fieldValid = $('#txtContrasena').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Contraseña es obligatorio. <br>";
        }

        var fieldValid = $('#txtRepetirContrasena').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Repetir Contraseña es obligatorio <br>";
        }

        var contrasena = document.getElementById('txtContrasena').value;
        var repetirContrasena = document.getElementById('txtRepetirContrasena').value;

        if (contrasena != repetirContrasena) {
            formIsValid.valid = false;
            formIsValid.message += "Las contraseñas no coinciden. <br>";
        }

        return formIsValid;

    },

}