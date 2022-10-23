<?php 
    namespace Controllers;
    use DAO\GuardianDAO as GuardianDAO;
    use Models\Guardian as Guardian;

    class GuardianController
    {
        private GuardianDAO $guardianDAO;

        public function __construct()
        {
            $this->guardianDAO=new GuardianDAO();
        }

        public function addCuilAndPPH($user,$name,$email,$password,$date,$accountType,$gender,$cuil,$pph){//PPH-> precio por hora o price per hour
            $guardian=new Guardian();

            $guardian->setUserName($user);
            $guardian->setPassword($password);
            $guardian->setFullName($name);
            $guardian->setAge($date);//fecha nacimiento
            $guardian->setEmail($email);
            $guardian->setGender($gender);
            $guardian->setType( $accountType);
            $guardian->setCuil($cuil);
            $guardian->setPrecioPorHora($pph);

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

        public function showUpdateGuardian($user){//+ inicio disponibilidad, fin disponibilidad
            require_once(VIEWS_PATH.'validate-sesion.php');
            require_once(VIEWS_PATH.'updateGuardian.php');
        }

        public function updateGuardian($iDisp,$fDisp,$user){
            $guardianToUpdate=$this->guardianDAO->getByUser($user);

            if($iDisp<$fDisp){
                $guardianToUpdate->setFechaInicio($iDisp);
                $guardianToUpdate->setFechaFin($fDisp);
                $this->guardianDAO->Update($guardianToUpdate);
                echo "<script> if(confirm('Se actualizo la informacion correctamente!'));</script>";
                $this->showGuardianProfile();
            }else{
                echo "<script> if(confirm('La fecha de inicio de disponibilidad debe ser previa a la de fin!'));</script>";
                $this->showUpdateGuardian($user);
            }

            
        }
    }
?>