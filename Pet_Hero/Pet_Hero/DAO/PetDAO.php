<?php 
    namespace DAO;

    use Models\Pet as Pet;

    class PetDao
    {
        private $petsList=array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/pet.json";
        }

        public function Add(Pet $pet)
        {
            $this->RetrieveData();
            $pet->setId($this->getNextId());
            array_push($this->petsList, $pet);
            $this->SaveData();
        }

        public function getAllByOwnerId($idOwner){
            $this->RetrieveData();
            $ownerPets=array();
            foreach($this->petsList as $pet){
                if($pet->getOwnerId() == $idOwner){
                    array_push($ownerPets, $pet);
                }
            }

            return $ownerPets;
        }
        
        public function getById($id){
            $this->RetrieveData();
            foreach($this->petsList as $pet){
                if($pet->getId() == $id){
                    return $pet;
                }
            }
            return null;
        }

        private function SaveData(){
            $arrayToEncode=array();
            foreach($this->petsList as $pet){

                $valuesArray["id"]=$pet->getId();
                $valuesArray["idOwner"]= $pet->getIdOwner();
                $valuesArray["name"]=$pet->getName();
                $valuesArray["animal"]=$pet->getAnimal();
                $valuesArray["race"]=$pet->getRace();
                $valuesArray["description"]=$pet->getDescription();
                $valuesArray["age"]=$pet->getAge();
                $valuesArray["grXfoodPortion"]=$pet->getGrXfoodPortion();
                $valuesArray["weight"]=$pet->getWeight();
                $valuesArray["photoProfile"]=$pet->getFoto();
                $valuesArray["planVacunacion"]=$pet->getPlanVacunacion();

                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent=json_encode($arrayToEncode,JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData(){

            $this->petsList=array();
            if(file_exists($this->fileName)){

                $jsonContent=file_get_contents($this->fileName);
                $arrayToDecode=($jsonContent) ? json_decode($jsonContent,true):array();
                foreach($arrayToDecode as $valuesArray)
                {
                    $pet=new Pet();
                    $pet->setId($valuesArray["id"]);
                    $pet->setIdOwner($valuesArray["idOwner"]);
                    $pet->setName($valuesArray["name"]);
                    $pet->setAnimal($valuesArray["animal"]);
                    $pet->setRace($valuesArray["race"]);
                    $pet->setDescription($valuesArray["description"]);
                    $pet->setAge($valuesArray["age"]);
                    $pet->setGrXfoodPortion($valuesArray["grXfoodPortion"]);
                    $pet->setWeight($valuesArray["weight"]);
                    $pet->setFoto($valuesArray["photoProfile"]);
                    $pet->setPlanVacunacion($valuesArray["planVacunacion"]);
                    array_push($this->petsList,$pet);
                }
            }
        }

        private function getNextId(){
            $id=0;

            foreach($this->petsList as $pet){  
                $id=($pet->getId()>$id) ? $pet->getId() : $id;
            }

            return $id+1;
        }
    }
?>