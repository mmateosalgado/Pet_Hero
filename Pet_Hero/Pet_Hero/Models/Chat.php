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
        
        public function setId($id): self {
            $this->id = $id;
            return $this;
        }

        public function getId_reserva() {
            return $this->id_reserva;
        }

        public function setId_reserva($id_reserva): self {
            $this->id_reserva = $id_reserva;
            return $this;
        }
    }
?>