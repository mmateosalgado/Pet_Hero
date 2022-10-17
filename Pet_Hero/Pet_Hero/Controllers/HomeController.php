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
                require_once(VIEWS_PATH."inicio.php");
              
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
                require_once(VIEWS_PATH."inicio.php");
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

    public function Register($user,$name,$email,$password,$date,$accountType,$gender)
    {
        if($accountType=="owner")
        {   
            $owner = new Owner();

            $owner->setUserName($user);
            $owner->setPassword($password);
            $owner->setFullName($name);
           // $owner->setAge($valuesArray["age"]);
            $owner->setEmail($email);
            $owner->setGender($gender);
            $owner->setType( $accountType);

            $this->ownerDAO->Add($owner);
            $this->Index("Registro exitoso");
            
        }elseif($accountType=="guardian")
        {
            $guardian = new Guardian();

            $guardian->setUserName($user);
            $guardian->setPassword($password);
            $guardian->setFullName($name);
           // $guardian->setAge($valuesArray["age"]);
            $guardian->setEmail($email);
            $guardian->setGender($gender);
            $guardian->setType( $accountType);

            $this->guardianDAO->Add($guardian);
            require_once(VIEWS_PATH."registerGuardian.php");
            
        }

          
    }
}
?>