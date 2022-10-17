<?php 
    namespace Models;

    use Models\User as User;

    class Owner extends User{

        private $id;//id igual al User correspondiente;

        private $petsList;

        public function __construct($id=null,$userName=null,$password=null,$fullname=null,$age=null,$email=null,$gender=null,$type=null)
        {
            parent::__construct($id,$userName,$password,$fullname,$age,$email,$gender,$type);
            $this->id=$id;
            $this->petsList=array();
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getPetsList(){
            return $this->petsList;
        }

        public function setPetsList($petsList){
            $this->petsList=$petsList;
        }
/*
        public function AddPet($newPet){

        }

        public function DeltePet($newPet){
            
        }
*/
    }
?>