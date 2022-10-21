<?php 
    namespace Controllers;
    use DAO\OwnerDAO as OwnerDAO;
    use Models\Owner as Owner;

    class OwnerController
    {
        private  OwnerDAO $ownerDAO;

        public function __construct()
        {
            $this->ownerDAO=new OwnerDAO();
        }

        public function showOwnerLobby()
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            require_once(VIEWS_PATH.'lobbyOwner.php');
        }

        public function showOwnerProfile()
        {
            require_once(VIEWS_PATH.'validate-sesion.php');
            $userOwner = $this->ownerDAO->getByUser($_SESSION["userName"]);
            require_once(VIEWS_PATH.'profileOwner.php');
        }
    }
?>