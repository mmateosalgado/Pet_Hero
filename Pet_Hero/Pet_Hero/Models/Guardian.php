<?php 
    namespace Models;

    use Models\User as User;
    class Guardian extends User{

        private $cuil;
        private $precioPorHora;
        private $calificacion;
		private $fechasDisponibles;
		private $fotoPerfil;
		private $tamanioParaCuidar;
        public function __construct($id=null,$userName=null,$password=null,$fullname=null,$age=null,$email=null,$gender=null,$type=null,$cuil=null,$precioPorHora=null,$calificacion=null,$telefono=null,$fotoPerfil=null,$tamanioParaCuidar=null)
        {
            parent::__construct($id,$userName,$password,$fullname,$age,$email,$gender,$type,$telefono);
            $this->id=$id;
            $this->cuil=$cuil;
            $this->precioPorHora= $precioPorHora;
            $this->calificacion= $calificacion;
			$this->fechasDisponibles= array();
			$this->fotoPerfil = $fotoPerfil;
			$this->tamanioParaCuidar= $tamanioParaCuidar;
        }

	function getCuil() {
		return $this->cuil;
	}

	function getPrecioPorHora() {
		return $this->precioPorHora;
	}

	function getCalificacion() {
		return $this->calificacion;
	}

	function setCuil($cuil) {
		$this->cuil = $cuil;
		return $this;
	}
	

	function setPrecioPorHora($precioPorHora) {
		$this->precioPorHora = $precioPorHora;
		return $this;
	}

	function setCalificacion($calificacion) {
		$this->calificacion = $calificacion;
		return $this;
	}

	function setFechasDisponibles($fechasDisponibles) {
		$this->fechasDisponibles = $fechasDisponibles;
	}

	function getFechasDisponibles(){
		return $this->fechasDisponibles;
	}


	function getFotoPerfil() {
		return $this->fotoPerfil;
	}
	

	function setFotoPerfil($fotoPerfil) {
		$this->fotoPerfil = $fotoPerfil;
		return $this;
	}

	function getTamanioParaCuidar() {
		return $this->tamanioParaCuidar;
	}
	

	function setTamanioParaCuidar($tamanioParaCuidar) {
		$this->tamanioParaCuidar = $tamanioParaCuidar;
		return $this;
	}
}
?>