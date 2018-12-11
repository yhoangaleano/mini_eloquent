<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{componentName}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">{{componentName}}</li>
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
                    <h3 class="box-title">Información del {{componentName}}</h3>
                    <div class="pull-right">
                        <label id="labelStatusForm" class="label label-success">Crear {{componentName}}</label>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="form{{componentName}}">
                    <div class="box-body">

                        <div class="row">

                            <input type="hidden" class="form-control" id="{{primaryKey}}" name="{{primaryKey}}" placeholder="Ejm: 1">

                            {{formInputs}}

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
                    <h3 class="box-title">Listado de {{componentName}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="table-responsive">

                        <table id="tbl{{componentName}}s" class="table table-bordered table-hover">
                            <thead>
                                <tr class="active">
                                    {{tableHeaders}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                {{tableHeaders}}
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

    <div class="modal fade" id="modal-{{componentName}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ver Detalle {{componentName}} <span id="modalLabel{{componentName}}_{{primaryKey}}" class="label label-primary"></span></h4>
                </div>
                <div class="modal-body">
                    
                    <div class="table-responsive">

                        <table id="tbl{{componentName}}Detail" class="table table-bordered table-hover">
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
<?php $js .= '<script src="'.URL.'js/pages/{{componentName}}.index.js"></script>'; ?>