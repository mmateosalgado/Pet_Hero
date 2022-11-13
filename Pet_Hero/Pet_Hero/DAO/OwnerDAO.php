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
        
        foreach($resultSet as $row) 
        {
            $owner = new Owner();
            $owner->setUserName($row["userName"]);
            $owner->setPassword($row["password"]);
            $owner->setEmail($row["email"]);
            $owner->setFullname($row["fullName"]);
            $owner->setAge($row["age"]);
            $owner->setId($row["id_owner"]);
            $owner->setTelefono($row["telefono"]);
            $owner->setGender($row["gender"]);
            $owner->setType("owner"); //TODO Acordarde de esto al buscar owner y guardian
            array_push($this->ownerList, $owner);  
        }
        return $this->ownerList;
    }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }


    public function Add(Owner $owner)
    {
        try
        {
            $id = $this->GetGenderId($owner->getGender());
            $owner->setGender($id);
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
            throw $ex;
        }
    }

    public function GetGenderId($gender)
    {
        try
        {
        $id = null;

        $query = "CALL p_get_gender(:gender);";
        $parameters["gender"] = $gender;
        $this->connection = Connection::GetInstance();
        $resultSet= $this->connection->Execute($query,$parameters);
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

    public function getByUser($user) 
    {
        try
        {
            $query = "CALL p_get_ByuserNameOwner(:pUserName);";
            $parameters["pUserName"] = $user;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
        
        foreach($resultSet as $row) 
        {
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
        return null;
         }
        catch(Exception $ex)
        {
            throw $ex;
        }
     }

     public function getByEmail($email){
       
        try
        {
            $query = "CALL p_get_ByEmailOwner(:pEmail);";
            $parameters["pEmail"] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
        
        foreach($resultSet as $row) 
        {
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
            $query = "CALL p_get_ByIdOwner(:pId);";
            $parameters["pId"] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
        
        foreach($resultSet as $row) 
        {
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
        return null;
         }
        catch(Exception $ex)
        {
            throw $ex;
        }
                     }


}