<?php

namespace Mini\Libs;

//     ['date', 'Fecha Valida'], //PENDIENTE
//     ['file', 'Validación de archivo'], //PENDIENTE
//     ['image', 'Validación de Imagen'], CONTROLLER

class GeneratorValidations
{
    public static function required()
    {
        $cValidations = '';
        $cValidations .= "\t\tif (empty(\$data[\$key])) {\n";
        $cValidations .= "\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' es obligatorio';\n";
        $cValidations .= "\t\t}";
        return $cValidations;
    }

    public static function min()
    {
        $cValidations = '';
        $cValidations .= "\t\t\tif (strlen(\$data[\$key]) < 4) {\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe contener 4 letras como mínimo';\n";
        $cValidations .= "\t\t\t}\n";
        return $cValidations;
    }

    public static function max($size)
    {
        $cValidations = '';
        $cValidations .= "\t\t\tif (strlen(\$data[\$key]) > ".$size.") {\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe contener ".$size." letras como máximo';\n";
        $cValidations .= "\t\t\t}\n";
        return $cValidations;
    }

    public static function number()
    {
        $cValidations = '';
        $cValidations .= "\t\t\tif (!is_numeric(\$data[\$key])) {\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe ser un número valido';\n";
        $cValidations .= "\t\t\t}\n";
        return $cValidations;
    }

    public static function only_letters()
    {
        $cValidations = '';
        $cValidations .= "\t\t\t\$pattern = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/';\n";
        $cValidations .= "\t\t\tif (!preg_match(\$pattern, \$data[\$key])) {\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe contener solo letras y espacios';\n";
        $cValidations .= "\t\t\t}\n";
        return $cValidations;
    }

    public static function email()
    {
        $cValidations = '';
        $cValidations .= "\t\t\tif (!filter_var(\$data[\$key], FILTER_VALIDATE_EMAIL)) {\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe ser un correo electrónico válido';\n";
        $cValidations .= "\t\t\t}\n";
        return $cValidations;
    }

    public static function password(){

        $cValidations = '';
        $cValidations .= "\t\t\tif (strlen(\$data[\$key]) < 6) {\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe contener 6 letras como mínimo';\n";
        $cValidations .= "\t\t\t} else {\n";
        $cValidations .= "\t\t\t\t\$pattern = '#[0-9]+#';\n";
        $cValidations .= "\t\t\t\tif (!preg_match(\$pattern, \$data[\$key])) {\n";
        $cValidations .= "\t\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe incluir al menos un número';\n";
        $cValidations .= "\t\t\t\t } else {\n";
        $cValidations .= "\t\t\t\t\t\$pattern = '#[a-zA-Z]+#';\n";
        $cValidations .= "\t\t\t\t\tif (!preg_match(\$pattern, \$data[\$key])) {\n";
        $cValidations .= "\t\t\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe incluir al menos una letra';\n";
        $cValidations .= "\t\t\t\t\t}\n";
        $cValidations .= "\t\t\t\t}\n";
        $cValidations .= "\t\t\t}\n";
        return $cValidations;


    }

    public static function password_not_empty(){

        $cValidations = '';
        $cValidations .= " else if (!empty(\$data[\$key])) {\n";
        $cValidations .= "\t\t\tif (strlen(\$data[\$key]) < 6) {\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe contener 6 letras como mínimo';\n";
        $cValidations .= "\t\t\t} else {\n";
        $cValidations .= "\t\t\t\t\$pattern = '#[0-9]+#';\n";
        $cValidations .= "\t\t\t\tif (!preg_match(\$pattern, \$data[\$key])) {\n";
        $cValidations .= "\t\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe incluir al menos un número';\n";
        $cValidations .= "\t\t\t\t } else {\n";
        $cValidations .= "\t\t\t\t\t\$pattern = '#[a-zA-Z]+#';\n";
        $cValidations .= "\t\t\t\t\tif (!preg_match(\$pattern, \$data[\$key])) {\n";
        $cValidations .= "\t\t\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe incluir al menos una letra';\n";
        $cValidations .= "\t\t\t\t\t}\n";
        $cValidations .= "\t\t\t\t}\n";
        $cValidations .= "\t\t\t}\n";
        $cValidations .= "\t\t}\n";
        return $cValidations;

    }

    public static function unique($componentName, $primaryKey){
    
        $cValidations = '';
        $cValidations .= "\t\t\tif (\$update) {\n";
        $cValidations .= "\t\t\t\t\$keyid = '".$primaryKey."';\n";
        $cValidations .= "\t\t\t\t\$alreadyExists = ".$componentName."::where(\$key, \$data[\$key])->where('".$primaryKey."', '!=', \$data['".$primaryKey."'])->first();\n";
        $cValidations .= "\t\t\t\tif (\$alreadyExists !== false) {\n";
        $cValidations .= "\t\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\t\$utilResponse->errors[\$key][] = 'El ' . \$dataName . ' ya existe, por favor intenta con otro.';\n";
        $cValidations .= "\t\t\t\t}\n";
        $cValidations .= "\t\t\t} else {\n";
        $cValidations .= "\t\t\t\t\$alreadyExists = ".$componentName."::where(\$key, \$data[\$key])->first();\n";
        $cValidations .= "\t\t\t\tif (\$alreadyExists !== false) {\n";
        $cValidations .= "\t\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\t\$utilResponse->errors[\$key][] = 'El ' . \$dataName . ' ya existe, por favor intenta con otro.';\n";
        $cValidations .= "\t\t\t\t}\n";
        $cValidations .= "\t\t\t}\n";
        return $cValidations;
        
    }

}