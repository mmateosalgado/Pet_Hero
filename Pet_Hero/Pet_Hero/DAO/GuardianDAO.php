<?php
namespace DAO;
use Models\Guardian as Guardian;
class GuardianDAO{
    private $guardianList= array();
    private $fileName;

    public function __construct()
    {
      $this->fileName = dirname(__DIR__)."/Data/guardian.json";
    }

    public function GetAll()
    {
        $this->RetrieveData();
        return $this->guardianList;
    }

    public function Add(Guardian $guardian)
    {
        $this->RetrieveData();
        $guardian->setId($this->getNextId());
        array_push($this->guardianList,$guardian);
        $this->SaveData();
    }

    public function getByUser($user) 
    {
      $this->RetrieveData();
      foreach($this->guardianList as $guardian) 
      {
        if($guardian->getUserName() == $user)
          return $guardian;
      }
      return null;
    }

    public function RetrieveData()
    {
        $this->guardianList= array();
        if(file_exists($this->fileName))
        {
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
            foreach($arrayToDecode as $valuesArray)
            {
                $guardian = new Guardian();
                $guardian->setId($valuesArray["id"]);
                $guardian->setUserName($valuesArray["userName"]);                     
                $guardian->setPassword($valuesArray["password"]);
                $guardian->setFullName($valuesArray["fullName"]);
                $guardian->setAge($valuesArray["age"]);
                $guardian->setEmail($valuesArray["email"]);
                $guardian->setGender($valuesArray["gender"]);
                $guardian->setType($valuesArray["type"]);
                $guardian->setCuil($valuesArray["cuil"]);
                $guardian->setPrecioPorHora($valuesArray["precioPorHora"]);
                $guardian->setCalificacion($valuesArray["calificacion"]);

                array_push($this->guardianList, $guardian);
            }
        }
    }

    public function SaveData()
    {
        $arrayToEncode= array();
                    foreach($this->guardianList as $guardian)
                    {
                        $valuesArray["id"]= $guardian->getId();
                        $valuesArray["userName"]= $guardian->getUserName();
                        $valuesArray["password"]= $guardian->getPassword();
                        $valuesArray["fullName"]= $guardian->getFullName();
                        $valuesArray["age"]= $guardian->getAge();
                        $valuesArray["email"]= $guardian->getEmail();
                        $valuesArray["gender"]= $guardian->getGender();
                        $valuesArray["type"]= $guardian->getType();
                        $valuesArray["cuil"] = $guardian->getCuil();
                        $valuesArray["precioPorHora"]= $guardian->getPrecioPorHora();
                        $valuesArray["calificacion"]=  $guardian->getCalificacion();

                        array_push($arrayToEncode,$valuesArray);
                    }
        $jsonContent= json_encode($arrayToEncode,JSON_PRETTY_PRINT);
        file_put_contents($this->fileName,$jsonContent);
    }

    private function getNextId(){
        $id=0;
        foreach($this->guardianList as $guardian)
        {
            $id=($guardian->getId() > $id) ? $guardian->getId():$id;
        }
        return $id+ 1;
        }
    }
?>