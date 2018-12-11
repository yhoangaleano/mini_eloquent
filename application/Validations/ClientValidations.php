<?php

namespace Mini\Validations;

use Mini\Libs\UtilResponse;
use DateTime;
use Mini\Model\Client;

class ClientValidations
{
    public static function validate($data, $update = false)
    {
        $utilResponse = new UtilResponse();
        if ($update) {
            $key = 'txtIdCliente';
            $dataName = 'Código del cliente';
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

        $key = 'txtNombreCompleto';
        $dataName = 'Nombre Completo';
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

        $key = 'txtTelefonoFijo';
        $dataName = 'Teléfono Fijo';
        if (empty($data[$key])) {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
        } else {
            if (strlen($data[$key]) < 4) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
            }
        }

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
                } else {
                    if ($update) {
                        $keyIdCliente = 'txtIdCliente';
                        $clientModel = new Client();
                        $clientEmailAlreadyExists = $clientModel->validateEmailUpdate($data[$key], $data[$keyIdCliente]);
                        if ($clientEmailAlreadyExists !== false) {
                            $utilResponse->errors['fields'][] = $key;
                            $utilResponse->errors[$key][] = 'El ' . $dataName . ' ya existe, por favor intenta con otro.';
                        }
                    } else {
                        $clientModel = new Client();
                        $clientEmailAlreadyExists = $clientModel->validateEmail($data[$key]);
                        if ($clientEmailAlreadyExists !== false) {
                            $utilResponse->errors['fields'][] = $key;
                            $utilResponse->errors[$key][] = 'El ' . $dataName . ' ya existe, por favor intenta con otro.';
                        }
                    }
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
        $key = 'txtIdCliente';
        $dataName = 'Código del cliente';
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

    public static function validateGetClient($data, $update = false)
    {
        $utilResponse = new UtilResponse();
        
        $key = 'txtIdCliente';
        $dataName = 'Código del cliente';
        if (empty($data[$key])) {
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
