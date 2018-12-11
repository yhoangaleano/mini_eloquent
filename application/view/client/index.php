<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Clientes
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Clientes</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div id="panelError" class="row hide">
        <div class="col-md-12">
            <div class="callout callout-danger">
                <h4 id="panelErrorTitle"></h4>
                <p id="panelErrorErrors"></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div id="box" class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Información del Cliente</h3>
                    <div class="pull-right">
                        <label id="labelStatusForm" class="label label-success">Crear Cliente</label>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="formClient">
                    <div class="box-body">

                        <div class="row">

                            <input type="hidden" class="form-control" id="txtIdCliente" name="txtIdCliente" placeholder="Ejm: 1">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtDocumento">Documento </label>
                                    <input type="text" class="form-control" id="txtDocumento" name="txtDocumento"
                                        placeholder="Ejm: 1234567890">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtNombreCompleto">Nombre Completo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtNombreCompleto" name="txtNombreCompleto"
                                        placeholder="Ejm: Andrés Perez">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtDireccion">Dirección </label>
                                    <input type="text" class="form-control" id="txtDireccion" name="txtDireccion"
                                        placeholder="Ejm: Calle 77 AB # 78 a 23">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtTelefonoFijo">Teléfono Fijo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtTelefonoFijo" name="txtTelefonoFijo"
                                        placeholder="Ejm: 5033325">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtCelularPrincipal">Celular Principal </label>
                                    <input type="text" class="form-control" id="txtCelularPrincipal" name="txtCelularPrincipal"
                                        placeholder="Ejm: 3047651234">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtCelularAlternativo">Celular Alternativo </label>
                                    <input type="text" class="form-control" id="txtCelularAlternativo" name="txtCelularAlternativo"
                                        placeholder="Ejm: 3008907651">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txtCorreoElectronico">Correo Electrónico <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="txtCorreoElectronico" name="txtCorreoElectronico"
                                        placeholder="Ejm: andresperez@gmail.com">
                                    <p class="help-block">Este correo electrónico será utilizado para el envio
                                        notificaciones sobre el servicio (Ingreso, Finalización).</p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txtObservaciones">Observaciones </label>
                                    <textarea name="txtObservaciones" id="txtObservaciones" class="form-control" cols="30"
                                        rows="10" placeholder="Ejm: Andrés es un cliente que paga inmediato y trae demasiados trabajos para realizar."></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-success">Guardar</button>
                        <button type="button" id="btnLimpiar" name="btnLimpiar" class="btn btn-default">Limpiar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de clientes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="table-responsive">

                        <table id="tblClients" class="table table-bordered table-hover">
                            <thead>
                                <tr class="active">
                                    <th>Código</th>
                                    <th>Nombre Completo</th>
                                    <th>Teléfono Fijo</th>
                                    <th>Correo Electrónico</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="active">
                                    <th>Código</th>
                                    <th>Nombre Completo</th>
                                    <th>Teléfono Fijo</th>
                                    <th>Correo Electrónico</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
    </div>

    <div class="modal fade" id="modal-preview">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ver Detalle Cliente <span id="modalLabelidCliente" class="label label-primary">10</span></h4>
                </div>
                <div class="modal-body">
                    
                    <div class="table-responsive">

                        <table id="tblClientDetail" class="table table-bordered table-hover">
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button id="btnEditarModal" type="button" class="btn btn-primary">Editar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>
<!-- /.content -->

<!-- DataTables -->
<?php $css = ''; ?>
<?php $css .= '<link rel="stylesheet" href="'.URL.'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">'; ?>

<?php $js = ''; ?>
<?php $js .= '<script src="'.URL.'bower_components/datatables.net/js/jquery.dataTables.min.js"></script>'; ?>
<?php $js .= '<script src="'.URL.'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>'; ?>
<?php $js .= '<script src="'.URL.'js/pages/client.index.js"></script>'; ?>