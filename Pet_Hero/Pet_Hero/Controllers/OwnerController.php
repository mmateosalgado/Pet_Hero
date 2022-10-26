<?php 
    namespace Controllers;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\PetDao as PetDao;
    use DAO\GuardianDAO as GuardianDAO;

    use Models\Owner as Owner;
    use Models\Pet as Pet;
    use Models\Guardian as Guardian;
    use Models\Reserve as Reserve;

    use Controllers\FileController as FileController;
use DAO\ReserveDao;

    class OwnerController
    {
        private  OwnerDAO $ownerDAO;
        private PetDao $petDAO;
        private GuardianDAO $guardianDAO;
        private ReserveDao $reserveDAO;

        public function __construct()
        {
            $this->ownerDAO=new OwnerDAO();
            $this->petDAO=new PetDao();
            $this->guardianDAO=new GuardianDAO();
            $this->reserveDAO = new ReserveDAO();
        }

        public function showOwnerLobby($message=null)
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            $petList=array();
            $petList=$this->petDAO->getAllByOwnerId($_SESSION["id"]);
            require_once(VIEWS_PATH.'lobbyOwner.php');
        }

        public function showOwnerViewGuardians($fechaInicio,$fechaFin,$mascota,$race,$size,$idPet)
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            $guardianList = $this->guardianDAO->GetAll();
            require_once(VIEWS_PATH.'lobbyViewGuardians.php');
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
            $petList=array();
            $petList=$this->petDAO->getAllByOwnerId($_SESSION["id"]);
            require_once(VIEWS_PATH.'myPets.php');
        }

        public function addPet($name,$animal,$size,$weight,$age,$gxp,$description)
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            $pet= new Pet();
            $pet->setAnimal($animal);
            require_once(VIEWS_PATH.'addRace.php');

        }

        public function addRace($name,$animal,$size,$weight,$age,$gxp,$description,$race,$files)
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            $pet= new Pet();
            $pet->setName($name);
            $pet->setAnimal($animal);
            $pet->setSize($size);
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
            
            if($path_File3 = $fileController->upload($files["video"],"Video"))
            {
                $pet->setVideo($path_File3);
            }
            
            $pet->setIdOwner($_SESSION["id"]);
            $this->petDAO->Add($pet);
            $this->showPets();
        }

        public function addReserve($idOwner,$fechaInicio,$fechaFin,$mascota,$race,$idPet,$precio,$idGuardian)
        {
            $reserve = new Reserve();
            $reserve->setIdOwner($idOwner);
            $reserve->setFechaInicio($fechaInicio);
            $reserve->setFechaFin($fechaFin);
            $reserve->setTipoMascota($mascota);
            $reserve->setRace($race);
            $reserve->setIdMascota($idPet);
            $reserve->setIdGuardian($idGuardian);
            $reserve->setTotal($this->calcularTotal($fechaInicio,$fechaFin,$precio));
            $reserve->setEstado("En espera");
            $this->reserveDAO->Add($reserve);
            $this->showOwnerLobby("Reserva enviada exitosamente");
        }

        public function calcularTotal($fechaInicio,$fechaFin,$precio)
        {
            $inicio =  date_create($fechaInicio);
            $fin = date_create($fechaFin);
            $dias = (int) date_diff($inicio,$fin);
            $precio = $precio * $dias;
            return $precio;
        }

    }
?>