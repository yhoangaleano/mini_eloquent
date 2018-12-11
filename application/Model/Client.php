<?php

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Model\Log;
use Mini\Libs\Helper;
use \Exception;
use \PDOException;

class Client extends Model
{
    /**
     * Obtener todos los clientes de la base de datos
     */
    public function getAllClients()
    {
        $sql = "SELECT idCliente, documento, nombreCompleto, direccion, telefonoFijo, celularPrincipal, celularAlternativo, correoElectronico, observaciones, estado FROM tblCliente ORDER BY idCliente DESC";

        try {

            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll();

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;
        }        
    }

    /**
     * Obtener todos los clientes de la base de datos filtrado por estado
     * 
     * @param tinyint $p_estado Estado de los clientes a mostrar
     */
    public function getAllClientsByStatus($p_estado)
    {

        $sql = "SELECT idCliente, documento, nombreCompleto, direccion, telefonoFijo, celularPrincipal, celularAlternativo, correoElectronico, observaciones, estado FROM tblCliente WHERE estado = :p_estado ORDER BY idCliente DESC";
        $parameters = array(':p_estado' => $p_estado);

        try {

            $query = $this->db->prepare($sql);
            $query->execute($parameters);
            return $query->fetchAll();

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * Agregar un cliente a la base de datos
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
     * @param string $p_documento documento de identidad del usuario
     * @param string $p_nombreCompleto Nombre Completo del cliente
     * @param string $p_direccion dirección de ubicación del cliente
     * @param string $p_telefonoFijo Teléfono fijo para contartar al cliente
     * @param string $p_celularPrincipal celular principal para contacto con el cliente
     * @param string $p_celularAlternativo celular alternativo al cual se puede comunicar con el cliente
     * @param string $p_correoElectronico correo electrónico con al cual se le enviara notificaciones del servicio
     * @param string $p_observaciones observaciones relacionadas con el cliente
     * 
     */
    public function addClient($p_documento, $p_nombreCompleto, $p_direccion, $p_telefonoFijo, $p_celularPrincipal, $p_celularAlternativo, $p_correoElectronico, $p_observaciones)
    {
        $sql = "INSERT INTO tblCliente(documento,nombreCompleto,direccion,telefonoFijo,celularPrincipal,celularAlternativo,correoElectronico,observaciones) 
        VALUES (:p_documento,:p_nombreCompleto,:p_direccion,:p_telefonoFijo,:p_celularPrincipal,:p_celularAlternativo,:p_correoElectronico,:p_observaciones)";
        $parameters = array(
            ':p_documento' => strip_tags($p_documento),
            ':p_nombreCompleto' => strip_tags($p_nombreCompleto),
            ':p_direccion' => strip_tags($p_direccion),
            ':p_telefonoFijo' => strip_tags($p_telefonoFijo),
            ':p_celularPrincipal' => strip_tags($p_celularPrincipal),
            ':p_celularAlternativo' => strip_tags($p_celularAlternativo),
            ':p_correoElectronico' => strip_tags($p_correoElectronico),
            ':p_observaciones' => strip_tags($p_observaciones)
        );

        try {

            $query = $this->db->prepare($sql);
            return ($query->execute($parameters) ? $this->db->lastInsertId() : false);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * Cambia el estado actual del cliente en la base de datos
     * @param int $p_idCliente Id del Cliente
     * @param tinyint $p_estado Estado actual del Cliente
     */
    public function changeClientStatus($p_idCliente, $p_estado)
    {
        $p_estado = $p_estado == 1 ? 0 : 1;
        $sql = "UPDATE tblCliente SET estado = :p_estado WHERE idCliente = :p_idCliente";
        $parameters = array(
            ':p_idCliente' => $p_idCliente,
            ':p_estado' => $p_estado
        );

        try {

            $query = $this->db->prepare($sql);
            return $query->execute($parameters);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * Obtener un cliente de la base de datos
     * @param int $p_idUsuario Id del usuario a buscar
     */
    public function getClient($p_idCliente)
    {
        $sql = "SELECT idCliente, documento, nombreCompleto, direccion, telefonoFijo, celularPrincipal, celularAlternativo, correoElectronico, observaciones, estado FROM tblCliente WHERE idCliente = :p_idCliente LIMIT 1";
        $parameters = array(':p_idCliente' => $p_idCliente);

        try {

            $query = $this->db->prepare($sql);
            $query->execute($parameters);
            return ($query->rowcount() ? $query->fetch() : false);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * Actualizar un cliente
     * @param string $p_documento documento de identidad del usuario
     * @param string $p_nombreCompleto Nombre Completo del cliente
     * @param string $p_direccion dirección de ubicación del cliente
     * @param string $p_telefonoFijo Teléfono fijo para contartar al cliente
     * @param string $p_celularPrincipal celular principal para contacto con el cliente
     * @param string $p_celularAlternativo celular alternativo al cual se puede comunicar con el cliente
     * @param string $p_correoElectronico correo electrónico con al cual se le enviara notificaciones del servicio
     * @param string $p_observaciones observaciones relacionadas con el cliente
     * @param int $p_idCliente Id del usuario que se actualizara
     * 
     */
    public function updateClient($p_documento, $p_nombreCompleto, $p_direccion, $p_telefonoFijo, $p_celularPrincipal, $p_celularAlternativo, $p_correoElectronico, $p_observaciones, $p_idCliente)
    {
        $sql = "UPDATE tblCliente SET documento = :p_documento,
        nombreCompleto = :p_nombreCompleto,
        direccion = :p_direccion,
        telefonoFijo = :p_telefonoFijo,
        celularPrincipal = :p_celularPrincipal,
        celularAlternativo = :p_celularAlternativo,
        correoElectronico = :p_correoElectronico,
        observaciones = :p_observaciones WHERE idCliente = :p_idCliente";
        $parameters = array(
            ':p_documento' => strip_tags($p_documento),
            ':p_nombreCompleto' => strip_tags($p_nombreCompleto),
            ':p_direccion' => strip_tags($p_direccion),
            ':p_telefonoFijo' => strip_tags($p_telefonoFijo),
            ':p_celularPrincipal' => strip_tags($p_celularPrincipal),
            ':p_celularAlternativo' => strip_tags($p_celularAlternativo),
            ':p_correoElectronico' => strip_tags($p_correoElectronico),
            ':p_observaciones' => strip_tags($p_observaciones),
            ':p_idCliente' => $p_idCliente
        );

        try {

            $query = $this->db->prepare($sql);
            return $query->execute($parameters);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * Obtener un cliente con correo Electronico
     * @param string $p_correoElectronico
     */
    public function getClientWithEmail($p_correoElectronico)
    {
        $sql = "SELECT idCliente, documento, nombreCompleto, direccion, telefonoFijo, celularPrincipal, celularAlternativo, correoElectronico, observaciones, estado FROM tblCliente WHERE correoElectronico = :p_correoElectronico AND estado = 1 LIMIT 1";
        $parameters = array(':p_correoElectronico' => $p_correoElectronico);

        try {

            $query = $this->db->prepare($sql);
            $query->execute($parameters);
            return ($query->rowcount() ? $query->fetch() : false);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * Obtener un cliente con su correo electrónico para validar si ya existe
     * @param string $p_correoElectronico
     */
    public function validateEmail($p_correoElectronico)
    {
        $sql = "SELECT idCliente, documento, nombreCompleto, direccion, telefonoFijo, celularPrincipal, celularAlternativo, correoElectronico, observaciones, estado FROM tblCliente WHERE correoElectronico = :p_correoElectronico LIMIT 1";
        $parameters = array(':p_correoElectronico' => $p_correoElectronico);

        try {

            $query = $this->db->prepare($sql);
            $query->execute($parameters);
            return ($query->rowcount() ? $query->fetch() : false);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * Obtener un cliente con su correo electrónico y donde el id sea diferente al de el 
     * @param string $p_correoElectronico
     * @param int $p_idCliente Id del cliente a buscar
     */
    public function validateEmailUpdate($p_correoElectronico, $p_idCliente)
    {
        $sql = "SELECT idCliente, documento, nombreCompleto, direccion, telefonoFijo, celularPrincipal, celularAlternativo, correoElectronico, observaciones, estado FROM tblCliente WHERE correoElectronico = :p_correoElectronico AND idCliente != :p_idCliente LIMIT 1";
        $parameters = array(
            ':p_correoElectronico' => $p_correoElectronico,
            ':p_idCliente' => $p_idCliente
        );

        try {

            $query = $this->db->prepare($sql);
            $query->execute($parameters);
            return ($query->rowcount() ? $query->fetch() : false);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'Client', $e->getCode(), $e->getMessage());
            return false;
        }
    }

}
