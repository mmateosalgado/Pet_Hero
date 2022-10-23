<?php 
    namespace Controllers;
    use DAO\GuardianDAO as GuardianDAO;
    use Models\Guardian as Guardian;
    use Controllers\FileController as FileController;
    class GuardianController
    {
        private GuardianDAO $guardianDAO;

        public function __construct()
        {
            $this->guardianDAO=new GuardianDAO();
        }

        public function addCuilAndPPH($user,$password,$name,$date,$email,$gender,$accountType,$telefono, $cuil,$pph,$fechaInicio,$fechaFin,$files){//PPH-> precio por hora o price per hour
            $guardian=new Guardian();

            $guardian->setUserName($user);
            $guardian->setPassword($password);
            $guardian->setFullName($name);
            $guardian->setAge($date);//fecha nacimiento
            $guardian->setEmail($email);
            $guardian->setGender($gender);
            $guardian->setType( $accountType);
            $guardian->setTelefono($telefono);

            $guardian->setCuil($cuil);
            $guardian->setPrecioPorHora($pph);
            $guardian->setFechaInicio($fechaInicio);
            $guardian->setFechaFin($fechaFin);
            
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

        public function showGuardianLobby()
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            require_once(VIEWS_PATH.'lobbyGuardian.php');
        }
        public function showGuardianProfile()
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            $userGuardian = $this->guardianDAO->getByUser($_SESSION["userName"]);
            require_once(VIEWS_PATH.'profileGuardian.php');
        }
    }
?>