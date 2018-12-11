<?php

namespace Mini\Controller;

use Mini\Model\User;
use Mini\Core\Controller;
use Mini\Libs\Helper;
use Mini\Libs\UtilResponse;

use Mini\Validations\NewPasswordValidations;
use Mini\Validations\SendRecoveryValidations;
use Mini\Validations\AuthValidations;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class LoginController extends Controller
{
    public $utilResponse = null;

    public function __construct()
    {
        $this->utilResponse = new UtilResponse();
    }

    public function index()
    {
        $this->render('login/index', 'Iniciar Sesión', null, false);
    }

    public function newPassword($code = null)
    {
        if (isset($code)) {
            $userModel = new User();
            $user = $userModel->getUserWithCode($code);

            if ($user === false) {
                $mensaje = 'El código de recuperación de contraseña no es válido. Por favor intenta de nuevo.';
                $this->render('login/recover', 'Recuperar Contraseña', array('mensaje' => $mensaje), false);
            } else {
                $current = date("Y-m-d H:i:s");

                if (strtotime($current) > strtotime($user->fechaRecuperacion)) {
                    $mensaje = 'El código de recuperación de contraseña ha expirado. Por favor intenta de nuevo.';
                    $this->render('login/recover', 'Recuperar Contraseña', array('mensaje' => $mensaje), false);
                } else {
                    $this->render('login/newPassword', 'Nueva Contraseña', array('user' =>  $user, 'code' => $code), false);
                }
            }
        } else {
            header('location: ' . URL);
        }
    }

    public function recover()
    {
        $this->render('login/recover', 'Recuperar Contraseña', null, false);
    }

    public function template()
    {
        $this->render('login/template', 'Registrar Usuario', null, false);
    }

    public function auth()
    {
        $validation = AuthValidations::validate($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $usuario = $_POST["txtUsuario"];
        $contrasena = $_POST["txtContrasena"];

        $userModel = new User();

        $user = $userModel->getUserWithUser($usuario);

        if ($user === false) {
            $this->utilResponse->setResponse(false, 'Usuario o contraseña incorrectos. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;
        } else {
            if (password_verify($contrasena, $user->contrasena)) {
                $_SESSION["role"] = $user->rol;
                $_SESSION["user"] = $user;
                $_SESSION["authenticated"] = true;

                $this->utilResponse->redirect = true;
                $this->utilResponse->urlRedirect = URL.'home';
                $this->utilResponse->setResponse(true, 'Bienvenido a Variedades y Comunicaciones.', null);
                echo json_encode($this->utilResponse);
                return;
            } else {
                $this->utilResponse->setResponse(false, 'Usuario o contraseña incorrectos. Por favor, verifique la información.', null);
                echo json_encode($this->utilResponse);
                return;
            }
        }
    }

    public function closeSession()
    {
        session_unset();
        session_destroy();
        header('Location:'.URL);
    }

    public function updatePasswordWithCode()
    {
        $validation = NewPasswordValidations::validate($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $idUsuario = $_POST['txtIdUsuario'];
        $code = $_POST['txtCode'];
        $contrasena = $_POST['txtContrasena'];
        $repetirContrasena = $_POST['txtRepetirContrasena'];

        $userModel = new User();
        $contrasena = password_hash($_POST['txtContrasena'], PASSWORD_BCRYPT);

        $resultado = $userModel->updatePasswordFromRecover($idUsuario, $contrasena);

        if ($resultado != false) {
            $this->utilResponse->redirect = true;
            $this->utilResponse->urlRedirect = URL.'login/index';
            $this->utilResponse->setResponse(true, 'Su contraseña ha sido cambiada con éxito.', null);
            echo json_encode($this->utilResponse);
            return;
        } else {
            $this->utilResponse->redirect = true;
            $this->utilResponse->urlRedirect = URL.'login/newPassword/'.$code;
            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar cambiar la contraseña. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;
        }
    }

    public function sendRecoveryCode()
    {
        $validation = SendRecoveryValidations::validate($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $correoElectronico = $_POST['txtCorreoElectronico'];
        $codigo = $this->createRandomCode();
        $fechaRecuperacion = date("Y-m-d H:i:s", strtotime('+24 hours'));
        $userModel = new User();
        $user = $userModel->getUserWithEmail($correoElectronico);

        if ($user === false) {
            $this->utilResponse->setResponse(false, 'El correo electrónico no se encuentra registrado en el sistema.', null);
            echo json_encode($this->utilResponse);
            return;
        } else {
            $respuesta = $userModel->recoverPassword($correoElectronico, $codigo, $fechaRecuperacion);
            
            if ($respuesta) {
                $this->sendMail($correoElectronico, $user->nombreCompleto, $codigo);
                $this->utilResponse->setResponse(true, 'Se ha enviado un correo electrónico con las instrucciones para el cambio de tu contraseña. Por favor verifica la información enviada.', null);
                echo json_encode($this->utilResponse);
                return;
            } else {
                $this->utilResponse->setResponse(false, 'No se puede recuperar la cuenta. Si los errores persisten comuníquese con el administrador del sitio.', null);
                echo json_encode($this->utilResponse);
                return;
            }
        }
    }
   
    public function sendMail($correoElectronico, $nombre, $codigo)
    {
        $template = file_get_contents(APP.'view/login/template.php');
        
        $template = str_replace("{{APP_NAME}}", APP_NAME, $template);
        $template = str_replace("{{name}}", $nombre, $template);
        $template = str_replace("{{action_url_2}}", '<b>http:'.URL.'login/newPassword/'.$codigo.'</b>', $template);
        $template = str_replace("{{action_url_1}}", 'http:'.URL.'login/newPassword/'.$codigo, $template);
        $template = str_replace("{{year}}", date('Y'), $template);
        $template = str_replace("{{operating_system}}", Helper::getOS(), $template);
        $template = str_replace("{{browser_name}}", Helper::getBrowser(), $template);

        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";

        try {
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;  //gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;   //username
            $mail->Password = MAIL_PASSWORD;   //password
            $mail->SMTPSecure = MAIL_ENCRYPTION;
            $mail->Port = MAIL_PORT;                    //smtp port

            $mail->setFrom(MAIL_USERNAME, APP_NAME);
            $mail->addAddress($correoElectronico, $nombre);

            $mail->isHTML(true);

            $mail->Subject = 'Recuperación de contraseña - '.APP_NAME;
            $mail->Body    = $template;

            if (!$mail->send()) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            return false;
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    public function createRandomCode()
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
    
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
    
        return time().$pass;
    }

}
