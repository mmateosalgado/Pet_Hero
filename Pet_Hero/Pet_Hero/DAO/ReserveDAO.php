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
            
            foreach($resultSet as $row) 
            {
                $reserve = new Reserve();
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
                array_push($this->reserveList,$reserve);
    
            }
            return $this->reserveList;
        
        }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function Add(Reserve $reserve)
        {
            try {
                $idEstado = $this->GetEstadoId($reserve->getEstado());
                $reserve->setEstado($idEstado);
                
            $query = "CALL p_insert_reserve (".$reserve->getIdGuardian().",".$reserve->getIdMascota().
            ",'".$reserve->getFechaInicio()."','".$reserve->getFechaFin()."',".$reserve->getTotal().",".$reserve->getEstado().");";
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function getByIdGuardian($idGuardian){
            $this->GetAll();
            $reserveList= array();

            foreach($this->reserveList as $reserve){
                if($reserve->getIdGuardian() == $idGuardian){
                    array_push($reserveList,$reserve);
                }
            }
            return $reserveList;
        }

        
        public function getbyIdOwner($idOwner){
            $this->GetAll();
            $reserveList= array();

            foreach($this->reserveList as $reserve){
                if($reserve->getIdOwner() == $idOwner){
                    array_push($reserveList,$reserve);
                }
            }
            return $reserveList;
        }

        public function getByIdReserve($idReserve){
            $this->GetAll();

            foreach($this->reserveList as $reserve){
                if($reserve->getIdReserve() == $idReserve){
                    return  $reserve;
                }
            }
            return null;
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
            $idEstado = $this->GetEstadoId($reserve->getEstado());
            $query = "CALL p_update_reserve(".$reserve->getIdReserve().",".$idEstado.",".$reserve->getTotal().");";
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
             }
            catch(Exception $ex)
            {
            throw $ex;
            }
        }

        public function Delete($idReserve){
        try
        {
        $query = "CALL p_delete_reserve('".$idReserve."');";
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query);
         }
        catch(Exception $ex)
        {
        throw $ex;
        }
           
        }


        public function GetEstadoId($estado)
        {
            try
            {
            $id = null;
    
            $query = "CALL p_get_IdEstado('".$estado."');";
            $this->connection = Connection::GetInstance();
            $resultSet= $this->connection->Execute($query);
            foreach ($resultSet as $row)
            {                
                $id=($row["id_estado"]);
            }
            return $id;
        }
            catch(Exception $ex)
            {
            throw $ex;
            }
        }

        public function GetAllByUser($user){//retorna todas las reservas de un user
            $this->GetAll();
            $reservas=array();

            foreach($this->reserveList as $reserve){
                if($reserve->getUserName() == $user){ //TODO reserva no tiene getUserName
                    array_push($reservas,$reserve);
                }
            }

            return $reservas;
        }
    }
?>