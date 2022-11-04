<?php 
    namespace Controllers;
    use DAO\GuardianDAO as GuardianDAO;
    use Models\Guardian as Guardian;

    use DAO\ReserveDao as ReserveDao;
    use Models\Reserve as Reserve;
    use DAO\PetDao AS PetDao;
    use Controllers\FileController as FileController;
    class GuardianController
    {
        private GuardianDAO $guardianDAO;
        private ReserveDao $reserveDAO;
        private PetDAO $petDAO;

        public function __construct()
        {
            $this->guardianDAO=new GuardianDAO();
            $this->reserveDAO=new ReserveDAO();
            $this->petDAO=new PetDAO();
        }

        public function addCuilAndPPH($user,$password,$name,$date,$email,$gender,$accountType,$telefono,$size,$cuil,$pph,$fechaInicio,$fechaFin,$files){//PPH-> precio por hora o price per hour
            $guardian=new Guardian();



            $guardian->setUserName($user);
            $guardian->setPassword($password);
            $guardian->setFullName($name);
            $guardian->setAge($date);//fecha nacimiento
            $guardian->setEmail($email);
            $guardian->setGender($gender);
            $guardian->setType( $accountType);
            $guardian->setTelefono($telefono);
            $guardian->setTamanioParaCuidar($size);
            $guardian->setCuil($cuil);
            $guardian->setPrecioPorHora($pph);
            if($fechaInicio > $fechaFin)
            {
                echo "<script> if(confirm('La fecha de inicio de disponibilidad debe ser previa a la de fin!'));</script>";
                require_once(VIEWS_PATH.'Guardian/registerGuardian.php');

            }
            else{
                $guardian->setFechasDisponibles($this->getDatesBetween($fechaInicio,$fechaFin));
               // $guardian->setFechaInicio($fechaInicio);
               // $guardian->setFechaFin($fechaFin);
               // --> crear arreglo con todos los dias
                
                $fileController = new FileController();
                if($path_File1 = $fileController->upload($files["photo"],"Foto-Pefil"))
                {
                    $guardian->setFotoPerfil($path_File1);
                }
                else 
                {
                    $guardian->setFotoPerfil("Error else");
    
                }
                $this->guardianDAO->Add($guardian);
    
                $this->showGuardianLobby();
            }
        }

        private function getDatesBetween($inicio,$fin){
            $formato="d-m-Y";
            $dates=array();
            $actual=strtotime($inicio);
            $fin=strtotime($fin);
            $stepVal='+1 day';
            while($actual<=$fin){
                $dates[]=date($formato,$actual);
                $actual=strtotime($stepVal,$actual);
            }

            return $dates;
        }

        public function showGuardianLobby()
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $reserveList = array();
            $reserveList = $this->reserveDAO->getByIdGuardian($_SESSION["id"]);
            $petList = $this->petDAO->GetAll();
            require_once(VIEWS_PATH.'Guardian/lobbyGuardian.php');
        }
        public function showGuardianProfile()
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $userGuardian = $this->guardianDAO->getByUser($_SESSION["userName"]);
            require_once(VIEWS_PATH.'Guardian/profileGuardian.php');
        }

        public function showUpdateGuardian($user){//+ inicio disponibilidad, fin disponibilidad
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            require_once(VIEWS_PATH.'Guardian/updateGuardian.php');
        }

        public function updateGuardian($iDisp,$fDisp,$size,$user){
            $guardianToUpdate=$this->guardianDAO->getByUser($user);


            if($iDisp<$fDisp){
                $dates=$this->getDatesBetween($iDisp,$fDisp);
                $guardianToUpdate->setFechasDisponibles($dates);
                $guardianToUpdate->setTamanioParaCuidar($size);
                $this->guardianDAO->Update($guardianToUpdate);
                echo "<script> if(confirm('Se actualizo la informacion correctamente!'));</script>";
                $this->showGuardianProfile();
            }else{
                echo "<script> if(confirm('La fecha de inicio de disponibilidad debe ser previa a la de fin!'));</script>";
                $this->showUpdateGuardian($user);
            }


        }

        public function changeReserve($estado,$idReserve)
        {  
            $reserveToUpdate= $this->reserveDAO->getByIdReserve($idReserve);
            $reserveToUpdate->setEstado($estado);
            $this->reserveDAO->Update($reserveToUpdate);
            $this->showReservas();
        }
        public function showReservas()
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $reserveList = array();
            $reserveList = $this->reserveDAO->getByIdGuardian($_SESSION["id"]);
            $petList = $this->petDAO->GetAll();
            require_once(VIEWS_PATH.'Guardian/viewReservesGuardian.php');
        }
    }
?>