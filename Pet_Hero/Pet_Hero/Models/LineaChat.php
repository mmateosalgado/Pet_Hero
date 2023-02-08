<?php
namespace Models;

class LineaChat {//Para cada linea de Chat

        private $id;
        private $id_chat;
        
        private $mensaje;

        private $fecha;

        private $user_type;
    
        public function getId() {
            return $this->id;
        }
        
        public function setId($id) {
            $this->id = $id;
            return $this;
        }

        public function getMensaje() {
            return $this->mensaje;
        }
        

        public function setMensaje($mensaje) {
            $this->mensaje = $mensaje;
            return $this;
        }

        public function getFecha() {
            return $this->fecha;
        }
        
        public function setFecha($fecha) {
            $this->fecha = $fecha;
            return $this;
        }

        public function getUser_type() {
            return $this->user_type;
        }
        
        public function setUser_type($user_type) {
            $this->user_type = $user_type;
            return $this;
        }
    

        public function getId_chat() {
            return $this->id_chat;
        }


        public function setId_chat($id_chat) {
            $this->id_chat = $id_chat;
            return $this;
        }
}
?>