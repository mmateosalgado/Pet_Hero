<?php
namespace Models;
class Reserve
{
    private $idGuardian;
    private $idOwner;
    private $fechaInicio;
    private $fechaFin;
    private $total;
    private $idMascota;
            
            function __construct($idGuardian=null, $idOwner=null, $fechaInicio=null, $fechaFin=null, $total=null, $idMascota=null) {
                $this->idGuardian = $idGuardian;
                $this->idOwner = $idOwner;
                $this->fechaInicio = $fechaInicio;
                $this->fechaFin = $fechaFin;
                $this->total = $total;
                $this->idMascota = $idMascota;
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
    }

?>