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
                throw new Exception ("Error al agregar la mascota");
            }
        }

        public function GetAll()
        {
            try
            {
                $query = "CALL p_get_Pet();";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
                return $this->getPetList($resultSet);

        
        }
            catch(Exception $ex)
            {
                throw new Exception ("Error al mostrar las mascotas");
            }
        }
        public function getPet($resultSet)
        {
            if($resultSet != null)
            {
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
            }else 
            {
                return null;
            }
        }

        public function getPetList($resultSet)
        {
            $array = array();
                if($resultSet != null)
                {
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
                
                array_push($array,$pet);
                }
                /*TODO Ver esto $pet = $this->getPet($row);*/
                }
         return $array;
        }

        public function getAllByOwnerId($idOwner){
            try
            {
                $query = "CALL p_get_PetByOwnerId(:pIdOwner);";
                $parameters["pIdOwner"]=$idOwner;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                $ownerPets = $this->getPetList($resultSet);
                return $ownerPets;
            }
            catch(Exception $ex)
            {
                throw new Exception ("Error al mostrar todas sus mascotas");
            }
            
            }
        
        public function getById($id){
            try
            {
                $query = "CALL p_get_PetById(:pId);";
                $parameters["pId"]=$id;
                $this->connection = Connection::GetInstance();

                $row = $this->connection->Execute($query,$parameters);

                return $this->getPet($row);
            }
            catch(Exception $ex)
            {
                throw new Exception ("Error al mostrar su mascota");
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
                throw new Exception ("Error al modificar la mascota");
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
                throw new Exception("Esta Mascota tiene una reserva en el Sistema!");
            }
        }

    }
?>