<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Mi Negocio -  Información
        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><i class="fa fa-industry"></i> Mi Negocio</li>
        <li class="active">Información</li>
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

    <div id="panelInfo" class="row hide">
        <div class="col-md-12">
            <div class="callout callout-info">
                <h4 id="panelInfoTitle"></h4>
                <p id="panelInfoErrors"></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div id="box" class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Información de Mi Negocio</h3>
                    <div class="pull-right">
                        <label id="labelStatusForm" class="label label-success">Crear Mi Negocio</label>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="formFactory">
                    <div class="box-body">

                        <div class="row">

                            <input type="hidden" class="form-control" id="txtIdEmpresa" name="txtIdEmpresa" placeholder="Ejm: 1">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txtNombreEmpresa">Nombre de la empresa <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="txtNombreEmpresa" name="txtNombreEmpresa" value="Variedades y Comunicaciones" placeholder="Ejm: Variedades y Comunicaciones">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtRegimen">Régimen <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtRegimen" name="txtRegimen" value="Régimen Simplificado" placeholder="Ejm: Régimen Simplificado">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtNIT">NIT <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtNIT" name="txtNIT" value="98763007-1" placeholder="Ejm: 98763007-1">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtDireccion">Dirección <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" value="Cra. 36 A No. 77 BB - 45 Robledo Bello Horizonte" placeholder="Ejm: Cra. 36 A No. 77 BB - 45 Robledo Bello Horizonte">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtTelefono">Teléfono <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" value="4746745" placeholder="Ejm: 4746745">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtCelular">Celular <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtCelular" name="txtCelular" value="3005659290" placeholder="Ejm: 3005659290">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtCorreoElectronico">Correo Electrónico <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="txtCorreoElectronico" name="txtCorreoElectronico" value="variedcom@gmail.com" placeholder="Ejm: variedcom@gmail.com">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtDescripcion">Descripción de la empresa <span class="text-danger">*</span></label>
                                    <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" cols="30" rows="10" placeholder="Venta y Servicio Técnico de Celulares. Internet - Papelería - Llamadas a Celular. Reparación y Accesorios para Computadores.">Venta y Servicio Técnico de Celulares. Internet - Papelería - Llamadas a Celular. Reparación y Accesorios para Computadores.</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtDescripcionPieFactura">Descripción Pie de factura <span class="text-danger">*</span></label>
                                    <textarea name="txtDescripcionPieFactura" id="txtDescripcionPieFactura" class="form-control" cols="30" rows="10" placeholder="LA GARANTÍA NO CUBRE. Golpes, humedad, sobrecarga, equipos apagados, pantalla táctil,flex, yustin y levantamiento de sellos de garantía. NO SE DEVUELVE DINERO. No nos hacemos Responsables por teléfonos o accesorios que no sean reclamados después de 30 días. Se presume que los equipos traídos son de buena procedencia.">LA GARANTÍA NO CUBRE. Golpes, humedad, sobrecarga, equipos apagados, pantalla táctil, flex, yustin y levantamiento de sellos de garantía. NO SE DEVUELVE DINERO. No nos hacemos Responsables por teléfonos o accesorios que no sean reclamados después de 30 días. Se presume que los equipos traídos son de buena procedencia.</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtLogo">Logo <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="txtLogo" name="txtLogo" placeholder="Ejm: Logo de Variedades y Comunicaciones">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <img id="imagePreview" class="factoryLogo" src="<?php echo URL; ?>uploads/factory/default.png" alt="Logo" class="img-thumbnail">
                                </div>
                            </div>
                            

                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-success">Guardar</button>
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
<?php $js .= '<script src="'.URL.'js/pages/factory.index.js"></script>'; ?>