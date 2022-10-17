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

    public function Index($messasge = "")
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
            if($owner->getPassword()==$password)
            {
                $_SESSION['userName'] = $owner->getUserName();
                $_SESSION['type'] = $owner->getType();
                require_once(VIEWS_PATH."inicio.php");
            }
            
        }elseif($accountType=="guardian")
        {
            $guardian = new Guardian();
            $guardian = $this->guardianDAO->getByUser($user);
            if($guardian->getPassword()==$password)
            {
                $_SESSION['userName'] = $guardian->getUserName();
                $_SESSION['type'] = $guardian->getType();
                require_once(VIEWS_PATH."inicio.php");
            }
        }
        else{
            $this->Index("TIPO DE CUENTA NO ENCOTNRADA");
        }

    }

    public function Register($user,$name,$email,$password,$date,$accountType,$gender)
    {

    }
}
?>