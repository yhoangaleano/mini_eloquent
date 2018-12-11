$(document).ready(function () {
    userRecover.init();
});

var userRecover = {

    init: function () {

        $("#formUserRecover").on("submit", function (e) {
            e.preventDefault();
            
            hidePanelError();
            var formIsValid = userRecover.valid();

            if(formIsValid.valid == false){
                showPanelErrorSimple(formIsValid.message);
            }else{
                userRecover.sendRecoveryCode();
            }
            
        });

    },

    sendRecoveryCode: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formUserRecover");

        // Envia una petición ajax a la siguiente URL: localhost/login/sendRecoveryCode

        $.ajax({
            url: url + "login/sendRecoveryCode",
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
            }).always(function() {
                hideSpinner();
            });

    },

    valid: function(){

        var formIsValid = {
            valid: true,
            message: ""
        };

        var fieldValid = $('#txtCorreoElectronico').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Correo Electrónico es obligatorio. <br>";
        }

        return formIsValid;

    }

}