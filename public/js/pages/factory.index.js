$(document).ready(function () {
    factory.init();
});

var factory = {

    init: function () {

        $("#txtLogo").change(function () {
            var imageValid = validImage(this);
            if (imageValid) readURL(this);
        });

        $("#formFactory").on("submit", function (e) {
            e.preventDefault();
            hidePanelError();

            var idEmpresa = $('#txtIdEmpresa').val();
            idEmpresa = idEmpresa.trim();

            if (idEmpresa == '') {

                var formIsValid = factory.valid();

                if (formIsValid.valid == false) {
                    showPanelErrorSimple(formIsValid.message);
                } else {
                    factory.addNewFactory();
                }

            } else {

                var formIsValid = factory.valid(true);

                if (formIsValid.valid == false) {
                    showPanelErrorSimple(formIsValid.message);
                } else {
                    factory.updateFactory();
                }

            }
        });

        factory.getFactory();
    },

    addNewFactory: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formFactory");

        $.ajax({
            url: url + "factory/saveFactory",
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
                    factory.getFactory();
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    updateFactory: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formFactory");

        $.ajax({
            url: url + "factory/updateFactory",
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
                    factory.getFactory();
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
        $("#formFactory")[0].reset();
        $('#btnGuardar').text('Modificar');
        $('#btnGuardar').removeClass('btn-success').addClass('btn-primary');
        $('#box').removeClass('box-success').addClass('box-primary');
        $('#labelStatusForm').text('Editar Información de Mi Negocio');
        $('#labelStatusForm').removeClass('label-success').addClass('label-primary');

        $('#txtIdEmpresa').val(dataFactory.idEmpresa);
        $('#txtNombreEmpresa').val(dataFactory.nombreEmpresa);
        $('#txtRegimen').val(dataFactory.regimen);
        $('#txtNIT').val(dataFactory.NIT);

        $('#txtDireccion').val(dataFactory.direccion);
        $('#txtTelefono').val(dataFactory.telefono);
        $('#txtCelular').val(dataFactory.celular);
        $('#txtCorreoElectronico').val(dataFactory.correoElectronico);
        $('#txtDescripcion').val(dataFactory.descripcion);
        $('#txtDescripcionPieFactura').val(dataFactory.descripcionPieFactura);

        console.log(dataFactory.urlLogo);

        if(dataFactory.urlLogo.trim() != ""){
            console.log(dataFactory.urlLogo);
            $('#imagePreview').attr('src', url+dataFactory.urlLogo);
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
                        showPanelInfoSimple("La información de Mi Negocio aún no existe. Por favor ingresa la información y presiona el botón de guardar.");
                    }

                } else {

                    factory.edit(response.data);

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

        var fieldValid = $('#txtNombreEmpresa').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Nombre de la Empresa es obligatorio. <br>";
        }

        var fieldValid = $('#txtRegimen').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Régimen es obligatorio. <br>";
        }


        var fieldValid = $('#txtNIT').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo NIT es obligatorio. <br>";
        }

        var fieldValid = $('#txtDireccion').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Dirección es obligatorio. <br>";
        }

        var fieldValid = $('#txtTelefono').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Teléfono es obligatorio. <br>";
        }

        var fieldValid = $('#txtCelular').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Celular es obligatorio. <br>";
        }

        var fieldValid = $('#txtCorreoElectronico').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Correo Electrónico es obligatorio. <br>";
        }

        var fieldValid = $('#txtDescripcion').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Descripción de la empresa es obligatorio. <br>";
        }

        var fieldValid = $('#txtDescripcionPieFactura').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Descripción Pie de factura es obligatorio. <br>";
        }

        return formIsValid;

    }

}