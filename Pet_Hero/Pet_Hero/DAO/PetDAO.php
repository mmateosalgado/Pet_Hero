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
            $query = "CALL p_insert_pet (:pIdOwner, :pName, :pAnimal, :pSize, :pDescription, :pAge, :pGrXfoodPortion, :pWeight, :pPhotoProfile, :pPlanVacunacion, :pVideo);";

            $parameters["pIdOwner"]= $pet->getIdOwner();
            $parameters["pName"]=$pet->getName();
            $parameters["pAnimal"]=$pet->getRace(); /*Contiene la id de la raza*/
            $parameters["pSize"]=$pet->getSize();
            $parameters["pDescription"]=$pet->getDescription();
            $parameters["pAge"]=$pet->getAge();
            $parameters["pGrXfoodPortion"]=$pet->getGrXfoodPortion();
            $parameters["pWeight"]=$pet->getWeight();
            $parameters["pPhotoProfile"]=$pet->getFoto();
            $parameters["pPlanVacunacion"]=$pet->getPlanVacunacion();
            $parameters["pVideo"]=$pet->getVideo();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
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
            try
            {
                $query = "CALL p_get_PetByOwnerId(:pIdOwner);";
                $parameters["pIdOwner"]=$idOwner;
                $ownerPets=array();

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                foreach($resultSet as $row){
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
                    array_push($ownerPets,$pet);
                    }
             return $ownerPets;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            
            }
        
        public function getById($id){
            try
            {
                $query = "CALL p_get_PetById(:pId);";
                $parameters["pId"]=$id;
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                foreach($resultSet as $row){
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
                    return $pet;
                    }
             return null;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Update(Pet $pet){
            try
            {
            $query = "CALL p_update_pet(:pIdPet, :pIdSize, :pWeight, :pGr);";
            $parameters["pIdPet"]=$pet->getId();
            $parameters["pIdSize"]=$pet->getSize();
            $parameters["pWeight"]=$pet->getWeight();
            $parameters["pGr"]=$pet->getGrXfoodPortion();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);
             }
            catch(Exception $ex)
            {
            throw $ex;
            }
        }
    
        public function Delete( $idPet){
            try
            {
            $query = "CALL p_delete_pet( :idPet);";
            $parameters["idPet"] = $idPet;
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);
             }
            catch(Exception $ex)
            {
            throw $ex;
            }
        }

    }
?>