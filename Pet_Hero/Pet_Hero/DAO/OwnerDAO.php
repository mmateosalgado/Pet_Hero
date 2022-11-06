<?php
namespace DAO;
use Models\Owner as Owner;
class OwnerDAO{
    private $ownerList= array();
    private $fileName;

    public function __construct()
    {
      $this->fileName = dirname(__DIR__)."/Data/owner.json";
    }

    public function GetAll()
    {
        $this->RetrieveData();
        return $this->ownerList;
    }

    public function Add(Owner $owner)
    {
        $this->RetrieveData();
        $owner->setId($this->getNextId());
        array_push($this->ownerList,$owner);
        $this->SaveData();
    }

    public function getByUser($user) 
    {
        $this->RetrieveData();
        foreach($this->ownerList as $owner) 
        {
        if($owner->getUserName() == $user)
            return $owner;
        }
        return null;
    }

    public function getByEmail($email){
        $this->RetrieveData();
        foreach($this->ownerList as $owner) 
        {
        if($owner->getEmail() == $email)
            return $owner;
        }
        return null;
    }

    public function getById($id){
        $this->RetrieveData();
        foreach($this->ownerList as $owner) 
        {
        if($owner->getId() == $id)
            return $owner;
        }
        return null;
    }

    public function RetrieveData()
    {
        $this->ownerList= array();
        if(file_exists($this->fileName))
        {
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
            foreach($arrayToDecode as $valuesArray)
            {
                $owner = new Owner();
                $owner->setId($valuesArray["id"]);
                $owner->setUserName($valuesArray["userName"]);
                $owner->setPassword($valuesArray["password"]);
                $owner->setFullName($valuesArray["fullName"]);
                $owner->setAge($valuesArray["age"]);
                $owner->setEmail($valuesArray["email"]);
                $owner->setGender($valuesArray["gender"]);
                $owner->setType( $valuesArray["type"]);
                $owner->setTelefono( $valuesArray["telefono"]);

                array_push($this->ownerList, $owner);
           }
        }
    }

    public function SaveData()
    {
        $arrayToEncode= array();
        foreach($this->ownerList as $owner)
        {
            $valuesArray["id"]= $owner->getId();
            $valuesArray["userName"]= $owner->getUserName();
            $valuesArray["password"]= $owner->getPassword();
            $valuesArray["fullName"]= $owner->getFullName();
            $valuesArray["age"]= $owner->getAge();
            $valuesArray["email"]= $owner->getEmail();
            $valuesArray["gender"]= $owner->getGender();
            $valuesArray["type"]= $owner->getType();
            $valuesArray["telefono"]= $owner->getTelefono();
            array_push($arrayToEncode,$valuesArray);
        }
        $jsonContent= json_encode($arrayToEncode,JSON_PRETTY_PRINT);
        file_put_contents($this->fileName,$jsonContent);
    }

    private function getNextId(){
        $id=0;
        foreach($this->ownerList as $owner)
        {
            $id=($owner->getId() > $id) ? $owner->getId():$id;
        }
        return $id+ 1;
        }
    }   
?>