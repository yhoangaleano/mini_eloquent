<?php

namespace Mini\Validations;

use Mini\Libs\UtilResponse;

use DateTime;

use Mini\Model\UserTest;

class UserTestValidations {

	public static function validate($data, $update = false)
	{
		$utilResponse = new UtilResponse();
		if ($update) {
			$key = 'idUsuario';
			$dataName = 'Código del Usuario';
			if (empty($data[$key])) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
			}
			else {
				if (!is_numeric($data[$key])) {
					$utilResponse->errors['fields'][] = $key;
					$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un número valido';
				}
			}
		}

		$key = 'usuario';
		$dataName = 'Usuario';
		if (empty($data[$key])) {
			$utilResponse->errors['fields'][] = $key;
			$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
		} else {
			if (strlen($data[$key]) < 4) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
			}
			if (strlen($data[$key]) > 45) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 45 letras como máximo';
			}
			if ($update) {
				$keyid = 'idUsuario';
				$alreadyExists = UserTest::where($key, $data[$key])->where('idUsuario', '!=', $data['idUsuario'])->first();
				if ($alreadyExists !== false) {
					$utilResponse->errors['fields'][] = $key;
					$utilResponse->errors[$key][] = 'El ' . $dataName . ' ya existe, por favor intenta con otro.';
				}
			} else {
				$alreadyExists = UserTest::where($key, $data[$key])->first();
				if ($alreadyExists !== false) {
					$utilResponse->errors['fields'][] = $key;
					$utilResponse->errors[$key][] = 'El ' . $dataName . ' ya existe, por favor intenta con otro.';
				}
			}
		}


		if ($update == false) {
			$key = 'contrasena';
			$dataName = 'Contraseña';
			if (empty($data[$key])) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
			} else {
				if (strlen($data[$key]) > 60) {
					$utilResponse->errors['fields'][] = $key;
					$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 60 letras como máximo';
				}
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
		} else if (!empty($data[$key])) {
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


		$key = 'nombreCompleto';
		$dataName = 'Nombre Completo';
		if (empty($data[$key])) {
			$utilResponse->errors['fields'][] = $key;
			$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
		} else {
			$pattern = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/';
			if (!preg_match($pattern, $data[$key])) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener solo letras y espacios';
			}
			if (strlen($data[$key]) < 4) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
			}
			if (strlen($data[$key]) > 60) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 60 letras como máximo';
			}
		}


		$key = 'correoElectronico';
		$dataName = 'Correo Electrónico';
		if (empty($data[$key])) {
			$utilResponse->errors['fields'][] = $key;
			$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
		} else {
			if (!filter_var($data[$key], FILTER_VALIDATE_EMAIL)) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un correo electrónico válido';
			}
			if (strlen($data[$key]) < 4) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
			}
			if (strlen($data[$key]) > 60) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 60 letras como máximo';
			}
			if ($update) {
				$keyid = 'idUsuario';
				$alreadyExists = UserTest::where($key, $data[$key])->where('idUsuario', '!=', $data['idUsuario'])->first();
				if ($alreadyExists !== false) {
					$utilResponse->errors['fields'][] = $key;
					$utilResponse->errors[$key][] = 'El ' . $dataName . ' ya existe, por favor intenta con otro.';
				}
			} else {
				$alreadyExists = UserTest::where($key, $data[$key])->first();
				if ($alreadyExists !== false) {
					$utilResponse->errors['fields'][] = $key;
					$utilResponse->errors[$key][] = 'El ' . $dataName . ' ya existe, por favor intenta con otro.';
				}
			}
		}


		$key = 'estado';
		$dataName = 'Estado';
		if (empty($data[$key])) {
			$utilResponse->errors['fields'][] = $key;
			$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
		} else {
			if (!is_numeric($data[$key])) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un número valido';
			}
		}


		$key = 'rol';
		$dataName = 'Rol';
		if (empty($data[$key])) {
			$utilResponse->errors['fields'][] = $key;
			$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
		} else {
			if (strlen($data[$key]) < 4) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
			}
			if (strlen($data[$key]) > 50) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 50 letras como máximo';
			}
		}


	}
}

