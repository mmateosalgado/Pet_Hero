<?php 
    namespace Controllers;
    use DAO\GuardianDAO as GuardianDAO;
    use Models\Guardian as Guardian;
    use PHPMailer\PHPMailer as PHPMailer;
    use PHPMailer\Exception as ExceptionMail;

    use DAO\ReserveDao as ReserveDao;
    use Models\Reserve as Reserve;
    use DAO\PetDao AS PetDao;
    use Controllers\FileController as FileController;
use DAO\OwnerDAO;

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
        {   //Borramos de fechas disponibles la reserva
            $guardianDao=new GuardianDAO();
            $reserveDao=new ReserveDao();
            $guardian=$guardianDao->getByUser($_SESSION["userName"]);
            $reserva=$reserveDao->getByIdReserve($idReserve);

            $formato="d-m-Y";
            $dates=array();//arreglo con todas las fechas a cubrir x el guardian
            $actual=strtotime($reserva->getFechaInicio());
            $fin=strtotime($reserva->getFechaFin());
            $stepVal='+1 day';
            while($actual<=$fin){
                $dates[]=date($formato,$actual);
                $actual=strtotime($stepVal,$actual);
            }

            $this->sendConfirmationEmail($reserva);

            $guardian->deleteDates($dates);
            $guardianDao->Update($guardian);
            $reserveToUpdate= $this->reserveDAO->getByIdReserve($idReserve);
            $reserveToUpdate->setEstado($estado);
            $this->reserveDAO->Update($reserveToUpdate);
            $this->showReservas();
        }

        private function sendConfirmationEmail($reserva){
            //Guardian
            $guardianDao=new GuardianDAO();
            $guardian=$guardianDao->getById($reserva->getIdGuardian());
            //Owner
            $ownerDao=new OwnerDAO();
            $owner=$ownerDao->getById($reserva->getIdOwner());

            //to--------------------------------------------------
            $mail=new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true;
            $mail->Username='petheroreserves@gmail.com';//gmail
            $mail->Password='picsqulweticpqeo';//gmail app password
            $mail->SMTPSecure='ssl';
            $mail->Port=465;
            $mail->setFrom('petheroreserves@gmail.com');
            $mail->addAddress($owner->getEmail());
            $mail->isHTML(true);
            $mail->Subject="Confirmacion Reserva - PETHERO";

            $body="<h1>Hola " . $owner->getFullName() . "! </h1>" 
            . "\n" . $guardian->getUserName() . " ha ACEPTADO la reserva para cuidar a " . "pet" . "\n" 
            . "desde el " . $reserva->getFechaInicio() . " hasta el " . $reserva->getFechaFin() . "\n" .
            "<h2>--Informacion de contacto del Guardian!--</h2> \n" .
            "       - Telefono : ". $guardian->getTelefono() ."<br>".
            "       -     Mail : ". $guardian->getEmail() ."<br>".
            "Gracias Por usar Pet Hero!" .
            "(No responder a este mail, es un mail de confirmacion)";

            $mail->Body=$body;

            $mail->send();
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