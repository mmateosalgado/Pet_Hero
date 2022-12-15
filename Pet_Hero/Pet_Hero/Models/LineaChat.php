<?php
namespace Models;

class LineaChat {//Para cada linea de Chat

        private $id;
        
        private $mensaje;

        private $fecha;

        private $id_user;
    
        public function getId() {
            return $this->id;
        }
        
        public function setId($id): self {
            $this->id = $id;
            return $this;
        }

        public function getMensaje() {
            return $this->mensaje;
        }
        

        public function setMensaje($mensaje): self {
            $this->mensaje = $mensaje;
            return $this;
        }

        public function getFecha() {
            return $this->fecha;
        }
        
        public function setFecha($fecha): self {
            $this->fecha = $fecha;
            return $this;
        }

        public function getId_user() {
            return $this->id_user;
        }
        
        public function setId_user($id_user): self {
            $this->id_user = $id_user;
            return $this;
        }
    }
?>