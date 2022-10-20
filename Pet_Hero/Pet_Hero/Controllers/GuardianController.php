<?php 
    namespace Controllers;
    use DAO\GuardianDAO as GuardianDAO;
    use Models\Guardian as Guardian;

    class GuardianController
    {
        private GuardianDAO $guardianDAO;

        public function __construct()
        {
            $this->guardianDAO=new GuardianDAO();
        }

        public function addCuilAndPPH($user,$name,$email,$password,$date,$accountType,$gender,$cuil,$pph){//PPH-> precio por hora o price per hour
            $guardian=new Guardian();

            $guardian->setUserName($user);
            $guardian->setPassword($password);
            $guardian->setFullName($name);
            $guardian->setAge($date);//fecha nacimiento
            $guardian->setEmail($email);
            $guardian->setGender($gender);
            $guardian->setType( $accountType);
            $guardian->setCuil($cuil);
            $guardian->setPrecioPorHora($pph);

            require_once(VIEWS_PATH.'testeo.php');
        }
    }
?>