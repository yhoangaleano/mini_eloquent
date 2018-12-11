<?php

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Model\Log;
use Mini\Libs\Helper;
use \Exception;
use \PDOException;

class Generator extends Model
{
    /**
     * Obtener todas las tablas de la base de datos
     */
    public function getTables()
    {
        $sql = "SHOW TABLES";

        try {

            $query = $this->db->query($sql);
            return $query->fetchAll(\PDO::FETCH_COLUMN);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql);
            $logModel->addLog($sql, 'Generator', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql);
            $logModel->addLog($sql, 'Generator', $e->getCode(), $e->getMessage());
            return false;
        }        
    }

    /**
     * Lista las columnas de la tabla que se pasa como parametro
     * @param string $table Nombre de la tabla para mostrar columnas
     */
    public function getColumns($table)
    {
        $sql = "SHOW COLUMNS FROM ".DB_NAME.".".$table;

        try {

            $query = $this->db->query($sql);
            return $query->fetchAll();

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql);
            $logModel->addLog($sql, 'Generator', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql);
            $logModel->addLog($sql, 'Generator', $e->getCode(), $e->getMessage());
            return false;
        }        
    }

    /**
     * Tamaño del campo para la validación de max
     * @param string $table Nombre de la tabla para mostrar columnas
     * @param string $column Nombre de la columna para saber el tamaño
     * 
     */
    public function getSizeLength($table, $column)
    {
        $sql = "SELECT column_name, character_maximum_length FROM information_schema.columns WHERE table_schema = '". DB_NAME ."' AND table_name = '".$table."' AND column_name = '".$column."'";

        try {

            $query = $this->db->query($sql);
            return $query->fetch();

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql);
            $logModel->addLog($sql, 'Generator', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql);
            $logModel->addLog($sql, 'Generator', $e->getCode(), $e->getMessage());
            return false;
        }        
    }

    
}
