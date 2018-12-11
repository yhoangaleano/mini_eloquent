<?php

namespace Mini\Validations;

use Mini\Libs\UtilResponse;
use DateTime;

class NewPasswordValidations
{
    public static function validate($data, $update = false)
    {
        $utilResponse = new UtilResponse();

        $key = 'txtIdUsuario';
        $dataName = 'Código del usuario';
        if (empty($data[$key])) {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
        } else {
            if (!is_numeric($data[$key])) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un número valido';
            }
        }

        $key = 'txtCode';
        $dataName = 'Código de verificación';
        if (empty($data[$key])) {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
        } else {
            if (strlen($data[$key]) < 8) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
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
                } else {
                    $pattern = '#[a-zA-Z]+#';
                    if (!preg_match($pattern, $data[$key])) {
                        $utilResponse->errors['fields'][] = $key;
                        $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe incluir al menos una letra';
                    }
                }
            }
        }

        $key = 'txtRepetirContrasena';
        $dataName = 'Repetir Contraseña';
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
                } else {
                    $pattern = '#[a-zA-Z]+#';
                    if (!preg_match($pattern, $data[$key])) {
                        $utilResponse->errors['fields'][] = $key;
                        $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe incluir al menos una letra';
                    }else{
                        $contrasenaKey = "txtContrasena";
                        if($data[$key] != $data[$contrasenaKey]){
                            $utilResponse->errors['fields'][] = $key;
                            $utilResponse->errors[$key][] = 'Las contraseñas no coinciden';
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
}
