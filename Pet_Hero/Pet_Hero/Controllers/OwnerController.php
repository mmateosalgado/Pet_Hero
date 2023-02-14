<?php 
    namespace Controllers;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\PetDao as PetDao;
    use DAO\GuardianDAO as GuardianDAO;
    use DAO\ReviewDAO as ReviewDAO;

    use \Exception as Exception;

    use Models\Owner as Owner;
    use Models\Pet as Pet;
    use Models\Guardian as Guardian;
    use Models\Reserve as Reserve;
    use Models\Review as Review;

    use Controllers\FileController as FileController;
    use DAO\ReserveDao as ReserveDao;

    class OwnerController
    {
        private  OwnerDAO $ownerDAO;
        private PetDao $petDAO;
        private GuardianDAO $guardianDAO;
        private ReserveDao $reserveDAO;
        private ReviewDAO $reviewDAO;

        public function __construct()
        {
            $this->ownerDAO=new OwnerDAO();
            $this->petDAO=new PetDao();
            $this->guardianDAO=new GuardianDAO();
            $this->reserveDAO = new ReserveDAO();
            $this->reviewDAO = new ReviewDAO();
        }

        public function showOwnerLobby($alert="",$message="")
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $petList=array();
            $petList=$this->petDAO->getAllByOwnerId($_SESSION["id"]);
            require_once(VIEWS_PATH.'Owner/lobbyOwner.php');
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


        public function showOwnerViewGuardians($fechaInicio,$fechaFin,$idPet)
        {

            try{

            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            

                if($fechaInicio<$fechaFin){

                    $dates=$this->getDatesBetween($fechaInicio,$fechaFin);
                    $days=count($dates);//Se usa para multiplicar el precio

                
                    $newPet = $this->petDAO->getById($idPet);

                    $guardianListToFilter = $this->guardianDAO->GetBySizeGuardian($newPet->getSize());

                    $guardianList=array();//Lista que mostramos!

                    foreach($guardianListToFilter as $guardian){
                        if( count(array_diff($dates,$guardian->getFechasDisponibles())) == 0 || $this->reserveDAO->VerifyByDateAndRace($guardian->getId(),$dates,$newPet->getRace(),$guardian->getFechasDisponibles()))
                        {
                            $guardian = $this->giveCalification($guardian);
                            $existingReservesPetGuardian=$this->reserveDAO->getbyIdGuardianAndPet($guardian->getId(),$newPet->getId());

                            if($existingReservesPetGuardian==null){
                                array_push($guardianList,$guardian);
                            }else{
                                $count=0;
                                $reservasPetDates=array();

                                foreach($existingReservesPetGuardian as $reserve){
                                    $datesReserve=$this->getDatesBetween($reserve->getFechaInicio(),$reserve->getFechaFin());
                                    $reservasPetDates=array_merge($reservasPetDates,$datesReserve);
                                }

                                foreach($reservasPetDates as $date){
                                    if(in_array($date,$dates)){
                                        $count++;
                                    }
                                }

                                if($count==0){
                                    array_push($guardianList,$guardian);
                                }
                            }

                        }
                    }
                

                    require_once(VIEWS_PATH.'Owner/lobbyViewGuardians.php');

                }else{
                    throw new Exception("La fecha de inicio debe ser previa a la de fin!");
                }
            }
            catch (Exception $ex) {
                $alert=[
                    "text"=>$ex->getMessage()
                ];
                $this->showOwnerLobby($alert);
            }
            
        }

        public function giveCalification($guardian)
        {
            try{
            /*Reviews de ese Guardian*/
            $reviewList = $this->reviewDAO->getByIdGuardian($guardian->getId());
            $cantidad =0;
            $suma =0;
            $calificacion = 0;

                foreach ($reviewList as $review) {

                    $suma = $suma+ $review->getCalificacion();
                    $cantidad ++;
                }
                
            if($cantidad!=0)
            {
            $calificacion = (int) ($suma / $cantidad);
            }
            $guardian->setCalificacion($calificacion);
            return $guardian;
            }
            catch (Exception $ex) {
                $alert=[
                    "text"=>$ex->getMessage()
                ];
                $this->showOwnerLobby($alert);
            }
            
        }

        public function showAddPet()
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            require_once(VIEWS_PATH.'Owner/Pet/addPet.php');
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }

        public function showOwnerProfile()
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $userOwner = $this->ownerDAO->getByUser($_SESSION["userName"]);
            require_once(VIEWS_PATH.'Owner/profileOwner.php');
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }

        public function showPets($alert='')
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $petList=array();
            $petList=$this->petDAO->getAllByOwnerId($_SESSION["id"]);
            require_once(VIEWS_PATH.'Owner/myPets.php');
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }

        public function addPet($name,$animal,$size,$weight,$age,$gxp,$description)
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $pet= new Pet();
            $pet->setAnimal($animal);
            require_once(VIEWS_PATH.'Owner/Pet/addRace.php');
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }    
        }

        public function showGuardian( $id,$fechaInicio,$fechaFin,$idPet){
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $auxGdao=new GuardianDAO();
            $guardian = $auxGdao->getById($id);
            require_once(VIEWS_PATH.'Owner/viewGuardianProfile.php');
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }

        public function addRace($name,$animal,$size,$weight,$age,$gxp,$description,$race,$files)
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
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
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }

        public function addReserve($idOwner,$fechaInicio,$fechaFin,$mascota,$race,$idPet,$precio,$idGuardian)
        {
            try{
            $reserve = new Reserve();
            $reserve->setIdOwner($idOwner);
            $reserve->setFechaInicio($fechaInicio);
            $reserve->setFechaFin($fechaFin);
            $reserve->setTipoMascota($mascota);
            $reserve->setRace($race);
            $reserve->setIdMascota($idPet);
            $reserve->setIdGuardian($idGuardian);
            $reserve->setTotal($this->calcularTotal($fechaInicio,$fechaFin,$precio));
            $reserve->setEstado(1);
            $this->reserveDAO->Add($reserve);
            $this->showOwnerLobby("","Reserva solicitada exitosamente");
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }

        public function calcularTotal($fechaInicio,$fechaFin,$precio)
        {
            $inicio =  date_create($fechaInicio);
            $fin = date_create($fechaFin);
            $dias = (int) date_diff($inicio,$fin);
            $precio = $precio * $dias;
            return $precio;
        }

        public function showReserves()
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $this->reserveDAO->ControlarFinalizadas();/*Verificamos que no haya finalizado ninguna ya pagada*/ 
            $reserveList2 = array();
            $reserveList2 = $this->reserveDAO->getbyIdOwner($_SESSION["id"]);

            $reserveList = $this->VerificarExpiración($reserveList2);
            
            $petList = $this->petDAO->GetAll();
            $guardianList = $this->guardianDAO->GetAll();
            require_once(VIEWS_PATH.'Owner/viewReservesOwner.php');
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }

        public function DeletePet($idPet)
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            try{
                $petList=array();
                $petList=$this->petDAO->getAllByOwnerId($_SESSION["id"]);

                $arrayReservesPet = $this->reserveDAO->getbyIdPet($idPet);

                if($arrayReservesPet == null)
                {
                    $this->petDAO->Delete($idPet);
                }else{
                    throw new Exception("Esta Mascota tiene una reserva en el Sistema!");
                }

            }catch(Exception $ex){
                $alert=[
                    "text"=>$ex->getMessage()
                ];
            }finally{
                $this->showPets($alert);
            }
        }

        public function goToPay($idReserve)
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $reserve = $this->reserveDAO->getByIdReserve($idReserve);
            require_once(VIEWS_PATH.'Owner/pay.php');
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }

        public function payReserve($idReserve, $precio, $idEstado)
        {
            try{
            /*Cambiamos precio*/
            $precio = $precio/2;
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $reserve = new Reserve();
            $reserve->setEstado($idEstado);
            $reserve->setTotal($precio);
            $reserve->setIdReserve($idReserve);
            $this->reserveDAO->update($reserve);
            
            $reservePay = $this->reserveDAO->getByIdReserve($idReserve);
            $userGuardian= $this->guardianDAO->getById($reservePay->getIdGuardian());
            $userOwner = $this->ownerDAO->getById($reservePay->getIdOwner());
            require_once(VIEWS_PATH.'Owner/bill.php');
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }

        }

        public function showHistorialReserves()
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $this->reserveDAO->ControlarFinalizadas();/*Verificamos que no haya finalizado ninguna ya pagada*/ 
            $reserveList = array();
            $reserveList = $this->reserveDAO->getbyIdOwner($_SESSION["id"]);
            $petList = $this->petDAO->GetAll();
            require_once(VIEWS_PATH.'Owner/viewHistorialReservesOwner.php');
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }

        public function setCalificacion($calificacion, $description, $idReserve)
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            /*reserva calificada*/
            $reserve = $this->reserveDAO->getByIdReserve($idReserve);
            $guardian = $this->guardianDAO->getById($reserve->getIdGuardian());
            
            $review = new Review();
            $review->setCalificacion($calificacion);
            $review->setDescription($description);
            $review->setIdReserve($idReserve);
            $this->reviewDAO->Add($review);


            $reviewList = $this->reviewDAO->getByIdGuardian($reserve->getIdGuardian());
            /*Reviews de ese Guardian*/
            $cantidad =0;
            $suma =0;

            /* Si tiene calificacion 0 es porque nunca antes tuvo una calificacion*/
            if($reviewList== null)
            {
                $guardian->setCalificacion($calificacion);
            }
            else
            {
                foreach ($reviewList as $review) {

                    $suma = $suma+ $review->getCalificacion();
                    $cantidad = $cantidad+ 1;
                }

                $calificacion =(int) (($suma + $calificacion) / $cantidad);
                $guardian->setCalificacion($calificacion);
            }
            
        $this->guardianDAO->UpdateCalificacion($guardian);
        $this->showHistorialReserves();
    }
    catch (Exception $ex) {
        $alert=[
            "text"=>$ex->getMessage()
        ];
        $this->showOwnerLobby($alert);
    }
        }

        public function optionReview($idReserve)
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $review = $this->reviewDAO->getByIdReserve($idReserve);
            if($review==null)
            {
                $this->goToCalify($idReserve);
            }
            else
            {
            $reservePay= $this->reserveDAO->getByIdReserve($review->getIdReserve());
            $userGuardian=  $this->guardianDAO->getById($reservePay->getIdGuardian());
             require_once(VIEWS_PATH.'Owner/viewReviewOwner.php');
            }
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }

        public function goToCalify($idReserve)
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $reserve = $this->reserveDAO->getByIdReserve($idReserve);
            require_once(VIEWS_PATH.'Owner/newReview.php');
        }
        catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->showOwnerLobby($alert);
        }
        }
        public function VerificarExpiración($reserveList)
        {
            foreach ($reserveList as $reserve)
            {
                $fecha= date("Y-m-d"); 
                if(($reserve->getEstado() == "confirmada") && ($reserve->getFechaInicio()<= $fecha))
                {
                    $reserve->setEstado(6);
                    $this->reserveDAO->update($reserve);
                }
            }
            $newReserveList= $this->reserveDAO->getbyIdOwner($_SESSION["id"]);
            return $newReserveList;
        }
        
    }


?>