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

        public function Index($message = "")
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            require_once(VIEWS_PATH."Guardian/lobbyGuardian.php");
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
                $message="La fecha de inicio de disponibilidad debe ser previa a la de fin!";
                require_once(VIEWS_PATH.'Guardian/registerGuardian.php');

            }
            else{
                $guardian->setFechasDisponibles($this->getDatesBetween($fechaInicio,$fechaFin));
                
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
        public function showGuardianProfile($message="")
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $userGuardian = $this->guardianDAO->getByUser($_SESSION["userName"]);
            require_once(VIEWS_PATH.'Guardian/profileGuardian.php');
        }

        public function showUpdateGuardian($user,$message=""){
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            
            require_once(VIEWS_PATH.'Guardian/updateGuardian.php');
        }

        public function updateGuardian($iDisp,$fDisp,$size,$user){//TODO:Testear
            $guardianToUpdate=$this->guardianDAO->getByUser($user);


            if($iDisp<=$fDisp){
                $dates=$this->getDatesBetween($iDisp,$fDisp);

                $reservesUser=$this->reserveDAO->GetAllByUser($user);
                $reservesDates=array();

                foreach ($reservesUser as $reserva) {
                    $add=$this->getDatesBetween($reserva->getFechaInicio(),$reserva->getFechaFinal());
                    array_merge($reservesDates,$dates);//arreglo que tendra todas las fechas de reservas del usuario
                }

                $datesToSave=array_intersect($dates,$reservesDates);

                $guardianToUpdate->setFechasDisponibles($datesToSave);
                $guardianToUpdate->setTamanioParaCuidar($size);
                $this->guardianDAO->Update($guardianToUpdate);


                $this->showGuardianProfile("Se actualizo la informacion correctamente!");
            }else{

                $this->showUpdateGuardian($user,"La fecha de inicio de disponibilidad debe ser previa a la de fin!");
            }
        }

        public function changeReserve($estado,$idReserve)
        {   //Borramos de fechas disponibles la reserva
            $guardian=$this->guardianDAO->getByUser($_SESSION["userName"]);
            $reserva=$this->reserveDAO->getByIdReserve($idReserve);

            $dates=$this->getDatesBetween($reserva->getFechaInicio(),$reserva->getFechaFin());

            $message=$this->sendConfirmationEmail($reserva);

            $guardian->deleteDates($dates);
            $this->guardianDAO->Update($guardian);
            $reserveToUpdate= $this->reserveDAO->getByIdReserve($idReserve);
            $reserveToUpdate->setEstado($estado);
            $this->reserveDAO->Update($reserveToUpdate);
            $this->showReservas($message);
        }

        private function sendConfirmationEmail($reserva){
            //Guardian
            $guardian=$this->guardianDAO->getById($reserva->getIdGuardian());
            //Owner
            $ownerDao=new OwnerDAO();
            $owner=$ownerDao->getById($reserva->getIdOwner());
            //Pet
            $pet=$this->petDAO->getById($reserva->getIdMascota());

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
            . "\n" . $guardian->getUserName() . " ha ACEPTADO la reserva para cuidar a " . $pet->getName() . "\n" 
            . "desde el " . $reserva->getFechaInicio() . " hasta el " . $reserva->getFechaFin() . "\n" .
            "<h2>--Informacion de contacto del Guardian!--</h2> \n" .
            "       - Telefono : ". $guardian->getTelefono() ."<br>".
            "       -     Mail : ". $guardian->getEmail() ."<br>".
            "Gracias Por usar Pet Hero!" .
            "(No responder a este mail, es un mail de confirmacion)";

            $mail->Body=$body;

            $mail->send();

            return "Se a enviado la confirmacion al Dueño";
        }

        public function showReservas($message="")
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $reserveList = array();
            $reserveList = $this->reserveDAO->getByIdGuardian($_SESSION["id"]);
            $petList = $this->petDAO->GetAll();
            require_once(VIEWS_PATH.'Guardian/viewReservesGuardian.php');
        }
    }
?>