<?php
namespace DAO;
use Models\Owner as Owner;
use DAO\Connection as Connection;
use \Exception as Exception;

class OwnerDAO{
    private $ownerList= array();
    private $connection;
    private $tableName;

    public function __construct()
    {
      $this->tableName = "owner";
      $this->ownerList = array();
    }

    public function GetAll()
    {
        try
        {
            $query = "CALL p_get_Owner();";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            return $this->getOwnerList($resultSet);
    }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getOwner($resultSet)
    {

       if($resultSet != null) 
        {
            foreach($resultSet as $row){
            $owner = new Owner();
            $owner->setUserName($row["userName"]);
            $owner->setPassword($row["password"]);
            $owner->setEmail($row["email"]);
            $owner->setFullname($row["fullName"]);
            $owner->setAge($row["age"]);
            $owner->setId($row["id_owner"]);
            $owner->setTelefono($row["telefono"]);
            $owner->setGender($row["gender"]);
            $owner->setType("owner"); 
            return $owner;
            }
        }
        else 
        {
        return null;
        }
    }

    public function getOwnerList($resultSet)
    {
        $array= array();
            if($resultSet != null) 
            {
                foreach($resultSet as $row){
                $owner = new Owner();
                $owner->setUserName($row["userName"]);
                $owner->setPassword($row["password"]);
                $owner->setEmail($row["email"]);
                $owner->setFullname($row["fullName"]);
                $owner->setAge($row["age"]);
                $owner->setId($row["id_owner"]);
                $owner->setTelefono($row["telefono"]);
                $owner->setGender($row["gender"]);
                $owner->setType("owner"); 
                array_push($array, $owner);  
                }
            }
                return $array;
    }


    public function Add(Owner $owner)
    {
        try
        {
            $query = "CALL p_insert_owner (:pUserName, :pPassword, :pFUllName, :pAge, :pEmail, :pId_Gender, :pTelefono);";
            $parameters["pUserName"] = $owner->getUserName();
            $parameters["pPassword"] = $owner->getPassword();
            $parameters["pFUllName"] = $owner->getFullName();
            $parameters["pAge"] = $owner->getAge();
            $parameters["pEmail"] = $owner->getEmail();
            $parameters["pId_Gender"] = $owner->getGender();
            $parameters["pTelefono"] = $owner->getTelefono();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query,$parameters);
        }
        catch(Exception $ex)
        {
            throw new Exception ("Error al agregar el owner");
        }
    }

    public function getByUser($user) 
    {
        try
        {
            $query = "CALL p_get_ByuserNameOwner(:pUserName);";
            $parameters["pUserName"] = $user;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
         
            return $this->getOwner($resultSet);
            

        }
        catch(Exception $ex)
        {
            throw new Exception("-El usuario ya existe!");
        }
    }

    public function getByEmail($email){
        try
        {
            $query = "CALL p_get_ByEmailOwner(:pEmail);";
            $parameters["pEmail"] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
        
            return $this->getOwner($resultSet);
         }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar el owner");
        }
                     }
                     
    public function getById($id){
       
        try
        {
            $query = "CALL p_get_ByIdOwner(:pId);";
            $parameters["pId"] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
        
            return $this->getOwner($resultSet);
         }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar el owner");
        }
                     }


}