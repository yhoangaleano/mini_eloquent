<?php

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Model\Log;
use Mini\Libs\Helper;
use \Exception, \PDOException;

class Factory extends Model
{
    /**
     * Obtener la información de la empresa
     */
    public function getFactory()
    {
        $sql = "SELECT idEmpresa, nombreEmpresa, regimen, NIT, urlLogo, direccion, telefono, celular, correoElectronico, descripcion, descripcionPieFactura FROM tblEmpresa LIMIT 1";

        try {

            $query = $this->db->prepare($sql);
            $query->execute();
            return ($query->rowcount() ? $query->fetch() : false);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * Actualizar un información de la empresa
     * @param string $p_idEmpresa id de la empresa que se actualizara 
     * @param string $p_nombreEmpresa Nombre de la empresa 
     * @param string $p_regimen Regimen con el que la empresa trabaja
     * @param string $p_NIT NIT de la empresa
     * @param string $p_direccion Dirección de la empresa
     * @param string $p_telefono Teléfono de la empresa
     * @param string $p_celular Celular de la empresa
     * @param string $p_correoElectronico Correo Electrónico de la empresa
     * @param string $p_descripcion Descripción de la empresa (que hace la empresa)
     * @param string $p_descripcionPieFactura Descripción del pie de página de la factura
     */
    public function updateFactory($p_idEmpresa, $p_nombreEmpresa, $p_regimen, $p_NIT, $p_direccion, $p_telefono, $p_celular, $p_correoElectronico, $p_descripcion, $p_descripcionPieFactura)
    {
        $sql = "UPDATE tblEmpresa SET nombreEmpresa = :p_nombreEmpresa,
        regimen = :p_regimen,
        NIT = :p_NIT,
        direccion = :p_direccion,
        telefono = :p_telefono,
        celular = :p_celular,
        correoElectronico = :p_correoElectronico,
        descripcion = :p_descripcion,
        descripcionPieFactura = :p_descripcionPieFactura
        WHERE idEmpresa = :p_idEmpresa";
        $parameters = array(
            ':p_nombreEmpresa' => $p_nombreEmpresa,
            ':p_regimen' => $p_regimen,
            ':p_NIT' => $p_NIT,
            ':p_direccion' => $p_direccion,
            ':p_telefono' => $p_telefono,
            ':p_celular' => $p_celular,
            ':p_correoElectronico' => $p_correoElectronico,
            ':p_descripcion' => $p_descripcion,
            ':p_descripcionPieFactura' => $p_descripcionPieFactura,
            ':p_idEmpresa' => $p_idEmpresa
        );

        try {

            $query = $this->db->prepare($sql);
            return $query->execute($parameters);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * Actualizar un logo de la empresa
     * @param string $p_idEmpresa id de la empresa que se actualizara 
     * @param string $p_urlLogo Logo de la empresa
     */
    public function updateFactoryLogo($p_idEmpresa, $p_urlLogo)
    {
        $sql = "UPDATE tblEmpresa SET urlLogo = :p_urlLogo
        WHERE idEmpresa = :p_idEmpresa";
        $parameters = array(
            ':p_urlLogo' => $p_urlLogo,
            ':p_idEmpresa' => $p_idEmpresa
        );

        try {

            $query = $this->db->prepare($sql);
            return $query->execute($parameters);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;
        }
    }


    /**
     * Agregar un usuario a la base de datos
     * 
     * 
     * Por favor, tenga en cuenta que no es necesario "limpiar" 
     * nuestra entrada de ninguna manera. Con PDO todas las 
     * entradas se escapan correctamente automáticamente. 
     * Tampoco usamos strip_tags() etc. por lo que mantenemos 
     * la entrada 100% original (para que sea posible para guardar 
     * HTML y JS en la base de datos, que es un caso de uso válido). 
     * Los datos sólo se limpiarán cuando se publiquen en las vistas 
     * (ver las vistas para más información).
     * 
     * 
     * @param string $p_nombreEmpresa Nombre de la empresa 
     * @param string $p_regimen Regimen con el que la empresa trabaja
     * @param string $p_NIT NIT de la empresa
     * @param string $p_urlLogo Logo de la empresa
     * @param string $p_direccion Dirección de la empresa
     * @param string $p_telefono Teléfono de la empresa
     * @param string $p_celular Celular de la empresa
     * @param string $p_correoElectronico Correo Electrónico de la empresa
     * @param string $p_descripcion Descripción de la empresa (que hace la empresa)
     * @param string $p_descripcionPieFactura Descripción del pie de página de la factura
     * 
     */
    public function addFactory($p_nombreEmpresa, $p_regimen, $p_NIT, $p_urlLogo, $p_direccion, $p_telefono, $p_celular, $p_correoElectronico, $p_descripcion, $p_descripcionPieFactura)
    {
        $sql = "INSERT INTO tblEmpresa(
            nombreEmpresa,
            regimen,
            NIT,
            urlLogo,
            direccion,
            telefono,
            celular,
            correoElectronico,
            descripcion,
            descripcionPieFactura) 
           VALUES (
           :p_nombreEmpresa, 
           :p_regimen, 
           :p_NIT,
           :p_urlLogo, 
           :p_direccion, 
           :p_telefono, 
           :p_celular, 
           :p_correoElectronico, 
           :p_descripcion, 
           :p_descripcionPieFactura
           )";
        

        $parameters = array(
            ':p_nombreEmpresa' => $p_nombreEmpresa,
            ':p_regimen' => $p_regimen,
            ':p_NIT' => $p_NIT,
            ':p_urlLogo' => $p_urlLogo,
            ':p_direccion' => $p_direccion,
            ':p_telefono' => $p_telefono,
            ':p_celular' => $p_celular,
            ':p_correoElectronico' => $p_correoElectronico,
            ':p_descripcion' => $p_descripcion,
            ':p_descripcionPieFactura' => $p_descripcionPieFactura
        );

        try {

            $query = $this->db->prepare($sql);
            return ($query->execute($parameters) ? $this->db->lastInsertId() : false);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;
        }
    }

}
