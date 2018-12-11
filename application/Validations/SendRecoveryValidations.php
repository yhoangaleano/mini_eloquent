<?php

namespace Mini\Validations;
use Mini\Libs\UtilResponse, DateTime;

class SendRecoveryValidations
{
    public static function validate($data, $update = false)
    {
        $utilResponse = new UtilResponse();

        $key = 'txtCorreoElectronico';
        $dataName = 'Correo Electrónico';
        if (empty($data[$key])) {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
        } else {
            if (strlen($data[$key]) < 4) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
            } else {
                if (!filter_var($data[$key], FILTER_VALIDATE_EMAIL)) {
                    $utilResponse->errors['fields'][] = $key;
                    $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un correo electrónico válido';
                }
            }
        }

        $isValid = count($utilResponse->errors) === 0;
        $utilResponse->validationsErrors = !$isValid;
        $utilResponse->setResponse($isValid);
        $utilResponse->data = $data;
        return $utilResponse;
    }
}