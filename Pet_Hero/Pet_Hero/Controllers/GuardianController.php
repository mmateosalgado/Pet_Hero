<?php 
    namespace Controllers;

    use Models\Review as Review;
    use Models\Guardian as Guardian;
    use Models\Reserve as Reserve;


    use DAO\GuardianDAO as GuardianDAO;
    use DAO\ReviewDAO as ReviewDAO;
    use DAO\PetDao AS PetDao;
    use DAO\ReserveDao as ReserveDao;
    use DAO\OwnerDAO as OwnerDAO;
   
    use Exception;
    use PHPMailer\PHPMailer as PHPMailer;
    use PHPMailer\Exception as ExceptionMail;

    use Controllers\FileController as FileController;
use Models\Owner;

    class GuardianController
    {
        private GuardianDAO $guardianDAO;
        private ReserveDao $reserveDAO;
        private PetDAO $petDAO;
        private ReviewDAO $reviewDAO;
        private OwnerDAO $ownerDAO;

        public function __construct()
        {
            $this->guardianDAO=new GuardianDAO();
            $this->reserveDAO=new ReserveDAO();
            $this->petDAO=new PetDAO();
            $this->reviewDAO=new ReviewDAO;
            $this->ownerDAO=new OwnerDAO();
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

            $validacionCuilGuardian=$this->guardianDAO->getByCuil($cuil);
            try{
                if($validacionCuilGuardian!=null)
                {
                    throw new Exception ("Ya hay un usuario con este cuil!");
                }

                if($fechaInicio > $fechaFin)
                {
                    throw new Exception("La fecha de inicio de disponibilidad debe ser previa a la de fin!");
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
            }catch(Exception $ex){
                $alert=[
                    "text"=>$ex->getMessage()
                ];

                require_once(VIEWS_PATH.'Guardian/registerGuardian.php');
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

        public function UpdateGuardian($iDisp,$fDisp,$size,$user){
            $guardianToUpdate=$this->guardianDAO->getByUser($user);

            if($iDisp<=$fDisp){
                $newDates=array();//Fechas Nueva Reservas                                           
                $newDates=$this->getDatesBetween($iDisp,$fDisp);//Nuevas fechas disponibles

                $reservesUser=$this->reserveDAO->getByIdGuardianConfirm($_SESSION["id"]); 

                $reserveDates=array();//Fechas Reservas Confirmadas

                foreach ($reservesUser as $reserva) {
                    $fechasReserva=$this->getDatesBetween($reserva->getFechaInicio(),$reserva->getFechaFin());
                    $reserveDates=array_merge($reserveDates,$fechasReserva);
                }
                
                //Sacar Repetidos
                $reserveDates=array_unique($reserveDates);

                //Diferencia
                $datesToSave=array_diff($newDates,$reserveDates);

                //Guardar
                $guardianToUpdate->setFechasDisponibles($datesToSave);
                $guardianToUpdate->setTamanioParaCuidar($size);

                $this->guardianDAO->Update($guardianToUpdate);

                $this->showGuardianProfile("Se actualizo la informacion correctamente!");
            }else{

                $this->showUpdateGuardian($user,"La fecha de inicio de disponibilidad debe ser previa a la de fin!");
            }
        }

        public function changeReserve($estado,$idReserve)
        {   
            //Si la reserva está confirmada
            if($estado == 2 || $estado == 5)
            {
                //Borramos de fechas disponibles la reserva
                $guardian=$this->guardianDAO->getByUser($_SESSION["userName"]);
                $reserva=$this->reserveDAO->getByIdReserve($idReserve);

                $dates=$this->getDatesBetween($reserva->getFechaInicio(),$reserva->getFechaFin());

                $this->sendConfirmationEmail($reserva);

                $guardian->deleteDates($dates);
                $guardian->setTamanioParaCuidar($this->getSizeId($guardian->getTamanioParaCuidar()));

                $this->guardianDAO->Update($guardian);

                //Borrar reservas estado == 1 si se superponen las fechas siendo la mascota !=raza && !=tamanio
                $reservasEnEspeta=$this->reserveDAO->GetAll();//ByIdGuardianEnEspera
                
                
            }

            $reserveToUpdate= $this->reserveDAO->getByIdReserve($idReserve);
            $reserveToUpdate->setEstado($estado);
            $this->reserveDAO->Update($reserveToUpdate); 
            $this->showReservas();
        }

        public function getSizeId($tamanio){

            if($tamanio=='small'){
                return 1;
            }else if($tamanio=="medium"){
                return 2;
            }else if($tamanio=="big"){
                return 3;
            }
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
        }

        public function showReservas($message="")
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $this->reserveDAO->ControlarFinalizadas();/*Verificamos que no haya finalizado ninguna ya pagada*/ 
            $reserveList = array();
            $reserveList = $this->reserveDAO->getByIdGuardian($_SESSION["id"]);
            $petList = $this->petDAO->GetAll();
            require_once(VIEWS_PATH.'Guardian/viewReservesGuardian.php');
        }

        public function showHistorialReserves($message="")
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $this->reserveDAO->ControlarFinalizadas();/*Verificamos que no haya finalizado ninguna ya pagada*/ 
            $reserveList = array();
            $reserveList = $this->reserveDAO->getByIdGuardian($_SESSION["id"]);
            $petList = $this->petDAO->GetAll();
            require_once(VIEWS_PATH.'Guardian/viewHistorialReservesGuardian.php');
        }

        public function viewReview($idReserve)
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $review = $this->reviewDAO->getByIdReserve($idReserve);
            if($review==null)
            {
                $message = "Todavía no hay ninguna Review para esa Reserva";
                $this->showHistorialReserves($message);
            }
            else 
            {
                $reservePay= $this->reserveDAO->getByIdReserve($review->getIdReserve());
                $userOwner=  $this->ownerDAO->getById($reservePay->getIdGuardian());
                require_once(VIEWS_PATH.'Guardian/viewReviewGuardian.php');
            }

        }

    }
?>