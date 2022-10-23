<?php
    namespace Models;

    abstract class User{

        private $id;
        private $userName;
        private $password;
        private $fullname;
        private $age;
        private $email;
        private $gender;
        private $type;

        private $telefono;

        public function __construct($id=null,$userName=null,$password=null,$fullname=null,$age=null,$email=null,$gender=null,$type=null,$telefono=null)
        {
            $this->id=$id;
            $this->userName=$userName;
            $this->password=$password;
            $this->fullname=$fullname;
            $this->age=$age;
            $this->email=$email;
            $this->gender=$gender;
            $this->type=$type;
            $this->telefono=$telefono;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getUserName() {
            return $this->userName;
        }

        public function setUserName($userName){
            $this->userName = $userName;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password): self {
            $this->password = $password;
            return $this;
        }

        public function getFullName(){
            return $this->fullname;
        }

        public function setFullname($fullname){
            $this->fullname = $fullname;
        }

        public function getAge(){
            return $this->age;
        }

        public function setAge($age){
            $this->age = $age;
        }

        public function getEmail(){
            return $this->email;
        }
        
        public function setEmail($email){
            $this->email = $email;
        }
        
        public function getGender(){
            return $this->gender;
        }

        public function setGender($gender){
            $this->gender = $gender;
        }

        public function getType()
        {
            return $this->type;
        }
        
        public function setType($type){
            $this->type = $type;
        }
    
	function getTelefono() {
		return $this->telefono;
	}

	function setTelefono($telefono): self {
		$this->telefono = $telefono;
		return $this;
	}
}
?>