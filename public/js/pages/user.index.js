var datatableUsers = null;

$(document).ready(function () {
    user.init();
});

var user = {

    init: function () {

        $('#btnLimpiar').on('click', function () {
            user.clear();
        });

        $("#formUser").on("submit", function (e) {
            e.preventDefault();
            hidePanelError();

            var idUsuario = $('#txtIdUsuario').val();
            idUsuario = idUsuario.trim();

            if(idUsuario == ''){

                var formIsValid = user.valid();

                if (formIsValid.valid == false) {
                    showPanelErrorSimple(formIsValid.message);
                } else {
                    user.addNewUser();
                }   

            }else{

                var formIsValid = user.valid(true);

                if (formIsValid.valid == false) {
                    showPanelErrorSimple(formIsValid.message);
                } else {
                    user.updateUser();
                }

            }
        });

        user.listUsers();
    },

    addNewUser: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formUser");

        $.ajax({
            url: url + "user/saveUser",
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
                    user.clear();
                    alertify.success(response.message);
                    datatableUsers.ajax.reload(null, true);
                    datatableUsers.search("").draw();
                    $('#tblUsers thead tr:eq(1) th').each(function (i) {
                            $('input', this).val('');
                            if (datatableUsers.column(i).search() !== $('input', this).val()) {
                                datatableUsers
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

    updateUser: function () {

        showSpinner();
        hidePanelError();

        var fd = getDataFromForm("formUser");

        $.ajax({
            url: url + "user/updateUser",
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
                    user.clear();
                    alertify.success(response.message);
                    datatableUsers.ajax.reload(null, false);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    edit: function (idUsuario, usuario, nombreCompleto, rol, correoElectronico) {
        scrollTopAnimate();
        $("#formUser")[0].reset();
        $('#btnGuardar').text('Modificar');
        $('#btnGuardar').removeClass('btn-success').addClass('btn-primary');
        $('#box').removeClass('box-success').addClass('box-primary');
        $('#labelStatusForm').text('Editar Usuario con código: ' + idUsuario);
        $('#labelStatusForm').removeClass('label-success').addClass('label-primary');

        $('#txtIdUsuario').val(idUsuario);
        $('#txtUsuario').val(usuario);
        $('#txtNombreCompleto').val(nombreCompleto);
        $('#sltRol').val(rol);
        $('#txtCorreoElectronico').val(correoElectronico);

        $('.update-no-required').removeClass('show-required').addClass('hide-required');
    },

    listUsers: function () {

        $('#tblUsers thead tr').clone(true).appendTo('#tblUsers thead');
        $('#tblUsers thead tr:eq(1) th').each(function (i) {

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
                    if (datatableUsers.column(i).search() !== this.value) {
                        datatableUsers
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            }else{
                $(this).html('');
            }

        });

        datatableUsers = $('#tblUsers').DataTable({
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
                "url": url + 'user/listUsers',
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
                { "data": "idUsuario" },
                { "data": "usuario" },
                { "data": "nombreCompleto" },
                { "data": "rol" },
                { "data": "correoElectronico" },
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

                        var btnChangeStatus, btnEdit, btnSendRecoveryPassword;

                        if (row.estado == '0')
                            btnChangeStatus = `
                        <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Activar" onclick="user.changeStatus(${row.idUsuario}, ${row.estado})">
                        <i class="fa fa-check"></i>
                        </button>`;
                        else if (row.estado == '1')
                            btnChangeStatus = `
                        <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Inactivar" onclick="user.changeStatus(${row.idUsuario}, ${row.estado})">
                        <i class="fa fa-close"></i>
                        </button>`;

                        btnEdit = `
                    <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar" onclick="user.edit(
                        ${row.idUsuario},
                        '${row.usuario}',
                        '${row.nombreCompleto}',
                        '${row.rol}',
                        '${row.correoElectronico}')">
                            <i class="fa fa-pencil"></i>
                    </button>`;

                        btnSendRecoveryPassword = `
                    <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Enviar código de recuperación de contraseña al correo electrónico" onclick="user.sendRecoveryCode('${row.correoElectronico}')">
                    <i class="fa fa-envelope"></i>
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
                            ${btnSendRecoveryPassword}
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

    changeStatus: function (idUsuario, estado) {

        showSpinner();
        hidePanelError();

        $.ajax({
            url: url + "user/changeStatus",
            method: "POST",
            data: {
                'txtIdUsuario': idUsuario,
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
                    datatableUsers.ajax.reload(null, false);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    sendRecoveryCode: function (correoElectronico) {

        showSpinner();
        hidePanelError();

        // Envia una petición ajax a la siguiente URL: localhost/login/sendRecoveryCode

        $.ajax({
            url: url + "login/sendRecoveryCode",
            method: "POST",
            data: {
                'txtCorreoElectronico': correoElectronico
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
                }
                
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function() {
                hideSpinner();
            });

    },

    clear: function () {

        $("#formUser")[0].reset();
        $('#btnGuardar').text('Guardar');
        $('#btnGuardar').removeClass('btn-primary').addClass('btn-success');
        $('#box').removeClass('box-primary').addClass('box-success');
        $('#labelStatusForm').text('Crear Usuario');
        $('#labelStatusForm').removeClass('label-primary').addClass('label-success');

        $('.update-no-required').removeClass('hide-required').addClass('show-required');
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
                formIsValid.message += "El campo código del usuario es obligatorio. <br>";
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