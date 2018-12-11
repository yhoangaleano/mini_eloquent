<?php

namespace Mini\Controller;

use Mini\Model\Service;
use Mini\Model\Log;

use Mini\Core\Controller;
use Mini\Libs\Helper;
use Mini\Libs\UtilResponse;

use \Exception;
use \PDOException;

use Mini\Validations\ServiceValidations;

class ServiceController extends Controller
{
    /**
     * Instancia del objeto de respuesta para todos los metodos que responde
     * el controlador.
     *
     */
    public $utilResponse = null;

    /**
     * Constructor
     * Inicializa el onjeto de respuesta que tienen todos los metodos 
     * que envian información al front-end.
     *
     */
    public function __construct()
    {
        $this->utilResponse = new UtilResponse();
    }

    /**
     * Metodo que se encarga de mostrar la vista de inicio.
     *
     */
    public function index()
    {
        $this->render('service/index', 'Servicios');
    }

    /**
     * Metodo que se encarga de devolver en json los servicios que se encuentran en la base de datos.
     *
     * Imprime el resultado de la respuesta - echo json_encode($this->utilResponse);
     * @return
     */
    public function list(){
        $services = Service::all();
        $this->utilResponse->setResponse(true, 'Servicios listados con éxito.', $services);
        echo json_encode($this->utilResponse);
        return;
    }

    /**
     * Crea un nuevo recurso y retorna el mensaje al frontend 
     *
     * Imprime el resultado de la respuesta - echo json_encode($this->utilResponse);
     * @return
     */
    public function store()
    {
        $validation = ServiceValidations::validate($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }
        
        $service = new Service;
        $service->nombreServicio = $_POST['txtNombreServicio'];
        $result = $service->save();

        if ($result != false) {

            $this->utilResponse->setResponse(true, 'Servicio guardado con éxito.', $result);
            echo json_encode($this->utilResponse);
            return;

        } else {

            $this->utilResponse->setResponse(false, 'Ocurrió un error al intentar guardar el servicio. Por favor, verifique la información.', $result);
            echo json_encode($this->utilResponse);
            return;

        }
    }

    /**
     * Actualiza un recurso en la base de datos
     * 
     * Trabaja con los datos que llegan por $_POST
     *
     */
    public function update()
    {
        $validation = ServiceValidations::validate($_POST, true);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $service = null;
        $idServicio = $_POST['txtIdServicio'];

        try {

            $service = Service::findOrFail($idServicio);
            $service->nombreServicio = $_POST['txtNombreServicio'];
            $result = $service->save();

            $this->utilResponse->setResponse(true, 'Servicio actualizado con éxito.', $result);
            echo json_encode($this->utilResponse);
            return;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $result = $logModel->addLog('No existe el servicio con el ID '. $idServicio, 'Service', $e->getCode(), $e->getMessage());
            $this->utilResponse->setResponse(false, 'No existe el servicio con el ID '. $idServicio, null);
            echo json_encode($this->utilResponse);
            return;
        }
    }

    /**
     * Cambie el estado de un recurso en especifico.
     *
     * Trabaja con los datos que llegan por $_POST
     * 
     */
    public function changeStatus()
    {
        $validation = ServiceValidations::validateChangeStatus($_POST);
        if (!$validation->result) {
            echo json_encode($validation);
            return;
        }

        $service = null;
        $idServicio = $_POST['txtIdServicio'];

        try {

            $service = Service::findOrFail($idServicio);
            $estado = $_POST['sltEstado'] == 1 ? 0 : 1;
            $service->estado = $estado;
            $result = $service->save();

            $this->utilResponse->setResponse(true, 'Servicio actualizado con éxito.', $result);
            echo json_encode($this->utilResponse);
            return;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $result = $logModel->addLog('No existe el servicio con el ID '. $idServicio, 'Service', $e->getCode(), $e->getMessage());
            $this->utilResponse->setResponse(false, 'No existe el servicio con el ID '. $idServicio, null);
            echo json_encode($this->utilResponse);
            return;
        }
    }
    
}
