<?php 
    namespace Models;

    class Pet{
        public $id;
        public $idOwner;
        public $name;
        public $animal;
        public $race;
        public $description;
        public $age;
        public $grXfoodPortion;
        public $weight;

        public function __construct($id=null,$idOwner=null,$name=null,$animal=null,$race=null,$description=null,$age=null,$grXfoodPortion=null,$weight=null){
            $this->id = $id;
            $this->idOwner = $idOwner;
            $this->name = $name;
            $this->animal = $animal;
            $this->race = $race;
            $this->description = $description;
            $this->age = $age;
            $this->grXfoodPortion = $grXfoodPortion;
            $this->weight = $weight;
        }

        public function getId(){
            return $this->id;
        }

        public function getIdOwner(){
            return $this->idOwner;
        }

        public function getName(){
            return $this->name;
        }

        public function getAnimal(){
            return $this->animal;
        }

        public function getRace(){
            return $this->race;
        }

        public function getDescription(){
            return $this->description;
        }

        public function getAge(){
            return $this->age;
        }

        public function getGrXfoodPortion(){
            return $this->grXfoodPortion;
        }

        public function getWeight(){
            return $this->weight;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setIdOwner($idOwner){
            $this->idOwner = $idOwner;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function setAnimal($animal){
            $this->animal = $animal;
        }

        public function setRace($race){
            $this->race = $race;
        }

        public function setDescription($description){
            $this->description = $description;
        }

        public function setAge($age){
            $this->age = $age;
        }

        public function setGrXfoodPortion($grXfoodPortion){
            $this->grXfoodPortion = $grXfoodPortion;
        }

        public function setWeight($weight){
            $this->weight = $weight;
        }
    }
?>