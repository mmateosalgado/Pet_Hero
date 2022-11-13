<?php
namespace DAO;
use Models\Guardian as Guardian;
use DAO\Connection as Connection;
use \Exception as Exception;

class GuardianDAO{
    private $guardianList= array();
    private $connection;
    private $tableName;

    public function __construct()
    {
      $this->tableName = "guardian";
      $this->guardianList = array();
    }
    public function GetAll()
    {
            try
            {
                $query = "CALL p_get_Guardian();";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
            
            foreach($resultSet as $row) 
            {
                $guardian = new Guardian();
                $guardian->setUserName($row["userName"]);
                $guardian->setPassword($row["password"]);
                $guardian->setEmail($row["email"]);
                $guardian->setFullname($row["fullName"]);
                $guardian->setAge($row["age"]);
                $guardian->setId($row["id_guardian"]);
                $guardian->setTelefono($row["telefono"]);
                $guardian->setGender($row["gender"]);
                $guardian->setCuil($row["cuil"]);
                
                $arrayFechasDisponibles=array();
                $arrayFechasDisponibles=$row["fechasDisponibles"];
                $arrayDecoded=json_decode($arrayFechasDisponibles,true);
            
                 $guardian->setFechasDisponibles($arrayDecoded);

                $guardian->setPrecioPorHora($row["precioPorHora"]);
                $guardian->setFotoPerfil($row["fotoPerfil"]);
                $guardian->setTamanioParaCuidar($row["tamanio"]);
                $guardian->setCalificacion($row["calificacion"]);
                $guardian->setType("guardian");
                array_push($this->guardianList,$guardian);
    
            }
            return $this->guardianList;
        
        }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    

    public function Add(Guardian $guardian)
    {
        try
        {
            $guardian->setCalificacion(0);

            $fechasDisponibles=array();
            $fechasDisponibles=$guardian->getFechasDisponibles();
            $fechasDisponiblesEncoded=json_encode($fechasDisponibles,JSON_PRETTY_PRINT);
            
            $query = "CALL p_insert_guardian (:pUserName, :pPassword, :pFUllName, :pAge, :pEmail, :pId_Gender, :pTelefono, 
            :pCuil, :pFotoPerfil, :pFechasDisponibles, :pTamanio, :pPrecio, :pCalificacion);";
            $parameters["pUserName"] = $guardian->getUserName();
            $parameters["pPassword"] = $guardian->getPassword();
            $parameters["pFUllName"] = $guardian->getFullName();
            $parameters["pAge"] = $guardian->getAge();
            $parameters["pEmail"] = $guardian->getEmail();
            $parameters["pId_Gender"] = $guardian->getGender();
            $parameters["pTelefono"] = $guardian->getTelefono();
            $parameters["pCuil"] = $guardian->getCuil();
            $parameters["pFotoPerfil"] = $guardian->getFotoPerfil();
            $parameters["pFechasDisponibles"] = $fechasDisponiblesEncoded;
            $parameters["pTamanio"] = $guardian->getTamanioParaCuidar();
            $parameters["pPrecio"] = $guardian->getPrecioPorHora();
            $parameters["pCalificacion"] = $guardian->getCalificacion();



            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query,$parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function Update(Guardian $guardian){
        try
        {
        
        $fechasDisponibles=array();
        $fechasDisponibles=$guardian->getFechasDisponibles();
        $fechasDisponiblesEncoded=json_encode($fechasDisponibles,JSON_PRETTY_PRINT);

        $query = "CALL p_update_guardian(:pUserName, :pFechasDisponibles, :pId);";
        $parameters[":pUserName"]=$guardian->getUserName();
        $parameters[":pFechasDisponibles"]=$fechasDisponiblesEncoded;
        $parameters[":pId"]=$guardian->getTamanioParaCuidar();

        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query,$parameters);
         }
        catch(Exception $ex)
        {
        throw $ex;
        }
    }

    public function Delete( $userName){
        try
        {
        $query = "CALL p_delete_guardian(:pUserName);";
        $parameters[":pUserName"]=$userName;
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query,$parameters);
         }
        catch(Exception $ex)
        {
        throw $ex;
        }
    }

