<?php
    namespace Controllers;
    use Models\Owner as Owner;
    use Models\Chat as Chat;
    use Models\LineaChat as LineaChat;

    use DAO\ChatDAO as ChatDAO;
    use DAO\ReserveDao as ReserveDao;
    use DAO\OwnerDAO as OwnerDAO;
    use \Exception as Exception;

        class ChatController
        {
            private ChatDAO $chatDAO;
            private ReserveDao $reserveDao;
            private OwnerDAO $ownerDAO;
        public function __construct()
        {
            $this->chatDAO=new ChatDAO();
            $this->reserveDao=new ReserveDao();
            $this->ownerDAO=new OwnerDAO();
        }

        public function Index($user, $idReserve, $alert='')
        {
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            
            $chatUser = $this->chatDAO->getLineaChatByIdreserve($idReserve);
            $chat = new Chat();
            $chat->setId_reserva($idReserve);
            //  --------------Ya está en User --------------------------------//
           // $other;//Nombre Persona con la que chateamos

                if($_SESSION['type'] == 'guardian')
                {
                    $owner = New Owner();
                    $owner= $this->ownerDAO->getById($user);
                    $user = $owner->getUserName();
                }

                require_once(VIEWS_PATH."chat/chat.php");

            }
            catch (Exception $ex) {
                $alert=[
                    "text"=>$ex->getMessage()
                ];
                require_once(VIEWS_PATH."chat/chat.php");
            }
        }
        
        public function sendMessage($message, $user, $id_reserve)
        {        
            try{
            require_once(VIEWS_PATH.'Section/validate-sesion.php');

            $fecha = date('d/m/y h:i:s');
            $chat =  new Chat(); 

            $chat  = $this->chatDAO->getChatByIdreserve($id_reserve); //trae todas las lineas de chat con el id de la reserva en cuestion
            
            $chat->setId_reserva($id_reserve);  //seteamos el id de la reserva en cuestion
            
            $lineaChat = new LineaChat();
            $lineaChat->setFecha($fecha); // hora actual
            $lineaChat->setId_chat($chat->getId());
            $lineaChat->setMensaje($message);

            if($_SESSION['type'] == 'guardian')
            {
                $lineaChat->setUser_type(0);
            }
            else
            {
                $lineaChat->setUser_type(1);
            }

            $this->chatDAO->AddLineaChat($lineaChat);

            $chatUser = $this->chatDAO->getLineaChatByIdreserve($id_reserve);
            $this->Index($user,$id_reserve);
            }
            catch (Exception $ex) {
                $alert=[
                    "text"=>$ex->getMessage()
                ];
                require_once(VIEWS_PATH."chat/chat.php");
            }
        }

        }
?>