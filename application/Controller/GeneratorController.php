<?php

namespace Mini\Controller;

use Mini\Model\Generator;
use Mini\Model\Log;
use Mini\Core\Controller;
use Mini\Libs\Helper;
use Mini\Libs\UtilResponse;
use Mini\Libs\GeneratorValidations;

use \Exception;
use \PDOException;

class GeneratorController extends Controller
{
    public $utilResponse = null;
    public $generatorModel = null;

    /**
     * Constructor
     * Inicializa el objeto de respuesta que tienen todos los metodos 
     * que envian información al front-end.
     * 
     * Ademas inicializa la cadena de conexión
     * para que la información de las tablas se puedan ver
     *
     */
    public function __construct()
    {
        $this->utilResponse = new UtilResponse();
        $this->generatorModel = new Generator();
    }
    
    public function getTables()
    {
        $tables = $this->generatorModel->getTables();
        $this->utilResponse->setResponse(true, 'Tablas listadas con éxito.', $tables);
        echo json_encode($this->utilResponse);
        return;
    }

    public function getColumns()
    {
        $columns = $this->generatorModel->getColumns($_POST['table']);
        $this->utilResponse->setResponse(true, 'Columnas listadas con éxito.', $columns);
        echo json_encode($this->utilResponse);
        return;
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $this->render('generator/index', 'Generador');
    }

    public function create()
    {
        $this->createModel($_POST['table'], $_POST['componentName'], $_POST['primaryKey'], $_POST['fillables'], $_POST['incrementing'], $_POST['keyType']);
        $this->createValidation($_POST['table'], $_POST['componentName'], $_POST['primaryKey'], $_POST['labelPrimaryKey'], $_POST['forms'], $_POST['incrementing'], $_POST['keyType']);
        exit();
    }

    public function createModel($table, $componentName, $primaryKey, $fillable, $incrementing, $keyType){		
        
        $cModel = "";
        $cModel .= "<?php\n\n";
        $cModel .= "namespace Mini\Model;\n\n";
        $cModel .= "use \Illuminate\Database\Eloquent\Model;\n\n";
		$cModel .= "\tclass ".$componentName." extends Model {\n\n";
        $cModel .= "\t\tprotected \$table = '".$table."';\n";
        $cModel .= "\t\tprotected \$primaryKey = '".$primaryKey."';\n";

        if($incrementing == '0'){
            $cModel .= "\t\tprotected \$incrementing = false;\n";
        }

        if($keyType == 'string'){
            $cModel .= "\t\tprotected \$keyType = '".$keyType."';\n";
        }

        $cModel .= "\t\tprotected \$fillable = [\n";
        
        foreach ($fillable as $value) {
            $cModel .= "\t\t\t'".$value."',\n";
        }

        $cModel .= "\t\t];\n\n";

		$cModel .= "\t}\n";
        
        try
        {
			$archivo=fopen(APP.'Model/'.ucwords($componentName).'.php','w');//abrir archivo, nombre archivo, modo apertura
			fwrite($archivo, $cModel);
			fclose($archivo); //Cierro el archivo
            return true;
            
        }catch(Excpetion $e)
        {
			return false;
		}
    }
    
    public function createValidation($table, $componentName, $primaryKey, $labelPrimaryKey, $forms, $incrementing, $keyType){		
        
        // Encabezado del archivo
        $cValidations = "";
        $cValidations .= "<?php\n\n";
        $cValidations .= "namespace Mini\Validations;\n\n";
        $cValidations .= "use Mini\Libs\UtilResponse;\n\n";
        $cValidations .= "use DateTime;\n\n";
        $cValidations .= "use Mini\Model\\".ucwords($componentName).";\n\n";
        // Fin del encabezado del archivo

        // Creación de la clase
        $cValidations .= "class ".ucwords($componentName)."Validations {\n\n";
            
        // Creación del metodo principal de validaciones
        $cValidations .= "\tpublic static function validate(\$data, \$update = false)\n";
        $cValidations .= "\t{\n";

        $cValidations .= "\t\t\$utilResponse = new UtilResponse();\n";

        //Vaidación de la primary key en los update
        $cValidations .= "\t\tif (\$update) {\n";
        $cValidations .= "\t\t\t\$key = '".$primaryKey."';\n";
        $cValidations .= "\t\t\t\$dataName = '".$labelPrimaryKey."';\n";
        $cValidations .= "\t\t\tif (empty(\$data[\$key])) {\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
        $cValidations .= "\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' es obligatorio';\n";
        $cValidations .= "\t\t\t}\n";

        //Validación de numerico si el campo es autoincrementable y int
        if($incrementing == '1' && $keyType == 'int'){

            $cValidations .= "\t\t\telse {\n";
            $cValidations .= "\t\t\t\tif (!is_numeric(\$data[\$key])) {\n";
            $cValidations .= "\t\t\t\t\t\$utilResponse->errors['fields'][] = \$key;\n";
            $cValidations .= "\t\t\t\t\t\$utilResponse->errors[\$key][] = 'El campo ' . \$dataName . ' debe ser un número valido';\n";
            $cValidations .= "\t\t\t\t}\n";
            $cValidations .= "\t\t\t}\n";

        }
        //Fin de Validación de numerico si el campo es autoincrementable y int

        $cValidations .= "\t\t}\n\n";
        //Fin de la validación de la primary key

        foreach ($forms as $value) {

            if ( isset($value['validations']) ) {

                if (in_array('password', $value['validations']) ) {
                    $cValidations .= "\t\tif (\$update == false) {\n";
                }

                $cValidations .= "\t\t\$key = '".$value['column']."';\n";
                $cValidations .= "\t\t\$dataName = '".$value['label']."';\n";

                if (in_array('required', $value['validations'])) {
                    $cValidations .= GeneratorValidations::required();
                    $cValidations .= " else {\n";
                } else {
                    $cValidations .= "\t\tif (!empty(\$data[\$key])) {\n";
                }

                $value['validations'] = array_diff($value['validations'], ['required']);

                if (in_array('password', $value['validations']) && in_array('min', $value['validations'])) {
                    $value['validations'] = array_diff($value['validations'], ['min']);
                }

                foreach ($value['validations'] as $validation) {
                    
                    if(method_exists('Mini\Libs\GeneratorValidations',$validation)){

                        if($validation== 'max'){
                            $info = $this->generatorModel->getSizeLength($table, $value['column']);
                            $cValidations .= GeneratorValidations::$validation($info->character_maximum_length);
                        }else if($validation == 'unique'){
                            $cValidations .= GeneratorValidations::$validation($componentName, $primaryKey);
                        } else{
                            $cValidations .= GeneratorValidations::$validation();
                        }
                        
                    }
                }

                if (in_array('required', $value['validations'])) {
                    $cValidations .= "\t\t}\n";
                } else {
                    $cValidations .= "\t\t}\n";
                }

                if (in_array('password', $value['validations']) ) {
                    $cValidations .= "\t\t}";
                    $cValidations .= GeneratorValidations::password_not_empty();

                }

                $cValidations .= "\n\n";
                
            }
        }
        
        $cValidations .= "\t}\n";
        // Fin de la Creación del metodo principal de validaciones

        $cValidations .= "}\n\n";
        //Fin de la clase
        
        try
        {
			$archivo=fopen(APP.'Validations/'.ucwords($componentName).'Validations.php','w');//abrir archivo, nombre archivo, modo apertura
			fwrite($archivo, $cValidations);
			fclose($archivo); //Cierro el archivo
            return true;
            
        }catch(Excpetion $e)
        {
			return false;
		}
    }
    
