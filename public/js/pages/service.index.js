var datatableService = null;

$(document).ready(function () {
    service.init();
});

var service = {

    init: function () {

        $('#btnLimpiar').on('click', function () {
            service.clear();
        });

        $("#formService").on("submit", function (e) {
            e.preventDefault();
            hidePanelError();

            var idServicio = $('#txtIdServicio').val();
            idServicio = idServicio.trim();

            if (idServicio == '') {

                var formIsValid = service.valid();

                if (formIsValid.valid == false) {
                    showPanelErrorSimple(formIsValid.message);
                } else {
                    service.store();
                }

            } else {

                var formIsValid = service.valid(true);

                if (formIsValid.valid == false) {
                    showPanelErrorSimple(formIsValid.message);
                } else {
                    service.update();
                }

            }
        });

        service.list();
    },

    store: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formService");

        $.ajax({
            url: url + "service/store",
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
                    service.clear();
                    alertify.success(response.message);
                    datatableService.ajax.reload(null, true);
                    datatableService.search("").draw();
                    $('#tblServices thead tr:eq(1) th').each(function (i) {
                        $('input', this).val('');
                        if (datatableService.column(i).search() !== $('input', this).val()) {
                            datatableService
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

    update: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formService");

        $.ajax({
            url: url + "service/update",
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
                    service.clear();
                    alertify.success(response.message);
                    datatableService.ajax.reload(null, false);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    edit: function (dataService) {

        scrollTopAnimate();
        $("#formService")[0].reset();
        $('#btnGuardar').text('Modificar');
        $('#btnGuardar').removeClass('btn-success').addClass('btn-primary');
        $('#box').removeClass('box-success').addClass('box-primary');
        $('#labelStatusForm').text('Editar Servicio con código: ' + dataService.idServicio);
        $('#labelStatusForm').removeClass('label-success').addClass('label-primary');

        $('#txtIdServicio').val(dataService.idServicio);
        $('#txtNombreServicio').val(dataService.nombreServicio);

        $('.update-no-required').removeClass('show-required').addClass('hide-required');
    },

    list: function () {

        $('#tblServices thead tr').clone(true).appendTo('#tblServices thead');
        $('#tblServices thead tr:eq(1) th').each(function (i) {

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
                    if (datatableService.column(i).search() !== this.value) {
                        datatableService
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            } else {
                $(this).html('');
            }

        });

        datatableService = $('#tblServices').DataTable({
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
                "url": url + 'service/list',
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
                { "data": "idServicio" },
                { "data": "nombreServicio" },
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

                        var btnChangeStatus, btnEdit;

                        if (row.estado == '0')
                            btnChangeStatus = `
                        <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Activar" onclick="service.changeStatus(${row.idServicio}, ${row.estado})">
                        <i class="fa fa-check"></i>
                        </button>`;
                        else if (row.estado == '1')
                            btnChangeStatus = `
                        <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Inactivar" onclick="service.changeStatus(${row.idServicio}, ${row.estado})">
                        <i class="fa fa-close"></i>
                        </button>`;

                        btnEdit = `
                    <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar" onclick='service.edit(
                        ${ JSON.stringify(row) })'>
                            <i class="fa fa-pencil"></i>
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
                        </tr>
                    </tbody>
                </table>`;
                    }
                }

            ]
        }
        );
    },

    changeStatus: function (idServicio, estado) {

        showSpinner();
        hidePanelError();

        $.ajax({
            url: url + "service/changeStatus",
            method: "POST",
            data: {
                'txtIdServicio': idServicio,
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
                    datatableService.ajax.reload(null, false);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    clear: function () {

        $("#formService")[0].reset();
        $('#btnGuardar').text('Guardar');
        $('#btnGuardar').removeClass('btn-primary').addClass('btn-success');
        $('#box').removeClass('box-primary').addClass('box-success');
        $('#labelStatusForm').text('Crear Servicio');
        $('#labelStatusForm').removeClass('label-primary').addClass('label-success');

        $('.update-no-required').removeClass('hide-required').addClass('show-required');
    },

    valid: function (update = false) {

        var formIsValid = {
            valid: true,
            message: ""
        };

        if (update == true) {

            var fieldValid = $('#txtIdServicio').val();
            if (fieldValid == '') {
                formIsValid.valid = false;
                formIsValid.message += "El campo código del servicio es obligatorio. <br>";
            }

        }

        var fieldValid = $('#txtNombreServicio').val();
        if (fieldValid == '') {
            formIsValid.valid = false;
            formIsValid.message += "El campo Nombre del Servicio es obligatorio. <br>";
        }

        return formIsValid;

    }

}