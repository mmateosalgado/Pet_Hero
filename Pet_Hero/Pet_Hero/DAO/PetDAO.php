<?php 
    namespace DAO;

    use Models\Pet as Pet;
    use DAO\Connection as Connection;
    use \Exception as Exception;

    class PetDao
    {
        private $petList=array();
        private $connection;
        private $tableName;

        public function __construct()
        {
            $this->tableName = "pet";
            $this->petList = array();
        }

        public function Add(Pet $pet)
        {
            try {
                $idSize = $this->GetSizeId($pet->getSize());
                $pet->setSize($idSize);
                $this->getIdRace($pet->getRace(),$pet);
                
            $query = "CALL p_insert_pet (".$pet->getIdOwner().",'".$pet->getName()."',"
            .$pet->getAnimal().",".$pet->getSize().",'".$pet->getDescription()."',".$pet->getAge().","
            .$pet->getGrXfoodPortion().",".$pet->getWeight().",'".$pet->getFoto()."','".$pet->getPlanVacunacion()."','"
            .$pet->getVideo()."');";

            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $query = "CALL p_get_Pet();";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
            
            foreach($resultSet as $row) 
            {
                $pet = new Pet();
                $pet->setId($row["id_pet"]);
                $pet->setIdOwner($row["id_owner"]);
                $pet->setName($row["name"]);
                $pet->setAnimal($row["animal"]);
                $pet->setRace($row["race"]);
                $pet->setSize($row["tamanio"]);
                $pet->setDescription($row["description"]);
                $pet->setAge($row["age"]);
                $pet->setGrXfoodPortion($row["grXfoodPortion"]);
                $pet->setWeight($row["weight"]);
                $pet->setFoto($row["foto"]);
                $pet->setPlanVacunacion($row["planVacunacion"]);
                $pet->setVideo($row["video"]);
                array_push($this->petList,$pet);
    
            }
            return $this->petList;
        
        }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function getAllByOwnerId($idOwner){
            $this->GetAll();
            $ownerPets=array();

            foreach($this->petList as $pet){
                if($pet->getIdOwner() == $idOwner){
                    array_push($ownerPets, $pet);
                }
            }

            return $ownerPets;
        }
        
        public function getById($id){
            $this->GetAll();
            foreach($this->petList as $pet){
                if($pet->getId() == $id){
                    return $pet;
                }
            }
            return null;
        }

        public function getIdRace($race,$pet)
        {
            try
            {
            $query = "CALL p_get_IdRace('".$race."');";
            $this->connection = Connection::GetInstance();
            $resultSet= $this->connection->Execute($query);
            foreach ($resultSet as $row)
            {                
                $pet->setRace($row["id_race"]);
                $pet->setAnimal($row["id_tipoAnimal"]);
            }
            return $pet;
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

        public function Update(Pet $pet){
            try
            {
            $id = $this->GetSizeId($pet->getSize());
            $query = "CALL p_update_pet(".$pet->getId().",".$id.",".$pet->getWeight().",".$pet->getGrXfoodPortion().",);";
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
             }
            catch(Exception $ex)
            {
            throw $ex;
            }
        }
    
        public function Delete( $idPet){
            try
            {
            $query = "CALL p_delete_pet(".$idPet.");";
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
             }
            catch(Exception $ex)
            {
            throw $ex;
            }
        }

    }
?>