$(document).ready(function () {
    profile.init();
});

var profile = {

    init: function () {

        $("#formUserProfile").on("submit", function (e) {
            e.preventDefault();
            hidePanelError();

            var formIsValid = profile.valid(true);

            if (formIsValid.valid == false) {
                showPanelErrorSimple(formIsValid.message);
            } else {
                profile.updateUserProfile();
            }

        });

    },

    updateUserProfile: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formUserProfile");

        $.ajax({
            url: url + "user/updateUserProfile",
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
                    setTimeout(function(){ redirect(url+'user/profile'); }, 1000);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    valid: function (update = false) {

        var formIsValid = {
            valid: true,
            message: ""
        };

        if (update == true) {

            var fieldValid = $('#txtIdUsuario').val();
            if (fieldValid == '') {
                formIsValid.valid = false;
                formIsValid.message += "El campo ódigo del usuario es obligatorio. <br>";
            }

        }

        var fieldValid = $('#txtUsuario').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Usuario es obligatorio. <br>";
        }

        if (update == false) {

            var fieldValid = $('#txtContrasena').val();
            if (fieldValid == '') {
                formIsValid.valid = false;
                formIsValid.message += "El campo Contraseña es obligatorio. <br>";
            }

        }

        var fieldValid = $('#txtNombreCompleto').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Nombre Completo es obligatorio. <br>";
        }

        var fieldValid = $('#sltRol').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Rol del usuario es obligatorio. <br>";
        }

        var fieldValid = $('#txtCorreoElectronico').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Correo Electrónico es obligatorio. <br>";
        }

        return formIsValid;

    }

}