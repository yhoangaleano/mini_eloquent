<?php

namespace Mini\Libs;

class GeneratorInputs
{
    public static function text()
    {
        $cValidations = '';
        $cValidations .= "\t\tif (empty(\$data[\$key])) {\n";
        $cValidations .= "\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' es obligatorio';\n";
        $cValidations .= "\t\t}";
        return $cValidations;
    }

    public static function password()
    {
        $cValidations = '';
        $cValidations .= "\t\tif (empty(\$data[\$key])) {\n";
        $cValidations .= "\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' es obligatorio';\n";
        $cValidations .= "\t\t}";
        return $cValidations;
    }

}