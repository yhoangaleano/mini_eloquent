$(document).ready(function () {
    logo.init();
});

var logo = {

    init: function () {

        $("#txtLogo").change(function () {
            var imageValid = validImage(this);
            if (imageValid) readURL(this);
        });

        $("#formLogo").on("submit", function (e) {
            e.preventDefault();
            hidePanelError();

            var formIsValid = logo.valid(true);

            if (formIsValid.valid == false) {
                showPanelErrorSimple(formIsValid.message);
            } else {
                logo.updatingFactoryLogo();
            }
        });

        logo.getFactory();
    },

    updatingFactoryLogo: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formLogo");

        $.ajax({
            url: url + "factory/updatingFactoryLogo",
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
                    logo.getFactory();
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    edit: function (dataFactory) {
        scrollTopAnimate();
        $("#formLogo")[0].reset();
        $('#txtIdEmpresa').val(dataFactory.idEmpresa);
        if (dataFactory.urlLogo.trim() != "") {
            $('#imagePreview').attr('src', url + dataFactory.urlLogo);
        }
    },

    getFactory: function () {

        showSpinner();
        hidePanelError();
        hidePanelInfo();

        $.ajax({
            url: url + "factory/getFactory",
            method: "GET",
            dataType: "json"
        })
            .done(function (response) {
                if (response.result == false) {

                    if (response.validationsErrors == true) {

                        alertify.error(response.message);
                        showPanelError(response.errors);

                    } else {
                        showPanelInfoSimple("No se puede actualizar el Logo, la información de Mi Negocio es requerida antes de poder cargar cualquier imagen. Por favor, verifique la información.");
                    }

                } else {

                    logo.edit(response.data);

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

            var fieldValid = $('#txtIdEmpresa').val();
            if (fieldValid == '') {
                formIsValid.valid = false;
                formIsValid.message += "El campo código de mi negocio es obligatorio. <br>";
            }

        }

        var fieldValid = $('#txtLogo').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Logo es obligatorio. <br>";
        }

        return formIsValid;

    }

}