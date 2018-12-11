var datatableClient = null;

$(document).ready(function () {
    client.init();
});

var client = {

    init: function () {

        $('#btnLimpiar').on('click', function () {
            client.clear();
        });

        $('#btnEditarModal').on('click', function () {
            var idCliente = $('#modalLabelidCliente').text();
            client.getClient(idCliente);
            $('#modal-preview').modal('hide');
        });

        $("#formClient").on("submit", function (e) {
            e.preventDefault();
            hidePanelError();

            var idCliente = $('#txtIdCliente').val();
            idCliente = idCliente.trim();

            if (idCliente == '') {

                var formIsValid = client.valid();

                if (formIsValid.valid == false) {
                    showPanelErrorSimple(formIsValid.message);
                } else {
                    client.addNewClient();
                }

            } else {

                var formIsValid = client.valid(true);

                if (formIsValid.valid == false) {
                    showPanelErrorSimple(formIsValid.message);
                } else {
                    client.updateClient();
                }

            }
        });

        client.listClients();
    },

    addNewClient: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formClient");

        $.ajax({
            url: url + "client/saveClient",
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
                    client.clear();
                    alertify.success(response.message);
                    datatableClient.ajax.reload(null, true);
                    datatableClient.search("").draw();
                    $('#tblClients thead tr:eq(1) th').each(function (i) {
                        $('input', this).val('');
                        if (datatableClient.column(i).search() !== $('input', this).val()) {
                            datatableClient
                                .column(i)
                                .search('')
                                .draw();
                        };
                    });
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    updateClient: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formClient");

        $.ajax({
            url: url + "client/updateClient",
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
                    client.clear();
                    alertify.success(response.message);
                    datatableClient.ajax.reload(null, false);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    getClient: function (idCliente) {

        showSpinner();
        hidePanelError();

        $.ajax({
            url: url + "client/getClient",
            method: "POST",
            data: {
                'txtIdCliente': idCliente
            },
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
                    client.edit(response.data);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    edit: function (dataClient) {

        scrollTopAnimate();
        $("#formClient")[0].reset();
        $('#btnGuardar').text('Modificar');
        $('#btnGuardar').removeClass('btn-success').addClass('btn-primary');
        $('#box').removeClass('box-success').addClass('box-primary');
        $('#labelStatusForm').text('Editar Cliente con código: ' + dataClient.idCliente);
        $('#labelStatusForm').removeClass('label-success').addClass('label-primary');

        $('#txtIdCliente').val(dataClient.idCliente);
        $('#txtDocumento').val(dataClient.documento);
        $('#txtNombreCompleto').val(dataClient.nombreCompleto);
        $('#txtDireccion').val(dataClient.direccion);
        $('#txtTelefonoFijo').val(dataClient.telefonoFijo);
        $('#txtCelularPrincipal').val(dataClient.celularPrincipal);
        $('#txtCelularAlternativo').val(dataClient.celularAlternativo);
        $('#txtCorreoElectronico').val(dataClient.correoElectronico);
        $('#txtObservaciones').val(dataClient.observaciones);

        $('.update-no-required').removeClass('show-required').addClass('hide-required');
    },

    listClients: function () {

        $('#tblClients thead tr').clone(true).appendTo('#tblClients thead');
        $('#tblClients thead tr:eq(1) th').each(function (i) {

            var title = $(this).text();

            if (title != 'Opciones') {

                var input = `<div class="input-group">
                <input type="text" style="width: 100%;" class="form-control" aria-label="${title}" placeholder="Buscar">
                <span class="input-group-addon">
                    <i class="fa fa-search"></i>
                </span>
              </div>`;

                $(this).html(input);

                $('input', this).on('keyup change', function () {
                    if (datatableClient.column(i).search() !== this.value) {
                        datatableClient
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            } else {
                $(this).html('');
            }

        });

        datatableClient = $('#tblClients').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            "order": [[0, "desc"]],
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            "deferRender": true,
            language: {
                url: url + "bower_components/datatables.net/js/spanish.json"
            },
            "ajax": {
                "url": url + 'client/listClients',
                "type": 'GET',
                "dataType": 'json',
                error: function (error) {
                    alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                    console.log("Oppss!! Ocurrio un error", error);
                },
                complete: function () {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                }
            },
            'columns': [
                { "data": "idCliente" },
                { "data": "nombreCompleto" },
                { "data": "telefonoFijo" },
                { "data": "correoElectronico" },
                { "data": "observaciones" },
                {
                    "data": "estado", render: function (data, type, row, meta) {
                        if (row.estado == '0')
                            return '<span>Inactivo</span>';
                        else if (row.estado == '1')
                            return '<span>Activo</span>';
                    }
                },
                {
                    "data": "estado", render: function (data, type, row, meta) {

                        var btnChangeStatus, btnEdit, btnPreview;

                        if (row.estado == '0')
                            btnChangeStatus = `
                        <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Activar" onclick="client.changeStatus(${row.idCliente}, ${row.estado})">
                        <i class="fa fa-check"></i>
                        </button>`;
                        else if (row.estado == '1')
                            btnChangeStatus = `
                        <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Inactivar" onclick="client.changeStatus(${row.idCliente}, ${row.estado})">
                        <i class="fa fa-close"></i>
                        </button>`;

                        btnEdit = `
                    <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar" onclick='client.edit(
                        ${ JSON.stringify(row) })'>
                            <i class="fa fa-pencil"></i>
                    </button>`;

                        btnPreview = `
                    <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Ver Detalle" onclick='client.preview(${ JSON.stringify(row) })'>
                    <i class="fa fa-eye"></i>
                    </button>`;

                        return `<table>
                    <tbody>
                        <tr>
                            <td style="padding: 5px;">
                            ${btnChangeStatus}
                            </td>
                            <td style="padding: 5px;">
                            ${btnEdit}
                            </td>
                            <td style="padding: 5px;">
                            ${btnPreview}
                            </td>
                        </tr>
                    </tbody>
                </table>`;
                    }
                }

            ]
        }
        );
    },

    changeStatus: function (idCliente, estado) {

        showSpinner();
        hidePanelError();

        $.ajax({
            url: url + "client/changeStatus",
            method: "POST",
            data: {
                'txtIdCliente': idCliente,
                'sltEstado': estado
            },
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
                    datatableClient.ajax.reload(null, false);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    preview: function (dataClient) {

        var status = dataClient.estado == '0' ? 'Inactivo' : 'Activo';

        $('#modalLabelidCliente').text(dataClient.idCliente);

        var infoClient = `
                <tr>
                    <td>
                        <b>Documento:</b>
                    </td>
                    <td>
                        ${dataClient.documento}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Nombre Completo:</b>
                    </td>
                    <td>
                        ${dataClient.nombreCompleto}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Dirección:</b>
                    </td>
                    <td>
                        ${dataClient.direccion}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Teléfono Fijo:</b>
                    </td>
                    <td>
                        ${dataClient.telefonoFijo}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Celular Principal:</b>
                    </td>
                    <td>
                        ${dataClient.celularPrincipal}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Celular Alternativo:</b>
                    </td>
                    <td>
                        ${dataClient.celularAlternativo}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Correo Electrónico:</b>
                    </td>
                    <td>
                        ${dataClient.correoElectronico}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Observaciones:</b>
                    </td>
                    <td>
                        ${dataClient.observaciones}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Estado:</b>
                    </td>
                    <td>
                        ${status}
                    </td>
                </tr>
       `;

        $('#tblClientDetail tbody').empty();
        $('#tblClientDetail tbody').append(infoClient);

        $('#modal-preview').modal('show');

    },

    clear: function () {

        $("#formClient")[0].reset();
        $('#btnGuardar').text('Guardar');
        $('#btnGuardar').removeClass('btn-primary').addClass('btn-success');
        $('#box').removeClass('box-primary').addClass('box-success');
        $('#labelStatusForm').text('Crear Cliente');
        $('#labelStatusForm').removeClass('label-primary').addClass('label-success');

        $('.update-no-required').removeClass('hide-required').addClass('show-required');
    },

    valid: function (update = false) {

        var formIsValid = {
            valid: true,
            message: ""
        };

        if (update == true) {

            var fieldValid = $('#txtIdCliente').val();
            if (fieldValid == '') {
                formIsValid.valid = false;
                formIsValid.message += "El campo código del cliente es obligatorio. <br>";
            }

        }

        var fieldValid = $('#txtNombreCompleto').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Nombre Completo es obligatorio. <br>";
        }

        var fieldValid = $('#txtTelefonoFijo').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Teléfono Fijo es obligatorio. <br>";
        }

        var fieldValid = $('#txtCorreoElectronico').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Correo Electrónico es obligatorio. <br>";
        }

        return formIsValid;

    }

}