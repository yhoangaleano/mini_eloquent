<?php

namespace Mini\Controller;

use Mini\Model\Factory;
use Mini\Core\Controller;
use Mini\Libs\Helper;
use Mini\Libs\UtilResponse;

use Mini\Validations\FactoryValidations;
use Mini\Validations\FilesValidations;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class FactoryController extends Controller
{
    public $utilResponse = null;

    public function __construct()
    {
        $this->utilResponse = new UtilResponse();
    }

    public function index()
    {
        $this->render('factory/index', 'Mi Negocio - Información');
    }

    public function logo()
    {
        $factoryModel = new Factory();
        $factory = $factoryModel->getFactory();
        $this->render('factory/logo', 'Mi Negocio - Logo', array('factory' => $factory));
    }

    public function getFactory()
    {
        $factoryModel = new Factory();
        $result = $factoryModel->getFactory();
       
        if ($result != false) {
            $this->utilResponse->setResponse(true, 'Mi Negocio listado con éxito.', $result);
            echo json_encode($this->utilResponse);
            return;
        } else {
            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar listar Mi Negocio. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;
        }
    }

    public function saveFactory()
    {
        $validation = FactoryValidations::validate($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $validation = FilesValidations::validateOneImageFile($_FILES, 'txtLogo', 'Logo');
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $time = time();

        $infoUploads = Helper::uploadOnlyPhotos('factory', $_FILES, 'txtLogo', $time);
        if ($infoUploads['uploadOk'] != 0) {
            $factoryModel = new Factory();
            
            $result = $factoryModel->addFactory(
            $_POST['txtNombreEmpresa'],
            $_POST['txtRegimen'],
            $_POST['txtNIT'],
            $infoUploads['pathSave'],
            $_POST['txtDireccion'],
            $_POST['txtTelefono'],
            $_POST['txtCelular'],
            $_POST['txtCorreoElectronico'],
            $_POST['txtDescripcion'],
            $_POST['txtDescripcionPieFactura']
            );
       
            if ($result != false) {
                $this->utilResponse->setResponse(true, 'Mi Negocio ha sido guardado con éxito.', null);
                echo json_encode($this->utilResponse);
                return;
            } else {
                Helper::deletePhoto(PUBLIC_FOLDER.$infoUploads['pathSave']);
                $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar guardar mi negocio. Por favor, verifique la información.', null);
                echo json_encode($this->utilResponse);
                return;
            }
        } else {
            $this->utilResponse->setResponse(false, $infoUploads['message'], null);
            echo json_encode($this->utilResponse);
            return;
        }
    }

    public function updateFactory()
    {
        $keyLogo = 'txtLogo';
        $logoSend = false;
        $messageUpload = '';

        $validation = FactoryValidations::validate($_POST, true);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        if (isset($_FILES[$keyLogo]['name']) && $_FILES[$keyLogo]['error'] == 0) {
            $logoSend = true;

            $validation = FilesValidations::validateOneImageFile($_FILES, $keyLogo, 'Logo');
            if (!$validation->result) {
                echo json_encode($validation);
                return;
            }
        }

        $factoryModel = new Factory();
        $resultInfo = $factoryModel->updateFactory(
            $_POST['txtIdEmpresa'],
            $_POST['txtNombreEmpresa'],
            $_POST['txtRegimen'],
            $_POST['txtNIT'],
            $_POST['txtDireccion'],
            $_POST['txtTelefono'],
            $_POST['txtCelular'],
            $_POST['txtCorreoElectronico'],
            $_POST['txtDescripcion'],
            $_POST['txtDescripcionPieFactura']
        );

        if ($resultInfo != false && $logoSend != false) {
            $time = time();

            $infoUploads = Helper::uploadOnlyPhotos('factory', $_FILES, 'txtLogo', $time);

            if ($infoUploads['uploadOk'] != 0) {
                $resultFactory = $factoryModel->getFactory();
                
                $resultLogo = $factoryModel->updateFactoryLogo(
                    $_POST['txtIdEmpresa'],
                    $infoUploads['pathSave']
                );

                if ($resultLogo != false) {
                    Helper::deletePhoto(PUBLIC_FOLDER.$resultFactory->urlLogo);
                    $messageUpload = 'El Logo ha sido actualizado y subido correctamente.';
                } else {
                    Helper::deletePhoto(PUBLIC_FOLDER.$infoUploads['pathSave']);
                    $messageUpload = 'Ocurrió un error al intentar actualizar el Logo y se cancelo su carga.';
                }
            } else {
                $messageUpload = 'Ocurrió un error al intentar actualizar el Logo y se cancelo su carga. '. $infoUploads['message'];
            }

            $this->utilResponse->setResponse(true, 'La información de Mi Negocio se actualizo con éxito. '. $messageUpload, null);
            echo json_encode($this->utilResponse);
            return;
        } elseif ($resultInfo != false) {
            $this->utilResponse->setResponse(true, 'La información de Mi Negocio se actualizo con éxito. ', null);
            echo json_encode($this->utilResponse);
            return;
        } else {
            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar actualizar la información de mi negocio. Por favor, verifique la información. ', null);
            echo json_encode($this->utilResponse);
            return;
        }
    }

    public function updatingFactoryLogo()
    {
        $factoryModel = new Factory();
        $resultFactory = $factoryModel->getFactory();

        if ($resultFactory != false) {
            $keyLogo = 'txtLogo';

            $validation = FilesValidations::validateOneImageFile($_FILES, $keyLogo, 'Logo');
            if (!$validation->result) {
                echo json_encode($validation);
                return;
            }

            $time = time();

            $infoUploads = Helper::uploadOnlyPhotos('factory', $_FILES, $keyLogo, $time);

            if ($infoUploads['uploadOk'] != 0) {
                
                $resultLogo = $factoryModel->updateFactoryLogo(
                $_POST['txtIdEmpresa'],
                $infoUploads['pathSave']
                );

                if ($resultLogo != false) {

                    Helper::deletePhoto(PUBLIC_FOLDER.$resultFactory->urlLogo);

                    $this->utilResponse->setResponse(true, 'El Logo ha sido actualizado y subido correctamente.', null);
                    echo json_encode($this->utilResponse);
                    return;

                } else {
                    
                    Helper::deletePhoto(PUBLIC_FOLDER.$infoUploads['pathSave']);

                    $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar actualizar el Logo y se cancelo su carga.', null);
                    echo json_encode($this->utilResponse);
                    return;
                }

            } else {

                $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar actualizar el Logo y se cancelo su carga.', null);
                echo json_encode($this->utilResponse);
                return;
            }

        } else {
            $this->utilResponse->setResponse(false, 'No se puede actualizar el Logo, la información de Mi Negocio es requerida antes de poder cargar cualquier imagen. Por favor, verifique la información. ', null);
            echo json_encode($this->utilResponse);
            return;
        }
    }
}
