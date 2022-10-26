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
            //$reserve->setId($this->getNextId());
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

        private function SaveData(){
            $arrayToEncode=array();
            foreach($this->reserveList as $reserve){

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

        /*private function getNextId(){
            $id=0;

            foreach($this->reserveList as $reserve){  
                $id=($reserve->getId()>$id) ? $reserve->getId() : $id;
            }

            return $id+1;
        }*/
    }
?>