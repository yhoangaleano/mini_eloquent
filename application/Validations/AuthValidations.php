<?php

namespace Mini\Validations;
use Mini\Libs\UtilResponse, DateTime;

class AuthValidations
{
    public static function validate($data, $update = false)
    {
        $utilResponse = new UtilResponse();

        $key = 'txtUsuario';
        $dataName = 'Usuario';
        if (empty($data[$key])) {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
        } else {
            if (strlen($data[$key]) < 4) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
            } else {
                $pattern = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]+$/';
                if (!preg_match($pattern, $data[$key])) {
                    $utilResponse->errors['fields'][] = $key;
                    $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener solo letras y espacios';
                }
            }
        }

        $key = 'txtContrasena';
        $dataName = 'Contraseña';
        if (empty($data[$key])) {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
        } else {
            if (strlen($data[$key]) < 6) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 6 letras como mínimo';
            } else {
                $pattern = '#[0-9]+#';
                if (!preg_match($pattern, $data[$key])) {
                    $utilResponse->errors['fields'][] = $key;
                    $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe incluir al menos un número';
                }else{
                    $pattern = '#[a-zA-Z]+#';
                    if (!preg_match($pattern, $data[$key])) {
                        $utilResponse->errors['fields'][] = $key;
                        $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe incluir al menos una letra';
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
}