<?php
namespace Models;
class Reserve
{
    private $idReserve;
    private $idGuardian;
    private $idOwner;
    private $fechaInicio;
    private $fechaFin;
    private $total;
    private $idMascota;
    private $tipoMascota;
    private $race;

    private $estado; /*-Espera(cuando tiene que aceptarlo el guardian)
                       -Aceptado (si lo acepta el guardian)
                       -Rechazado(si lo rechaza el guardian)
                       -Finalizado(si se cumple el contrato)*/
            
            function __construct($idReserve=null,$idGuardian=null, $idOwner=null, $fechaInicio=null, $fechaFin=null, $total=null, $idMascota=null,$tipoMascota=null,$race=null,$estado=null) {
                $this->idReserve = $idReserve;
                $this->idGuardian = $idGuardian;
                $this->idOwner = $idOwner;
                $this->fechaInicio = $fechaInicio;
                $this->fechaFin = $fechaFin;
                $this->total = $total;
                $this->idMascota = $idMascota;
                $this->tipoMascota= $tipoMascota;
                $this->race = $race;
                $this->estado= $estado;
                }

            function getIdGuardian() {
                return $this->idGuardian;
                }
            function getIdOwner() {
                return $this->idOwner;
                }
            function getFechaInicio() {
                return $this->fechaInicio;
                }
            function getFechaFin() {
                return $this->fechaFin;
                }
            function getTotal() {
                return $this->total;
                }
            function getIdMascota() {
                return $this->idMascota;
                }
            function setIdGuardian($idGuardian) {
                $this->idGuardian = $idGuardian;
                return $this;
                }
            
            function setIdOwner($idOwner) {
                $this->idOwner = $idOwner;
                return $this;
                }
            
            function setFechaInicio($fechaInicio) {
                $this->fechaInicio = $fechaInicio;
                return $this;
                }
            
            function setFechaFin($fechaFin) {
                $this->fechaFin = $fechaFin;
                return $this;
                }
            
            function setTotal($total) {
                $this->total = $total;
                return $this;
                }
            
            function setIdMascota($idMascota) {
                $this->idMascota = $idMascota;
                return $this;
                }

	function getTipoMascota() {
		return $this->tipoMascota;
	}
	

	function setTipoMascota($tipoMascota) {
		$this->tipoMascota = $tipoMascota;
		return $this;
	}
	

	function getRace() {
		return $this->race;
	}

	function setRace($race) {
		$this->race = $race;
		return $this;
	}

	function getEstado() {
		return $this->estado;
	}
	

	function setEstado($estado) {
		$this->estado = $estado;
		return $this;
	}

	function getIdReserve() {
		return $this->idReserve;
	}

	function setIdReserve($idReserve) {
		$this->idReserve = $idReserve;
		return $this;
	}
}

?>