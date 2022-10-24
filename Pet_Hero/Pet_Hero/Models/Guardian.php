<?php 
    namespace Models;

    use Models\User as User;
    class Guardian extends User{

        private $cuil;
        private $precioPorHora;
        private $calificacion;

		private $fechaFin;

		private $fechaInicio;
		private $fotoPerfil;
        public function __construct($id=null,$userName=null,$password=null,$fullname=null,$age=null,$email=null,$gender=null,$type=null,$cuil=null,$precioPorHora=null,$calificacion=null,$telefono=null,$fechaInicio=null, $fechaFin=null,$fotoPerfil=null)
        {
            parent::__construct($id,$userName,$password,$fullname,$age,$email,$gender,$type,$telefono);
            $this->id=$id;
            $this->cuil=$cuil;
            $this->precioPorHora= $precioPorHora;
            $this->calificacion= $calificacion;
			$this->fechaInicio = $fechaInicio;
			$this->fechaFin = $fechaFin;
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

	function getFechaFin() {
		return $this->fechaFin;
	}
	



	function setFechaFin($fechaFin) {
		$this->fechaFin = $fechaFin;
		return $this;
	}
	

	function getFechaInicio() {
		return $this->fechaInicio;
	}
	

	function setFechaInicio($fechaInicio) {
		$this->fechaInicio = $fechaInicio;
		return $this;
	}

	function getFotoPerfil() {
		return $this->fotoPerfil;
	}
	

	function setFotoPerfil($fotoPerfil) {
		$this->fotoPerfil = $fotoPerfil;
		return $this;
	}
}
?>