    public function getByUser($user) 
    {
        try
        {
            $query = "CALL p_get_ByuserNameGuardian(:pUserName);";
            $parameters["pUserName"] = $user;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
        
        foreach($resultSet as $row) 
        {
            $guardian = new Guardian();
            $guardian->setUserName($row["userName"]);
            $guardian->setPassword($row["password"]);
            $guardian->setEmail($row["email"]);
            $guardian->setFullname($row["fullName"]);
            $guardian->setAge($row["age"]);
            $guardian->setId($row["id_guardian"]);
            $guardian->setTelefono($row["telefono"]);
            $guardian->setGender($row["gender"]);
            $guardian->setCuil($row["cuil"]);
            
            $arrayFechasDisponibles=array();
            $arrayFechasDisponibles=$row["fechasDisponibles"];
            $arrayDecoded=json_decode($arrayFechasDisponibles,true);
        
             $guardian->setFechasDisponibles($arrayDecoded);

            $guardian->setPrecioPorHora($row["precioPorHora"]);
            $guardian->setFotoPerfil($row["fotoPerfil"]);
            $guardian->setTamanioParaCuidar($row["tamanio"]);
            $guardian->setCalificacion($row["calificacion"]);
            $guardian->setType("guardian");
            return $guardian;

        }
        return null;
    
    }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getByEmail($email) 
    {
        try
        {
            $query = "CALL p_get_ByEmailGuardian(:pEmail);";
            $parameters["pEmail"] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
        
        foreach($resultSet as $row) 
        {
            $guardian = new Guardian();
            $guardian->setUserName($row["userName"]);
            $guardian->setPassword($row["password"]);
            $guardian->setEmail($row["email"]);
            $guardian->setFullname($row["fullName"]);
            $guardian->setAge($row["age"]);
            $guardian->setId($row["id_guardian"]);
            $guardian->setTelefono($row["telefono"]);
            $guardian->setGender($row["gender"]);
            $guardian->setCuil($row["cuil"]);
            
            $arrayFechasDisponibles=array();
            $arrayFechasDisponibles=$row["fechasDisponibles"];
            $arrayDecoded=json_decode($arrayFechasDisponibles,true);
        
             $guardian->setFechasDisponibles($arrayDecoded);

            $guardian->setPrecioPorHora($row["precioPorHora"]);
            $guardian->setFotoPerfil($row["fotoPerfil"]);
            $guardian->setTamanioParaCuidar($row["tamanio"]);
            $guardian->setCalificacion($row["calificacion"]);
            $guardian->setType("guardian");
            return $guardian;

        }
        return null;
    
    }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getById($id){
        try
        {
            $query = "CALL p_get_ByIdGuardian(:pId);";
            $parameters["pId"] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
        
        foreach($resultSet as $row) 
        {
            $guardian = new Guardian();
            $guardian->setUserName($row["userName"]);
            $guardian->setPassword($row["password"]);
            $guardian->setEmail($row["email"]);
            $guardian->setFullname($row["fullName"]);
            $guardian->setAge($row["age"]);
            $guardian->setId($row["id_guardian"]);
            $guardian->setTelefono($row["telefono"]);
            $guardian->setGender($row["gender"]);
            $guardian->setCuil($row["cuil"]);
            
            $arrayFechasDisponibles=array();
            $arrayFechasDisponibles=$row["fechasDisponibles"];
            $arrayDecoded=json_decode($arrayFechasDisponibles,true);
        
             $guardian->setFechasDisponibles($arrayDecoded);

            $guardian->setPrecioPorHora($row["precioPorHora"]);
            $guardian->setFotoPerfil($row["fotoPerfil"]);
            $guardian->setTamanioParaCuidar($row["tamanio"]);
            $guardian->setCalificacion($row["calificacion"]);
            $guardian->setType("guardian");
            return $guardian;

        }
        return null;
    
    }
        catch(Exception $ex)
        {
            throw $ex;
        }

        }
    }
?>