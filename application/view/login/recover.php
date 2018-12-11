<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo APP_NAME; ?> |
        <?php echo $title; ?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="<?php echo URL; ?>login_libs/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="<?php echo URL; ?>login_libs/login.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/spinner.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL; ?>plugins/alertifyjs/css/alertify.min.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>plugins/alertifyjs/css/themes/bootstrap.min.css"/>

</head>

<body>

    <div id="spinner" class="spinner">
        <div class="loader">Cargando...</div>
    </div>

    <div class="wrapper">

        <div id="formContent">
            <!-- Tabs Titles -->

            <div>
                <h4>
                    <?php echo APP_NAME; ?>
                </h4>
            </div>

            <!-- Icon -->
            <div>
                <img src="<?php echo URL; ?>login_libs/email.png" id="icon" alt="User Icon" />
            </div>

            <div id="panelError" class="row hide">
                <div class="col-md-12">

                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fa fa-ban"></i> <span id="panelErrorTitle"></span></h5>
                        <p id="panelErrorErrors"></p>
                    </div>

                </div>
            </div>

            <!-- Login Form -->
            <form id="formUserRecover">
                <input type="email" id="txtCorreoElectronico" name="txtCorreoElectronico" placeholder="Correo Electrónico">
                
                <div class="loginButton">
                    <input type="submit" value="Enviar Contraseña">
                </div>
                
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="<?php echo URL; ?>login">Volver a iniciar sesión</a>
            </div>

        </div>
    </div>

    <script>
        var url = "<?php echo URL; ?>";
    </script>

    <script src="<?php echo URL; ?>login_libs/jquery.min.js"></script>
    <script src="<?php echo URL; ?>login_libs/bootstrap.min.js"></script>
    <script src="<?php echo URL; ?>plugins/alertifyjs/alertify.min.js"></script>

    <script src="<?php echo URL; ?>js/general.js"></script>
    <script src="<?php echo URL; ?>js/pages/recover.js"></script>

    <?php if(isset($mensaje)){ ?>

        <script>
            
            window.onload = function(){
                alertify.message('<?php echo $mensaje; ?>');
            }

        </script>

    <?php } ?>

</body>

</html>