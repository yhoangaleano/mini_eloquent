<?php

namespace Mini\Libs;

//     ['date', 'Fecha Valida'], //PENDIENTE
//     ['file', 'Validación de archivo'], //PENDIENTE
//     ['image', 'Validación de Imagen'], CONTROLLER

class GeneratorSelects
{
    public static function simple()
    {
        $cValidations = '';
        $cValidations .= "\t\tif (empty(\$data[\$key])) {\n";
        $cValidations .= "\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' es obligatorio';\n";
        $cValidations .= "\t\t}";
        return $cValidations;
    }

    public static function multiple()
    {
        $cValidations = '';
        $cValidations .= "\t\tif (empty(\$data[\$key])) {\n";
        $cValidations .= "\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' es obligatorio';\n";
        $cValidations .= "\t\t}";
        return $cValidations;
    }

}