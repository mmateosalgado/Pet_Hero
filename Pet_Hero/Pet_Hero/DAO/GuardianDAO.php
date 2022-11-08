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
                $query = "CALL p_get_userNameGuardian();";
    
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
            $id = $this->GetGenderId($guardian->getGender());
            $guardian->setGender($id);
            $idSize = $this->GetSizeId($guardian->getTamanioParaCuidar());
            $guardian->setTamanioParaCuidar($idSize);
            $guardian->setCalificacion(0);

            $fechasDisponibles=array();
            $fechasDisponibles=$guardian->getFechasDisponibles();
            $fechasDisponiblesEncoded=json_encode($fechasDisponibles,JSON_PRETTY_PRINT);

            $query = "CALL p_insert_guardian ('".$guardian->getUserName()."','".$guardian->getPassword()."','"
            .$guardian->getFullName()."',".$guardian->getAge().",'".$guardian->getEmail()."',".$guardian->getGender().","
            .$guardian->getTelefono().",".$guardian->getCuil().",'".$guardian->getFotoPerfil()."','".$fechasDisponiblesEncoded."',"
            .$guardian->getTamanioParaCuidar().",".$guardian->getPrecioPorHora().",".$guardian->getCalificacion().");";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    public function GetGenderId($gender)
    {
        try
        {
        $id = null;

        $query = "CALL p_get_gender('".$gender."');";
        $this->connection = Connection::GetInstance();
        $resultSet= $this->connection->Execute($query);
        foreach ($resultSet as $row)
        {                
            $id=($row["id_gender"]);
        }
        return $id;
    }
        catch(Exception $ex)
        {
        throw $ex;
        }
    }

    public function GetSizeId($size)
    {
        try
        {
        $id = null;

        $query = "CALL p_get_tamanio('".$size."');";
        $this->connection = Connection::GetInstance();
        $resultSet= $this->connection->Execute($query);
        foreach ($resultSet as $row)
        {                
            $id=($row["id_tamanio"]);
        }
        return $id;
    }
        catch(Exception $ex)
        {
        throw $ex;
        }
    }
    public function Update(Guardian $guardian){
        try
        {
        $id = $this->GetSizeId($guardian->getTamanioParaCuidar());
        
        $fechasDisponibles=array();
        $fechasDisponibles=$guardian->getFechasDisponibles();
        $fechasDisponiblesEncoded=json_encode($fechasDisponibles,JSON_PRETTY_PRINT);

        $query = "CALL p_update_guardian('".$guardian->getUserName()."','".$fechasDisponiblesEncoded."',".$id.");";
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query);
         }
        catch(Exception $ex)
        {
        throw $ex;
        }
    }

    public function Delete( $userName){
        try
        {
        $query = "CALL p_delete_guardian('".$userName."');";
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query);
         }
        catch(Exception $ex)
        {
        throw $ex;
        }
    }

    public function getByUser($user) 
    {
        $this->GetAll();

        foreach($this->guardianList as $guardian) 
        {
        if($guardian->getUserName() == $user)
        {
            $guardian->setType("guardian");
            return $guardian;
        }

    }
        return null;
    }

    public function getByEmail($email) 
    {
        $this->GetAll();
        
        foreach($this->guardianList as $guardian) 
        {
            if($guardian->getEmail() == $email)
            {
                $guardian->setType("guardian");
                return $guardian;
            }
            
        }
        return null;
    }

    public function getById($id){
        $this->GetAll();
        foreach($this->guardianList as $guardian) 
        {
            if($guardian->getId() == $id)
            {
                $guardian->setType("guardian");
                return $guardian;
            }
        }
        return null;

                        }
}
?>