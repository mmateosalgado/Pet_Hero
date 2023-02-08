<?php
namespace Models;

class Chat {

        private $id;

        private $id_reserva;

        private $mensajesGuardian;

        private $mensajesDueno;

        public function __construct()
        {
            $this->mensajesDueno=array();
            $this->mensajesGuardian=array();
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function setId($id) {
            $this->id = $id;
            return $this;
        }

        public function getId_reserva() {
            return $this->id_reserva;
        }

        public function setId_reserva($id_reserva) {
            $this->id_reserva = $id_reserva;
            return $this;
        }
    

        public function getMensajesGuardian() {
            return $this->mensajesGuardian;
        }
        

        public function setMensajesGuardian($mensajesGuardian) {
            $this->mensajesGuardian = $mensajesGuardian;
            return $this;
        }

        public function getMensajesDueno() {
            return $this->mensajesDueno;
        }
        
        public function setMensajesDueno($mensajesDueno) {
            $this->mensajesDueno = $mensajesDueno;
            return $this;
        }
}
?>