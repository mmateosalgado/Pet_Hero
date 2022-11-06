<?php 
    namespace DAO;

    use Models\Reserve as Reserve;

    class ReserveDao
    {
        private $reserveList=array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/reserve.json";
        }

        public function Add(Reserve $reserve)
        {
            $this->RetrieveData();
            $reserve->setIdReserve($this->getNextId());
            array_push($this->reserveList, $reserve);
            $this->SaveData();
        }
        
        public function getByIdGuardian($idGuardian){
            $this->RetrieveData();
            $reserveList= array();
            foreach($this->reserveList as $reserve){
                if($reserve->getIdGuardian() == $idGuardian){
                    array_push($reserveList,$reserve);
                }
            }
            return $reserveList;
        }

        
        public function getbyIdOwner($idOwner){
            $this->RetrieveData();
            $reserveList= array();
            foreach($this->reserveList as $reserve){
                if($reserve->getIdOwner() == $idOwner){
                    array_push($reserveList,$reserve);
                }
            }
            return $reserveList;
        }

        public function getByIdReserve($idReserve){
            $this->RetrieveData();
            foreach($this->reserveList as $reserve){
                if($reserve->getIdReserve() == $idReserve){
                    return  $reserve;
                }
            }
            return null;
        }

        public function VerifyByDateAndRace($idGuardian,$dates,$race,$fechasDispGuardian){
            $this->RetrieveData();

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

        private function SaveData(){
            $arrayToEncode=array();
            foreach($this->reserveList as $reserve){
                $valuesArray["idReserve"]= $reserve->getIdReserve();
                $valuesArray["idGuardian"]=$reserve->getIdGuardian();
                $valuesArray["idOwner"]= $reserve->getIdOwner();
                $valuesArray["idMascota"]=$reserve->getIdMascota();
                $valuesArray["fechaInicio"]=$reserve->getFechaInicio();
                $valuesArray["fechaFin"]=$reserve->getFechaFin();
                $valuesArray["tipoMascota"]=$reserve->getTipoMascota();
                $valuesArray["raza"] = $reserve->getrace();
                $valuesArray["total"]=$reserve->getTotal();
                $valuesArray["estado"] = $reserve->getEstado();
                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent=json_encode($arrayToEncode,JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData(){

            $this->reserveList=array();
            if(file_exists($this->fileName)){

                $jsonContent=file_get_contents($this->fileName);
                $arrayToDecode=($jsonContent) ? json_decode($jsonContent,true):array();
                foreach($arrayToDecode as $valuesArray)
                {
                    $reserve=new Reserve();
                    $reserve->setIdReserve($valuesArray["idReserve"]);
                    $reserve->setIdGuardian($valuesArray["idGuardian"]);
                    $reserve->setIdOwner($valuesArray["idOwner"]);
                    $reserve->setIdMascota($valuesArray["idMascota"]);
                    $reserve->setFechaInicio($valuesArray["fechaInicio"]);
                    $reserve->setFechaFin($valuesArray["fechaFin"]);
                    $reserve->setTipoMascota($valuesArray["tipoMascota"]);
                    $reserve->setRace($valuesArray["raza"]);
                    $reserve->setTotal($valuesArray["total"]);
                    $reserve->setEstado($valuesArray["estado"]);
                    array_push($this->reserveList,$reserve);
                }
            }
        }

        public function Update(Reserve $reserve)
        {
            $this->RetrieveData();

            $this->Delete($reserve->getIdReserve());
            array_push($this->reserveList,$reserve);
    
            $this->SaveData();
        }

        public function Delete( $idReserve){
            $this->RetrieveData();
            $aux=0;
    
            foreach ($this->reserveList as $savedReserve) {
                if($savedReserve->getIdReserve()==$idReserve)
                {
                    unset($this->reserveList[$aux]);
                }
                $aux++;
            }
            $this->SaveData();
        }

        private function getNextId(){
            $id=0;

            foreach($this->reserveList as $reserve){  
                $id=($reserve->getIdReserve()>$id) ? $reserve->getIdReserve() : $id;
            }
            return $id+1;
        }
    }
?>