<?php

namespace Mini\Libs;

class UtilResponse
{
    // Esta variable va contener todos los datos ya sean: un objeto, una lista, un numero que nosotros le queramos responder al cliente
    public $data = null;
    // Va a responder con true o false para identificar si la petición se hizo correctamente o si ocurrio algún error 
    public $result = false;
    // Vamos a responder mensajes apropiados para cada error o cada situación
    public $message = '';
    // Array que contiene todos los errores que sucedieron durante la petición.
    public $errors = [];
    // Esta variable permite identificar si con la respuesta se debe redireccionar
    public $redirect = null;
    // Esta variable va contener la url a donde se debe redireccionar
    public $urlRedirect = null;
    // Esta variable va contener la url a donde se debe redireccionar
    public $validationsErrors = false;

    /**
     * Establece la respuesta para ser enviada al controlador
     * @param string $result true si la respuesta se cumplio o false para informar de que hubo errores
     * @param string $message Mensaje que se mostrara en el cliente
     * @param string $data datos que se pasaran al cliente
     */
    public function setResponse($result, $message = '', $data = null){
        
        $this->result = $result;
        $this->message = $message;
        $this->data = $data;
        
        if($result == false && $message == ''){
            $this->message = 'Ocurrió un error inesperado, por favor verifique los datos enviados';
        }
        return $this;
    }
}