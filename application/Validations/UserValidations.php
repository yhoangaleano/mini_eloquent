<?php

namespace Mini\Validations;

use Mini\Libs\UtilResponse;
use DateTime;
use Mini\Model\User;

class UserValidations
{
    public static function validate($data, $update = false)
    {
        $utilResponse = new UtilResponse();
        if ($update) {
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
        }

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
                } else {
                    if ($update) {
                        $keyIdUsuario = 'txtIdUsuario';
                        $userModel = new User();
                        $userAlreadyExists = $userModel->validateUserUpdate($data[$key], $data[$keyIdUsuario]);
                        if ($userAlreadyExists !== false) {
                            $utilResponse->errors['fields'][] = $key;
                            $utilResponse->errors[$key][] = 'El ' . $dataName . ' ya existe, por favor intenta con otro.';
                        }
                    } else {
                        $userModel = new User();
                        $userAlreadyExists = $userModel->validateUser($data[$key]);
                        if ($userAlreadyExists !== false) {
                            $utilResponse->errors['fields'][] = $key;
                            $utilResponse->errors[$key][] = 'El ' . $dataName . ' ya existe, por favor intenta con otro.';
                        }
                    }
                }
            }
        }

        if ($update == false) {
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

        $key = 'sltRol';
        $dataName = 'Rol del usuario';
        if (empty($data[$key])) {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
        } else {
            if (strlen($data[$key]) < 4) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
            } else {
                if ($data[$key] != VENDEDOR && $data[$key] != ADMINISTRADOR) {
                    $utilResponse->errors['fields'][] = $key;
                    $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un rol válido.';
                }
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
                        $keyIdUsuario = 'txtIdUsuario';
                        $userModel = new User();
                        $userAlreadyExists = $userModel->validateEmailUpdate($data[$key], $data[$keyIdUsuario]);
                        if ($userAlreadyExists !== false) {
                            $utilResponse->errors['fields'][] = $key;
                            $utilResponse->errors[$key][] = 'El ' . $dataName . ' ya existe, por favor intenta con otro.';
                        }
                    } else {
                        $userModel = new User();
                        $userAlreadyExists = $userModel->validateEmail($data[$key]);
                        if ($userAlreadyExists !== false) {
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

    public static function validatePassword($data)
    {
        $utilResponse = new UtilResponse();

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

        $isValid = count($utilResponse->errors) === 0;
        $utilResponse->validationsErrors = !$isValid;
        $utilResponse->setResponse($isValid);
        $utilResponse->data = $data;
        return $utilResponse;
    }
}
