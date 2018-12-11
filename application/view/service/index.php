<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Servicios
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Servicios</li>
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
                    <h3 class="box-title">Información del Servicio</h3>
                    <div class="pull-right">
                        <label id="labelStatusForm" class="label label-success">Crear Servicio</label>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="formService">
                    <div class="box-body">

                        <div class="row">

                            <input type="hidden" class="form-control" id="txtIdServicio" name="txtIdServicio" placeholder="Ejm: 1">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txtNombreServicio">Nombre del Servicio <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="txtNombreServicio" name="txtNombreServicio" placeholder="Ejm: Servicio Técnico">
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
                    <h3 class="box-title">Listado de servicios</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="table-responsive">

                        <table id="tblServices" class="table table-bordered table-hover">
                            <thead>
                                <tr class="active">
                                    <th>Código</th>
                                    <th>Nombre del Servicio</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="active">
                                    <th>Código</th>
                                    <th>Nombre del Servicio</th>
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

</section>
<!-- /.content -->

<!-- DataTables -->
<?php $css = ''; ?>
<?php $css .= '<link rel="stylesheet" href="'.URL.'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">'; ?>

<?php $js = ''; ?>
<?php $js .= '<script src="'.URL.'bower_components/datatables.net/js/jquery.dataTables.min.js"></script>'; ?>
<?php $js .= '<script src="'.URL.'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>'; ?>
<?php $js .= '<script src="'.URL.'js/pages/service.index.js"></script>'; ?>