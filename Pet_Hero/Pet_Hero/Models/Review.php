<?php
namespace Models;
class Review
{
    private $idReview;
    private $idReserve;
    private $idGuardian;
    private $calificacion;
    private $description;
            
            function __construct($idReview=null, $idReserve=null,$idGuardian=null, $calificacion=null,$description=null) {
                $this->idReview = $idReview;
                $this->idReserve = $idReserve;
                $this->idGuardian = $idGuardian;
                $this->calificacion = $calificacion;
                $this->description = $description;
                }

            function getIdGuardian() {
                return $this->idGuardian;
                }

            function getCalificacion() {
                return $this->calificacion;
                }
            function getDescription() {
                return $this->description;
                }
                
            function getIdReserve() {
                return $this->idReserve;
            }
            function setIdGuardian($idGuardian) {
                $this->idGuardian = $idGuardian;
                return $this;
                }
            
            function setCalificacion($calificacion) {
                $this->calificacion = $calificacion;
                return $this;
                }
            
            function setDescription($description) {
                $this->description = $description;
                return $this;
                }
            
        function setIdReserve($idReserve) {
                        $this->idReserve = $idReserve;
                        return $this;
                    }


	public function getIdReview() {
		return $this->idReview;
	}


	public function setIdReview($idReview) {
		$this->idReview = $idReview;
		return $this;
	}
}

?>