    public function createViews($table, $componentName, $primaryKey, $fillable){
        
        $cModel = "";
        $cModel .= "<?php\n\n";
        $cModel .= "namespace Mini\Model;\n\n";
        $cModel .= "use \Illuminate\Database\Eloquent\Model;\n\n";
		$cModel .= "\tclass ".$componentName." extends Model {\n\n";
        $cModel .= "\t\tprotected \$table = '".$table."';\n";
		$cModel .= "\t\tprotected \$primaryKey = '".$primaryKey."';\n";
        $cModel .= "\t\tprotected \$fillable = [\n";
        
        foreach ($fillable as $value) {
            $cModel .= "\t\t\t'".$value."',\n";
        }

        $cModel .= "\t\t];\n\n";

		$cModel .= "\t}\n";
        
        try
        {
			$archivo=fopen(APP.'Model/'.ucwords($componentName).'.php','w');//abrir archivo, nombre archivo, modo apertura
			fwrite($archivo, $cModel);
			fclose($archivo); //Cierro el archivo
            return true;
            
        }catch(Excpetion $e)
        {
			return false;
		}
    
    
    }
    
    public function createJS($table, $componentName, $primaryKey, $fillable){		
        
        $cModel = "";
        $cModel .= "<?php\n\n";
        $cModel .= "namespace Mini\Model;\n\n";
        $cModel .= "use \Illuminate\Database\Eloquent\Model;\n\n";
		$cModel .= "\tclass ".$componentName." extends Model {\n\n";
        $cModel .= "\t\tprotected \$table = '".$table."';\n";
		$cModel .= "\t\tprotected \$primaryKey = '".$primaryKey."';\n";
        $cModel .= "\t\tprotected \$fillable = [\n";
        
        foreach ($fillable as $value) {
            $cModel .= "\t\t\t'".$value."',\n";
        }

        $cModel .= "\t\t];\n\n";

		$cModel .= "\t}\n";
        
        try
        {
			$archivo=fopen(APP.'Model/'.ucwords($componentName).'.php','w');//abrir archivo, nombre archivo, modo apertura
			fwrite($archivo, $cModel);
			fclose($archivo); //Cierro el archivo
            return true;
            
        }catch(Excpetion $e)
        {
			return false;
		}
    }
    
    public function createController($table, $componentName, $primaryKey, $fillable){		
        
        $cModel = "";
        $cModel .= "<?php\n\n";
        $cModel .= "namespace Mini\Model;\n\n";
        $cModel .= "use \Illuminate\Database\Eloquent\Model;\n\n";
		$cModel .= "\tclass ".$componentName." extends Model {\n\n";
        $cModel .= "\t\tprotected \$table = '".$table."';\n";
		$cModel .= "\t\tprotected \$primaryKey = '".$primaryKey."';\n";
        $cModel .= "\t\tprotected \$fillable = [\n";
        
        foreach ($fillable as $value) {
            $cModel .= "\t\t\t'".$value."',\n";
        }

        $cModel .= "\t\t];\n\n";

		$cModel .= "\t}\n";
        
        try
        {
			$archivo=fopen(APP.'Model/'.ucwords($componentName).'.php','w');//abrir archivo, nombre archivo, modo apertura
			fwrite($archivo, $cModel);
			fclose($archivo); //Cierro el archivo
            return true;
            
        }catch(Excpetion $e)
        {
			return false;
		}
	}
}
