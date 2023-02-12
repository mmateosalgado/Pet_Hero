<?php 
    namespace DAO;

    use Models\Reserve as Reserve;
    use DAO\Connection as Connection;
    use \Exception as Exception;

    class ReserveDao
    {
        private $reserveList=array();
        
        private $connection;
        private $tableName;

        public function __construct()
        {
            $this->tableName = "reserve";
            $this->reserveList=array();
        }

        public function GetAll()
        {
            try
            {
                $query = "CALL p_get_reserve();";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
            
                return $this->getReserveList($resultSet);

        
        }
            catch(Exception $ex)
            {
                throw new Exception ("Error al mostrar todas las reservas");
            }
        }

        public function getReserve($resultSet)
        {
            if($resultSet !=  null)
            {
            foreach($resultSet as $row)
            {   $reserve = new Reserve();
                $reserve->setIdReserve($row["id_reserve"]);
                $reserve->setIdGuardian($row["id_guardian"]);
                $reserve->setIdMascota($row["id_pet"]);
                $reserve->setFechaInicio($row["fechaInicio"]);
                $reserve->setFechaFin($row["fechaFin"]);
                $reserve->setTotal($row["total"]);
                $reserve->setEstado($row["estado"]);
                $reserve->setIdOwner($row["id_owner"]);
                $reserve->setTipoMascota($row["animal"]);
                $reserve->setRace($row["race"]);
                return $reserve;
            }
        }
            else 
            {
                return null;
            }
        }

        public function getReserveList($resultSet)
        {
            $array= array();
            if($resultSet !=  null)
            foreach($resultSet as $row){
            {   $reserve = new Reserve();
                $reserve->setIdReserve($row["id_reserve"]);
                $reserve->setIdGuardian($row["id_guardian"]);
                $reserve->setIdMascota($row["id_pet"]);
                $reserve->setFechaInicio($row["fechaInicio"]);
                $reserve->setFechaFin($row["fechaFin"]);
                $reserve->setTotal($row["total"]);
                $reserve->setEstado($row["estado"]);
                $reserve->setIdOwner($row["id_owner"]);
                $reserve->setTipoMascota($row["animal"]);
                $reserve->setRace($row["race"]);
                array_push($array,$reserve);
            }
        }
            return  $array;
        }
        
        public function Add(Reserve $reserve)
        {
            try {
                
            $query = "CALL p_insert_reserve (:pIdGuardian, :pIdMascota, :pFechaInicio, :pFechaFin, :pTotal, :pEstado);";
            $parameters["pIdGuardian"] = $reserve->getIdGuardian();
            $parameters["pIdMascota"] = $reserve->getIdMascota();
            $parameters["pFechaInicio"] = $reserve->getFechaInicio();
            $parameters["pFechaFin"] = $reserve->getFechaFin();
            $parameters["pTotal"] = $reserve->getTotal();
            $parameters["pEstado"]= $reserve->getEstado();
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw new Exception ("Error al agregar la reserva");
            }
        }

        public function getByIdGuardian($idGuardian){
            try
            {
                $query = "CALL p_get_ByIdGuardianReserve(:pIdGuardian);";
                $parameters["pIdGuardian"]=$idGuardian;


            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query,$parameters);

            return $this->getReserveList($resultSet);

        }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar el guardian");
        }
        }

        public function getByIdGuardianConfirm($idGuardian){  /*Trea solo las reservas que esten confirmadas o pagadas*/
            try
            {
                $query = "CALL p_get_ByIdGuardianReserveConfirmadas(:pIdGuardian);";
                $parameters["pIdGuardian"]=$idGuardian;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);

            return $this->getReserveList($resultSet);

        }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar las reservas del guardian");
        }
        }

        public function getByIdGuardianEnEsperaReserve($idGuardian){  /*Trea solo las reservas que esten en espera*/
            try
            {
                $query = "CALL p_get_ByIdGuardianEnEsperaReserve(:pIdGuardian);";
                $parameters["pIdGuardian"]=$idGuardian;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);

            return $this->getReserveList($resultSet);
            }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar las reservas del guardian");
        }
        }

        
        public function getbyIdOwner($idOwner){
            try
            {
                $query = "CALL p_get_ByIdOwnerReserve(:pIdOwner);";
                $parameters["pIdOwner"]=$idOwner;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);

            return $this->getReserveList($resultSet);

            }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar las reservas del owner");
        }
        }

        public function getByIdReserve($idReserve){
            try
            {
                $query = "CALL p_get_ByIdReserve(:pIdReserve);";
                $parameters["pIdReserve"]=$idReserve;

            $this->connection = Connection::GetInstance();

            $row = $this->connection->Execute($query,$parameters);
            return $this->getReserve($row);
          }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar esa reserva");
        }
        }
        public function getbyIdPet($idPet){
            try
            {
                $query = "CALL p_get_ByIdPetReserve(:pIdPet);"; /*Trea solo las reservas que esten confirmadas o pagadas*/
                $parameters["pIdPet"]=$idPet;


            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);

            return $this->getReserveList($resultSet);
        }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar las reservas de esa mascota");
        }
        }

        public function getbyIdGuardianAndPet($idGuardian,$idPet){
            try
            {
                $query = "CALL p_get_ByIdGuardianAndPet(:pIdGuardian, :pIdPet);"; /*Trea solo las reservas que esten confirmadas o pagadas*/
                $parameters["pIdGuardian"]=$idGuardian;
                $parameters["pIdPet"]=$idPet;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);

            return $this->getReserveList($resultSet);
        }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar esas reservas");
        }
        }
        public function VerifyByDateAndRace($idGuardian,$dates,$race,$fechasDispGuardian){
            $this->GetAll();

            foreach($this->reserveList as $reserve){
                $formato="d-m-Y";
                $datesReserve=array();//arreglo con todas las fechas a cubrir x el guardian
                $actual=strtotime($reserve->getFechaInicio());
                $fin=strtotime($reserve->getFechaFin());
                $stepVal='+1 day';
                while($actual<=$fin){
                    $datesReserve[]=date($formato,$actual);
                    $actual=strtotime($stepVal,$actual);
                }

                $arrayDifDates=array_diff($dates,$datesReserve);

                
                if($reserve->getIdGuardian() == $idGuardian && $reserve->getRace() == $race && count(array_diff($arrayDifDates,$fechasDispGuardian))==0){
                    return  true;
                }
            }
            return false;
        }



        public function Update(Reserve $reserve)
        {
            try
            {
            $query = "CALL p_update_reserve( :pIdReserve, :pIdEstado, :pTotal);";

            $parameters["pIdReserve"] = $reserve->getIdReserve();
            $parameters["pIdEstado"]=$reserve->getEstado();
            $parameters["pTotal"]=$reserve->getTotal();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw new Exception ("Error al modificar esa reserva");
            }
        }

        public function Delete($idReserve){
        try
        {
        $query = "CALL p_delete_reserve(:pIdReserve);";
        $parameters["pIdReserve"] = $idReserve;
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query,$parameters);
        }
        catch(Exception $ex)
        {
            throw new Exception ("Error al borrar esa reserva");
        }
        }

        public function ControlarFinalizadas()
        {
            try
            {
                $query = "CALL p_get_ControlarFechas(:pFechaActual);";
                $parameters["pFechaActual"] = $minDate=date('Y-m-d');
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw new Exception ("Error al controlar las reservas");
            }
        }

        public function getUserNameOwnerByIdReserve($idReserve){
            try
            {
                $query = "CALL p_get_usernameOwner(:pIdReserve);";
                $parameters["pIdReserve"]=$idReserve;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
            foreach($resultSet as $row)
            {
                $user = $row["userName"];
            }
            return $user;
          }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar ese usuario");
        }
        }

        public function getUserNameGuardianByIdReserve($idReserve){
            try
            {
                $query = "CALL p_get_usernameGuardian(:pIdReserve);";
                $parameters["pIdReserve"]=$idReserve;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);
            foreach($resultSet as $row)
            {
                $user = $row["userName"];
            }
            return $user;
          }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar ese usuario");
        }
        }
    }
?>