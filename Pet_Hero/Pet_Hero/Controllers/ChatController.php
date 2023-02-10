<?php
    namespace Controllers;
    use Models\Chat as Chat;
    use Models\LineaChat as LineaChat;

    use DAO\ChatDAO as ChatDAO;
    use DAO\ReserveDao as ReserveDao;
    use \Exception as Exception;

        class ChatController
        {
            private ChatDAO $chatDAO;
            private ReserveDao $reserveDao;
            
        public function __construct()
        {
            $this->chatDAO=new ChatDAO();
            $this->reserveDao=new ReserveDao();
        }

        public function Index($alert='',$idReserve)//TODO: Hay que encontrar la forma de que reciba la idReserve
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            
            $chat = $this->chatDAO->getLineaChatByIdreserve($idReserve);
            $other;//Nombre Persona con la que chateamos
                //TODO: Traer Nombre Usuario al que le chateamos, 
                //podriamos hacer una query que solo con el idReserve nos lo traiga (para hacerlo mas eficiente),
                //Deberia ir el reserveDAO

                if($_SESSION['type'] == 'guardian')
                {
                    $other= $this->reserveDao->getUserNameGuardianByIdReserve($idReserve);
                }
                else
                {
                    $other= $this->reserveDao->getUserNameOwnerByIdReserve($idReserve);
                }

            require_once(VIEWS_PATH."chat.php");
        }
        
        public function sendMessage($id_reserve, $message, $fecha)
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $id_chat  = $this->chatDAO->getChatByIdreserve($id_reserve);
            
            $lineaChat = new LineaChat();
            $lineaChat->setFecha($fecha);
            $lineaChat->setId_chat($id_chat);
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

            $chatList = $this->chatDAO->getLineaChatByIdreserve($id_reserve);
            //Mostrar view de Chat
        }

        }
?>