<?php

namespace Mini\Validations;

use Mini\Libs\UtilResponse;

use DateTime;

use Mini\Model\Movie;

class MovieValidations {

	public static function validate($data, $update = false)
	{
		$utilResponse = new UtilResponse();
		if ($update) {
			$key = 'id';
			$dataName = 'Código de la Película';
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

		$key = 'director';
		$dataName = 'Código del director';
		if (empty($data[$key])) {
			$utilResponse->errors['fields'][] = $key;
			$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
		} else {
			if (!is_numeric($data[$key])) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un número valido';
			}
		}


		$key = 'describe';
		$dataName = 'Descripción';
		if (empty($data[$key])) {
			$utilResponse->errors['fields'][] = $key;
			$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
		} else {
			if (strlen($data[$key]) < 4) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
			}
			if (strlen($data[$key]) > 255) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 255 letras como máximo';
			}
		}


		$key = 'rate';
		$dataName = 'Calificación (1-5)';
		if (empty($data[$key])) {
			$utilResponse->errors['fields'][] = $key;
			$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
		} else {
			if (!is_numeric($data[$key])) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe ser un número valido';
			}
		}


		$key = 'title';
		$dataName = 'Titulo de la Pelicula';
		if (empty($data[$key])) {
			$utilResponse->errors['fields'][] = $key;
			$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio';
		} else {
			if (strlen($data[$key]) < 4) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 4 letras como mínimo';
			}
			if (strlen($data[$key]) > 60) {
				$utilResponse->errors['fields'][] = $key;
				$utilResponse->errors[$key][] = 'El campo ' . $dataName . ' debe contener 60 letras como máximo';
			}
		}


	}
}

