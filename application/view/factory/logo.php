<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Mi Negocio - Logo
        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><i class="fa fa-industry"></i> Mi Negocio</li>
        <li class="active"> Logo</li>
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

    <?php if ($factory != false) { ?>
        <div class="row">
            <div class="col-md-12">

                <div id="box" class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Logo de Mi Negocio</h3>
                        <div class="pull-right">
                            <label id="labelStatusForm" class="label label-primary">Logo para la factura</label>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" id="formLogo">
                        <div class="box-body">

                            <div class="row">

                                <input type="hidden" class="form-control" id="txtIdEmpresa" name="txtIdEmpresa" placeholder="Ejm: 1">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txtLogo">Logo <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="txtLogo" name="txtLogo" placeholder="Ejm: Logo de Variedades y Comunicaciones">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img id="imagePreview" class="factoryLogo" src="<?php echo URL; ?>uploads/factory/default.png"
                                            alt="Logo" class="img-thumbnail">
                                    </div>
                                </div>


                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    <?php } ?>

</section>
<!-- /.content -->

<?php $js = ''; ?>
<?php $js .= '<script src="'.URL.'js/pages/factory.logo.js"></script>'; ?>