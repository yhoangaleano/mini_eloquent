<?php

namespace Mini\Controller;

use Mini\Model\Client;
use Mini\Core\Controller;
use Mini\Libs\Helper;
use Mini\Libs\UtilResponse;

use Mini\Validations\ClientValidations;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ClientController extends Controller
{
    public $utilResponse = null;

    public function __construct()
    {
        $this->utilResponse = new UtilResponse();
    }

    public function index()
    {
        $this->render('client/index', 'Clientes');
    }

    public function saveClient()
    {
        $validation = ClientValidations::validate($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $clientModel = new Client();
        $resultado = $clientModel->addClient(
            $_POST['txtDocumento'], 
            $_POST['txtNombreCompleto'], 
            $_POST['txtDireccion'], 
            $_POST['txtTelefonoFijo'], 
            $_POST['txtCelularPrincipal'], 
            $_POST['txtCelularAlternativo'], 
            $_POST['txtCorreoElectronico'],  
            $_POST['txtObservaciones']
        );
       
        if ($resultado != false) {

            $this->utilResponse->setResponse(true, 'Cliente guardado con éxito.', null);
            echo json_encode($this->utilResponse);
            return;

        } else {

            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar guardar el cliente. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;

        }
    }

    public function updateClient()
    {
        $validation = ClientValidations::validate($_POST, true);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $clientModel = new Client();
        $resultado = $clientModel->updateClient(
            $_POST['txtDocumento'], 
            $_POST['txtNombreCompleto'], 
            $_POST['txtDireccion'], 
            $_POST['txtTelefonoFijo'], 
            $_POST['txtCelularPrincipal'], 
            $_POST['txtCelularAlternativo'], 
            $_POST['txtCorreoElectronico'],  
            $_POST['txtObservaciones'],
            $_POST['txtIdCliente']
        );
       
        if ($resultado != false) {

            $this->utilResponse->setResponse(true, 'Cliente actualizado con éxito.', null);
            echo json_encode($this->utilResponse);
            return;

        } else {

            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar actualizar el cliente. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;

        }
    }

    public function listClients()
    {
        $clientModel = new Client();
        $clients = $clientModel->getAllClients();
        $this->utilResponse->setResponse(true, 'Clientes listados con éxito.', $clients);
        echo json_encode($this->utilResponse);
        return;
    }

    public function getClient()
    {
        $validation = ClientValidations::validateGetClient($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $clientModel = new Client();
        $client = $clientModel->getClient($_POST['txtIdCliente']);
        $this->utilResponse->setResponse(true, 'Cliente listado con éxito.', $client);
        echo json_encode($this->utilResponse);
        return;
    }

    public function changeStatus()
    {
        $validation = ClientValidations::validateChangeStatus($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $clientModel = new Client();
        $resultado = $clientModel->changeClientStatus($_POST['txtIdCliente'], $_POST['sltEstado']);
       
        if ($resultado != false) {

            $this->utilResponse->setResponse(true, 'Cliente actualizado con éxito.', null);
            echo json_encode($this->utilResponse);
            return;

        } else {

            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar actualizar el cliente. Por favor, verifique la información.', null);
            echo json_encode($this->utilResponse);
            return;

        }
    }
    
}
