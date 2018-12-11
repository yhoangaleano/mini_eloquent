<?php

namespace Mini\Controller;

use Mini\Model\User;
use Mini\Core\Controller;
use Mini\Libs\Helper;
use Mini\Libs\UtilResponse;

use Mini\Validations\UserValidations;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserController extends Controller
{
    public $utilResponse = null;

    public function __construct()
    {
        $this->utilResponse = new UtilResponse();
    }

    public function index()
    {
        $this->render('user/index', 'Usuarios');
    }

    public function saveUser()
    {
        $validation = UserValidations::validate($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $userModel = new User();
        $contrasena = password_hash($_POST['txtContrasena'], PASSWORD_BCRYPT);
        $resultado = $userModel->addUser($_POST['txtUsuario'], $contrasena, $_POST['txtNombreCompleto'], $_POST['txtCorreoElectronico'], $_POST['sltRol']);
       
        if ($resultado != false) {

            $this->utilResponse->setResponse(true, 'Usuario guardado con éxito.', null);
            echo json_encode($this->utilResponse);
            return;

        } else {

            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar guardar el usuario. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;

        }
    }

    public function updateUser()
    {
        $validation = UserValidations::validate($_POST, true);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        if(trim($_POST['txtContrasena']) != ""){
            $validation = UserValidations::validatePassword($_POST);
            if (!$validation->result) {
                echo json_encode($validation);
                return;
            }
        }

        $userModel = new User();
        $resultado = $userModel->updateUser($_POST['txtUsuario'], $_POST['txtNombreCompleto'], $_POST['txtCorreoElectronico'], $_POST['sltRol'], $_POST['txtIdUsuario']);
       
        if ($resultado != false) {

            if(trim($_POST['txtContrasena']) != ""){
                $contrasena = password_hash($_POST['txtContrasena'], PASSWORD_BCRYPT);
                $userModel->updatePassword($_POST['txtIdUsuario'],  $contrasena);
            }

            $this->utilResponse->setResponse(true, 'Usuario actualizado con éxito.', null);
            echo json_encode($this->utilResponse);
            return;

        } else {

            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar actualizar el usuario. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;

        }
    }

    public function listUsers()
    {
        $userModel = new User();
        $users = $userModel->getAllUsersWithoutCurrent($_SESSION['user']->idUsuario);
       
        if ($users != false) {

            $this->utilResponse->setResponse(true, 'Usuarios listados con éxito.', $users);
            echo json_encode($this->utilResponse);
            return;

        } else {

            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar listar los usuarios. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;

        }
    }

    public function changeStatus()
    {
        $validation = UserValidations::validateChangeStatus($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $userModel = new User();
        $resultado = $userModel->changeUserStatus($_POST['txtIdUsuario'], $_POST['sltEstado']);
       
        if ($resultado != false) {

            $this->utilResponse->setResponse(true, 'Usuario actualizado con éxito.', null);
            echo json_encode($this->utilResponse);
            return;

        } else {

            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar actualizar el usuario. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;

        }
    }

    public function profile(){
        $this->render('user/profile', 'Perfil');
    }

    public function updateUserProfile()
    {
        $validation = UserValidations::validate($_POST, true);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        if(trim($_POST['txtContrasena']) != ""){
            $validation = UserValidations::validatePassword($_POST);
            if (!$validation->result) {
                echo json_encode($validation);
                return;
            }
        }

        $userModel = new User();
        $resultado = $userModel->updateUser($_POST['txtUsuario'], $_POST['txtNombreCompleto'], $_POST['txtCorreoElectronico'], $_POST['sltRol'], $_POST['txtIdUsuario']);
       
        if ($resultado != false) {

            if(trim($_POST['txtContrasena']) != ""){
                $contrasena = password_hash($_POST['txtContrasena'], PASSWORD_BCRYPT);
                $userModel->updatePassword($_POST['txtIdUsuario'],  $contrasena);
            }

            $user = $userModel->getUser($_POST['txtIdUsuario']);

            $_SESSION["role"] = $user->rol;
            $_SESSION["user"] = $user;

            $this->utilResponse->setResponse(true, 'Usuario actualizado con éxito.', null);
            echo json_encode($this->utilResponse);
            return;

        } else {

            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar actualizar el usuario. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;

        }
    }
    
}
