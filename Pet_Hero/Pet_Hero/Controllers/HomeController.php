<?php
namespace Controllers;
use DAO\GuardianDAO as GuardianDAO;
use DAO\OwnerDAO as OwnerDAO;
use Models\Guardian;
use Models\Owner;
class HomeController
{
        private $ownerDAO;
        private $guardianDAO;

        public function __construct()
        {
        $this->ownerDAO = new OwnerDAO();
        $this->guardianDAO = new GuardianDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function ViewRegister()
        {
            require_once(VIEWS_PATH."register.php");
        }

        public function Login($user,$password,$accountType)
        {
            if($accountType=="owner")
            {   
                $owner = new Owner();
                $owner = $this->ownerDAO->getByUser($user);
                if(isset($owner))
                {
                if($owner->getPassword()==$password)
                {
                    $_SESSION['userName'] = $owner->getUserName();
                    $_SESSION['type'] = $owner->getType();
                    $_SESSION["id"]= $owner->getId();
                    require_once(VIEWS_PATH."lobbyOwner.php");
                
                }else
                {
                    $this->Index("Usuario o contraseña incorrectos"); 
                }}else
                {
                    $this->Index("Usuario o contraseña incorrectos"); 
                }
                
            }elseif($accountType=="guardian")
            {
                $guardian = new Guardian();
                $guardian = $this->guardianDAO->getByUser($user);
                if(isset($guardian))
                {
                if($guardian->getPassword()==$password)
                {
                    $_SESSION['userName'] = $guardian->getUserName();
                    $_SESSION['type'] = $guardian->getType();
                    $_SESSION['URL'] = $guardian->getCalificacion();
                    require_once(VIEWS_PATH.'lobbyGuardian.php');
                }else
                {
                    $this->Index("Usuario o contraseña incorrectos"); 
                }}else
                {
                    $this->Index("Usuario o contraseña incorrectos"); 
                }
            }
            else{
                $this->Index("TIPO DE CUENTA NO ENCONTRADA");
            }

        }

        public function Register($user,$name,$email,$password,$date,$accountType,$gender,$telefono)
        {
            if($accountType=="owner")
            {   
                $validacionOwnerUser=$this->ownerDAO->getByUser($user);

                if($validacionOwnerUser!=null){
                    $this->Index("- El usuario ya existe!");
                }else{
                    $validacionOwnerEmail=$this->ownerDAO->getByEmail($email);

                    if($validacionOwnerEmail!=null){
                        $this->Index("- No se puede crear mas de una cuenta por EMAIL!");
                    }else{
                        $owner = new Owner();

                        $owner->setUserName($user);
                        $owner->setPassword($password);
                        $owner->setFullName($name);
                        $owner->setAge($date);//fecha de nacimiento 
                        $owner->setEmail($email);
                        $owner->setGender($gender);
                        $owner->setType( $accountType);
                        $owner->setTelefono($telefono);
                        $this->ownerDAO->Add($owner);
                        require_once(VIEWS_PATH."login.php");
                    }
                }
            }
            else if($accountType=="guardian")
            {
                $validacionGuardianUser=$this->guardianDAO->getByUser($user);
                if($validacionGuardianUser!=null){
                    $this->Index("- El usuario ya existe!");
                }else {
                    $validacionGuardianEmail=$this->guardianDAO->getByEmail($email);

                    if($validacionGuardianEmail!=null){
                        $this->Index("- No se puede crear mas de una cuenta por EMAIL!");
                    }else{
                        $this->Index("- Cuenta creada exitosamente!!");
                    }
                }
            }
        }
        public function Logout()
        {
            session_destroy();

            $this->Index("Sesión Cerrada con éxito");
        }
    }
?>