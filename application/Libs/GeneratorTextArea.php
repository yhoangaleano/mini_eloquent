<?php

namespace Mini\Libs;

//     ['date', 'Fecha Valida'], //PENDIENTE
//     ['file', 'Validación de archivo'], //PENDIENTE
//     ['image', 'Validación de Imagen'], CONTROLLER

class GeneratorTextArea
{
    public static function textarea()
    {
        $cValidations = '';
        $cValidations .= "\t\tif (empty(\$data[\$key])) {\n";
        $cValidations .= "\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' es obligatorio';\n";
        $cValidations .= "\t\t}";
        return $cValidations;
    }

}