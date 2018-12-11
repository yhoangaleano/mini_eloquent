<?php

namespace Mini\Validations;

use Mini\Libs\UtilResponse;
use DateTime;

class ServiceValidations
{
    public static function validate($data, $update = false)
    {
        $utilResponse = new UtilResponse();
        if ($update) {
            $key = 'txtIdServicio';
            $dataName = 'Código del servicio';
            if (empty($data[$key])) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
            } else {
                if (!is_numeric($data[$key])) {
                    $utilResponse->errors['fields'][] = $key;
                    $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un número valido';
                }
            }
        }

        $key = 'txtNombreServicio';
        $dataName = 'Nombre del servicio';
        if (empty($data[$key])) {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
        } else {
            if (strlen($data[$key]) < 4) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
            } else {
                $pattern = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/';
                if (!preg_match($pattern, $data[$key])) {
                    $utilResponse->errors['fields'][] = $key;
                    $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener solo letras y espacios';
                }
            }
        }

        $isValid = count($utilResponse->errors) === 0;
        $utilResponse->validationsErrors = !$isValid;
        $utilResponse->setResponse($isValid);
        $utilResponse->data = $data;
        return $utilResponse;
    }

    public static function validateChangeStatus($data, $update = false)
    {
        $utilResponse = new UtilResponse();
        $key = 'txtIdServicio';
        $dataName = 'Código del servicio';
        if (empty($data[$key])) {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
        } else {
            if (!is_numeric($data[$key])) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un número valido';
            }
        }

        $key = 'sltEstado';
        $dataName = 'Estado';
        if (!isset($data[$key])) {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
        } else {
            if (!is_numeric($data[$key])) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un número valido';
            }
        }

        $isValid = count($utilResponse->errors) === 0;
        $utilResponse->validationsErrors = !$isValid;
        $utilResponse->setResponse($isValid);
        $utilResponse->data = $data;
        return $utilResponse;
    }
}
