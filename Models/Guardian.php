<?php 
    namespace Models;

    use Models\User as User;
    class Guardian extends User{

        private $cuil;
        private $precioPorHora;
        private $calificacion;
        public function __construct($id=null,$userName=null,$password=null,$fullname=null,$age=null,$email=null,$gender=null,$type=null,$cuil=null,$precioPorHora=null,$calificacion=null)
        {
            parent::__construct($id,$userName,$password,$fullname,$age,$email,$gender,$type);
            $this->id=$id;
            $this->cuil=$cuil;
            $this->precioPorHora= $precioPorHora;
            $this->calificacion= $calificacion;
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
}
?>