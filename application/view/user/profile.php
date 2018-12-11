<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Perfil
        <small> de usuario</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Perfil</li>
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

            <div id="box" class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Información del perfil</h3>
                    <div class="pull-right">
                        <label id="labelStatusForm" class="label label-primary">Actualizar Información del Perfil</label>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="formUserProfile">
                    <div class="box-body">

                        <div class="row">

                            <input type="hidden" class="form-control" id="txtIdUsuario" name="txtIdUsuario" value="<?php echo $_SESSION['user']->idUsuario; ?>" placeholder="Ejm: 1">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtUsuario">Usuario <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" value="<?php echo $_SESSION['user']->usuario; ?>" placeholder="Ejm: julian24">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtContrasena">Contraseña</label>
                                    <input type="password" class="form-control" id="txtContrasena" name="txtContrasena" placeholder="Ejm: Contrasenia123.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtNombreCompleto">Nombre Completo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtNombreCompleto" name="txtNombreCompleto" value="<?php echo $_SESSION['user']->nombreCompleto; ?>" placeholder="Ejm: Julian Suarez">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sltRol">Rol del usuario <span class="text-danger">*</span></label>
                                    <select class="form-control" name="sltRol" id="sltRol">
                                        <option <?php echo $_SESSION['user']->rol == 'VENDEDOR' ? 'selected' : ''; ?> value="<?php echo VENDEDOR; ?>">
                                            <?php echo VENDEDOR; ?>
                                        </option>
                                        <option <?php echo $_SESSION['user']->rol == 'ADMINISTRADOR' ? 'selected' : ''; ?> value="<?php echo ADMINISTRADOR; ?>">
                                            <?php echo ADMINISTRADOR; ?>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtCorreoElectronico">Correo Electrónico <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="txtCorreoElectronico" name="txtCorreoElectronico" value="<?php echo $_SESSION['user']->correoElectronico; ?>" placeholder="Ejm: julian@gmail.com">
                                    <p class="help-block">Este correo electrónico será utilizado para el envio de la nueva
                                        contraseña en caso de olvidarla.</p>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-primary">Actualizar Perfil</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</section>
<!-- /.content -->

<?php $js = ''; ?>
<?php $js .= '<script src="'.URL.'js/pages/user.profile.js"></script>'; ?>