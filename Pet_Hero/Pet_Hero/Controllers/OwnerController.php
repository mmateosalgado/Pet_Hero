<?php 
    namespace Controllers;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\PetDao as PetDao;

    use Models\Owner as Owner;
    use Models\Pet as Pet;

    use Controllers\FileController as FileController;
    class OwnerController
    {
        private  OwnerDAO $ownerDAO;
        private PetDao $petDAO;

        public function __construct()
        {
            $this->ownerDAO=new OwnerDAO();
            $this->petDAO=new PetDao();
        }

        public function showOwnerLobby()
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            require_once(VIEWS_PATH.'lobbyOwner.php');
        }

        public function showAddPet()
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            require_once(VIEWS_PATH.'addPet.php');
        }

        public function showOwnerProfile()
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            $userOwner = $this->ownerDAO->getByUser($_SESSION["userName"]);
            require_once(VIEWS_PATH.'profileOwner.php');
        }

        public function showPets()
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            //hacer que aca agarre la id del usuario para que solo te muestra sus mascotas
            require_once(VIEWS_PATH.'myPets.php');
        }

        public function addPet($name,$animal,$race,$weight,$age,$gxp,$description,$files)
        {
            $pet= new Pet();
            $pet->setName($name);
            $pet->setAnimal($animal);
            $pet->setRace($race);
            $pet->setWeight($weight);
            $pet->setAge($age);
            $pet->setGrXfoodPortion($gxp);
            $pet->setDescription($description);
           $fileController= new FileController();
            if($path_File1 = $fileController->upload($files["photoProfile"],"Foto-Pefil-Animal"))
            {
                $pet->setFoto($path_File1);
            }
            if($path_File2 = $fileController->upload($files["planVacunacion"],"Plan-Vacunacion"))
            {
                $pet->setPlanVacunacion($path_File2);
            }
            
            $pet->setIdOwner($_SESSION["id"]);

            $this->petDAO->Add($pet);
            $this->showPets();
        }
    }
?>