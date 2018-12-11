<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Usuarios
        <small> del sistema</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Usuarios</li>
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
                    <h3 class="box-title">Información de los usuarios</h3>
                    <div class="pull-right">
                        <label id="labelStatusForm" class="label label-success">Crear Usuario</label>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="formUser">
                    <div class="box-body">

                        <div class="row">

                            <input type="hidden" class="form-control" id="txtIdUsuario" name="txtIdUsuario" placeholder="Ejm: 1">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtUsuario">Usuario <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" placeholder="Ejm: julian24">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtContrasena">Contraseña <span class="text-danger update-no-required">*</span> </label>
                                    <input type="password" class="form-control" id="txtContrasena" name="txtContrasena" placeholder="Ejm: Contrasenia123.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtNombreCompleto">Nombre Completo <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="txtNombreCompleto" name="txtNombreCompleto" placeholder="Ejm: Julian Suarez">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sltRol">Rol del usuario <span class="text-danger">*</span> </label>
                                    <select class="form-control" name="sltRol" id="sltRol">
                                        <option value="<?php echo VENDEDOR; ?>">
                                            <?php echo VENDEDOR; ?>
                                        </option>
                                        <option value="<?php echo ADMINISTRADOR; ?>">
                                            <?php echo ADMINISTRADOR; ?>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtCorreoElectronico">Correo Electrónico <span class="text-danger">*</span> </label>
                                    <input type="email" class="form-control" id="txtCorreoElectronico" name="txtCorreoElectronico" placeholder="Ejm: julian@gmail.com">
                                    <p class="help-block">Este correo electrónico será utilizado para el envio de la nueva
                                        contraseña en caso de olvidarla.</p>
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
                    <h3 class="box-title">Listado de usuarios</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="table-responsive">

                        <table id="tblUsers" class="table table-bordered table-hover">
                            <thead>
                                <tr class="active">
                                    <th>Código</th>
                                    <th>Usuario</th>
                                    <th>Nombre Completo</th>
                                    <th>Rol del Usuario</th>
                                    <th>Correo Electrónico</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="active">
                                    <th>Código</th>
                                    <th>Usuario</th>
                                    <th>Nombre Completo</th>
                                    <th>Rol del Usuario</th>
                                    <th>Correo Electrónico</th>
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
<?php $js .= '<script src="'.URL.'js/pages/user.index.js"></script>'; ?>