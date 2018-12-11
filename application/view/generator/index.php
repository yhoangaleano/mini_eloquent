<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Generador de Código
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Generador de Código</li>
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
                    <h3 class="box-title">Información de las tablas</h3>
                    <div class="pull-right">
                        <label id="labelStatusForm" class="label label-success">Configuraciones</label>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="formGenerator">
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sltTables">Nombre de las tabla <span class="text-danger">*</span>
                                    </label>
                                    <select id="sltTables" name="sltTables" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="tblInfoColumns">Información de la tabla
                                    </label>

                                    <div class="table-responsive">

                                        <table id="tblInfoColumns" class="table table-bordered table-hover">
                                            <thead>
                                                <tr class="active">
                                                    <th>Clave primaria</th>
                                                    <th>Campo</th>
                                                    <th>Tipo</th>
                                                    <th>Requerido</th>
                                                    <th>Valor por defecto</th>
                                                    <th>Extra</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr class="active">
                                                    <th>Clave primaria</th>
                                                    <th>Campo</th>
                                                    <th>Tipo</th>
                                                    <th>Requerido</th>
                                                    <th>Valor por defecto</th>
                                                    <th>Extra</th>

                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txtFileName">Nombre del componente <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="txtFileName" name="txtFileName"
                                        placeholder="Ejm: Service">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txtPrimaryKey">Clave primaria <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="txtPrimaryKey" name="txtPrimaryKey"
                                        placeholder="Ejm: idServicio">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txtLabelPrimaryKey">Label de Clave primaria <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="txtLabelPrimaryKey" name="txtLabelPrimaryKey"
                                        placeholder="Ejm: Código del Servicio">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sltKeyType">Tipo de dato Primary Key <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="sltKeyType" id="sltKeyType">
                                        <option value="int">Int</option>
                                        <option value="string">String</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sltIncrementing">¿Es Auto Incrementable? <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="sltIncrementing" id="sltIncrementing">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txtFileName">Campos permitidos para el asignamiento en masa <span class="text-danger">*</span>
                                    </label>
                                    <div id="panelFillables">

                                    </div>

                                </div>
                            </div>



                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>
                                    Creación de formulario
                                </h3>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sltCampo">Campo <span class="text-danger">*</span>
                                    </label>
                                    <select id="sltCampo" name="sltCampo" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txtLabel">Texto de Apoyo (Label)
                                    </label>
                                    <input type="text" class="form-control" id="txtLabel" name="txtLabel"
                                        placeholder="Ejm: Nombre Completo">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sltComponente">Componente <span class="text-danger">*</span>
                                    </label>
                                    <select id="sltComponente" name="sltComponente" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sltTipoComponente">Tipo de componente
                                    </label>
                                    <select id="sltTipoComponente" name="sltTipoComponente" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12" id="pnlSelectConfig">
                                
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtURIAPI">URI API
                                            </label>
                                            <input type="text" class="form-control" id="txtURIAPI" name="txtURIAPI" placeholder="Ejm: users/list">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txtSelectValue">Valor del Select
                                            </label>
                                            <input type="text" class="form-control" id="txtSelectValue" name="txtSelectValue" placeholder="Ejm: id">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txtSelectText">Texto de Select
                                            </label>
                                            <input type="text" class="form-control" id="txtSelectText" name="txtSelectText" placeholder="Ejm: nombre">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12" id="pnlFileUploadConfig">
                                
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="txtFolder">Carpeta para guardar
                                            </label>
                                            <input type="text" class="form-control" id="txtFolder" name="txtFolder" placeholder="Ejm: usuarios">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sltValidaciones">Validaciones
                                    </label>
                                    <select id="sltValidaciones" name="sltValidaciones" class="form-control" multiple>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" id="btnAgregar" name="btnAgregar" class="btn btn-primary btn-block">Agregar
                                        al formulario</button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">

                                    <div class="table-responsive">

                                        <table id="tblFields" class="table table-bordered table-hover">
                                            <thead>
                                                <tr class="active">
                                                    <th>Campo</th>
                                                    <th>Componente</th>
                                                    <th>Tipo Componente</th>
                                                    <th>Validaciones</th>
                                                    <th>Texto de Apoyo (Label)</th>
                                                    <th>Configuraciones Extra</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr class="active">
                                                    <th>Campo</th>
                                                    <th>Componente</th>
                                                    <th>Tipo Componente</th>
                                                    <th>Validaciones</th>
                                                    <th>Texto de Apoyo (Label)</th>
                                                    <th>Configuraciones Extra</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-success">Generar Código</button>
                        <button type="button" id="btnLimpiar" name="btnLimpiar" class="btn btn-default">Limpiar</button>
                    </div>
                </form>
            </div>

        </div>


    </div>

</section>
<!-- /.content -->

<!-- DataTables -->
<?php $css = ''; ?>
<?php $css .= '<link rel="stylesheet" href="'.URL.'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">'; ?>

<?php $js = ''; ?>
<?php $js .= '<script src="'.URL.'bower_components/datatables.net/js/jquery.dataTables.min.js"></script>'; ?>
<?php $js .= '<script src="'.URL.'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>'; ?>
<?php $js .= '<script src="'.URL.'js/pages/generator.index.js"></script>'; ?>