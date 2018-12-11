<?php

namespace Mini\Validations;

use Mini\Libs\UtilResponse;
use DateTime;

class FilesValidations
{

    public static function validateOneImageFile($files, $key, $dataName){

        $utilResponse = new UtilResponse();

        if (isset($files[$key]['name']) && $files[$key]['error'] == 0) {

            $imageFileType = strtolower(pathinfo( basename($files[$key]["name"]) , PATHINFO_EXTENSION));
            
            // Compruebe si el archivo de imagen es una imagen real o una imagen falsa
            $check = getimagesize($files[$key]["tmp_name"]);
            if ($check == false) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' no contiene una imagen valida.';
            }

            // Comprobar el tamaño del archivo 5MB (5 * 1000 * 1000 o 5 * 1024 * 1024)
            /**
             *
             * define('KB', 1024);
             * define('MB', 1048576);
             * define('GB', 1073741824);
             * define('TB', 1099511627776);
             *
             */
            if ($files[$key]["size"] > 5000000) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es demasiado grande (máximo 5MB).';
            }

            // Limitar los formatos de archivo permitidos
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' sólo permite archivos JPG, JPEG, PNG y GIF.';
            }

        } else {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio.';
        }

        $isValid = count($utilResponse->errors) === 0;
        $utilResponse->validationsErrors = !$isValid;
        $utilResponse->setResponse($isValid);
        $utilResponse->data = $files;
        return $utilResponse;

    }

    public static function validateFileExist($files, $key, $dataName, $folderSave, $time){

        $utilResponse = new UtilResponse();

        $targetDir = UPLOADS_FOLDER.$folderSave."/";
        $pathSave = "uploads/".$folderSave."/";

        if (isset($files[$key]['name']) && $files[$key]['error'] == 0) {

            $fileName = $time.'_'.$files[$key]["name"];

            $targetFile = $targetDir . basename($fileName);
            $pathSave =  $pathSave .  basename($fileName);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            
            // Comprueba si la imagen existe
            if (file_exists($targetFile)) {
                $utilResponse->errors['fields'][] = $key;
                $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' ya existe con el mismo nombre en la carpeta en que se almacenara.';
            }

        } else {
            $utilResponse->errors['fields'][] = $key;
            $utilResponse->errors[$key][] = 'El campo ' . $dataName . ' es obligatorio.';
        }

        $isValid = count($utilResponse->errors) === 0;
        $utilResponse->validationsErrors = !$isValid;
        $utilResponse->setResponse($isValid);
        $utilResponse->data = $files;
        return $utilResponse;

    }

}
