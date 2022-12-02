<?php
namespace Controllers;
use DAO\GuardianDAO as GuardianDAO;
use DAO\OwnerDAO as OwnerDAO;
use DAO\PetDao as PetDao;
use DAO\ReserveDao as ReserveDao;

use Exception;
use Models\Guardian;
use Models\Owner;
class HomeController
{
        private $ownerDAO;
        private $guardianDAO;
        private $petDAO;

        private ReserveDao $reserveDAO;

        public function __construct()
        {
        $this->ownerDAO = new OwnerDAO();
        $this->guardianDAO = new GuardianDAO();
        $this->petDAO = new PetDao();
        $this->reserveDAO=new ReserveDAO();
        }

        public function Index($alert = null)
        {
            require_once(VIEWS_PATH."Home/login.php");
        }

        public function ViewRegister($alert=null)
        {
            require_once(VIEWS_PATH."Home/register.php");
        }

        public function Login($user,$password,$accountType)
        {
        try {
            if ($accountType == "owner") {
                $owner = new Owner();
                $owner = $this->ownerDAO->getByUser($user);
                if (isset($owner)) {
                    if ($owner->getPassword() == $password) {
                        $_SESSION['userName'] = $owner->getUserName();
                        $_SESSION['type'] = $owner->getType();
                        $_SESSION["id"] = $owner->getId();
                        $guardianList = $this->guardianDAO->GetAll();
                        $petList = array();
                        $petList = $this->petDAO->getAllByOwnerId($_SESSION["id"]);
                        require_once(VIEWS_PATH . "Owner/lobbyOwner.php");

                    } else {
                        throw new Exception("- Usuario o contraseña incorrectos!");
                    }
                } else {
                    throw new Exception("- Usuario o contraseña incorrectos!");
                }

            } elseif ($accountType == "guardian") {
                $guardian = new Guardian();
                $guardian = $this->guardianDAO->getByUser($user);
                if (isset($guardian)) {
                    if ($guardian->getPassword() == $password) {
                        $_SESSION['userName'] = $guardian->getUserName();
                        $_SESSION['type'] = $guardian->getType();
                        $_SESSION['URL'] = $guardian->getCalificacion();
                        $_SESSION["id"] = $guardian->getId();

                        $reserveList = array();
                        $reserveList = $this->reserveDAO->getByIdGuardian($_SESSION["id"]);
                        $petList = $this->petDAO->GetAll();

                        require_once(VIEWS_PATH . 'Guardian/lobbyGuardian.php');
                    } else {
                        throw new Exception("- Usuario o contraseña incorrectos!");
                    }
                } else {
                    throw new Exception("- Usuario o contraseña incorrectos!");
                }
            } else {
                throw new Exception("- Tipo de cuenta no encontrada!");
            }
        }
            catch(Exception $ex){
                $alert=[
                    "text"=>$ex->getMessage()
                ];

                $this->Index($alert);
            }
        }

        public function Register($user,$name,$email,$password,$date,$accountType,$gender,$telefono)
        {
            try{
                if($accountType=="owner")
                {   
                    $validacionOwnerUser=$this->ownerDAO->getByUser($user);

                    if($validacionOwnerUser!=null){
                        throw new Exception("- El usuario ya existe!");
                    }else{
                        $validacionOwnerEmail=$this->ownerDAO->getByEmail($email);

                        if($validacionOwnerEmail!=null){
                            throw new Exception("- No se puede crear mas de una cuenta por EMAIL!");
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
                            $this->Index("- Cuenta creada exitosamente!!");
                        }
                    }
                }
                else if($accountType=="guardian")
                {
                    $validacionGuardianUser=$this->guardianDAO->getByUser($user);
                    if($validacionGuardianUser!=null){
                        throw new Exception("- El usuario ya existe!");
                    }else {
                        $validacionGuardianEmail=$this->guardianDAO->getByEmail($email);

                        if($validacionGuardianEmail!=null){
                            throw new Exception("- No se puede crear mas de una cuenta por EMAIL!");
                        }else{
                            require_once(VIEWS_PATH."Guardian/registerGuardian.php");
                        }
                    }
                }

            }catch(Exception $ex){
                $alert=[
                    "text"=>$ex->getMessage()
                ];
                $this->ViewRegister($alert);
            }
        }
        public function Logout()
        {
        try {
            session_destroy();
            throw new Exception("- Sesión cerrada con éxito");
        } catch (Exception $ex) {
            $alert=[
                "text"=>$ex->getMessage()
            ];
            $this->Index($alert);
        }
        }
    }
?>