<?php
    namespace Controllers;
    use Models\Chat as Chat;
    use Models\LineaChat as LineaChat;

    use DAO\ChatDAO as ChatDAO;
    use \Exception as Exception;

        class ChatController
        {
            private ChatDAO $chatDAO;
            
        public function __construct()
        {
            $this->chatDAO=new ChatDAO();
        }

        public function Index($alert='',$idReserve)//TODO: Hay que encontrar la forma de que reciva la idReserve
        {
            require_once(VIEWS_PATH.'Section/validate-sesion.php');
            $chat = $this->chatDAO->getLineaChatByIdreserve($idReserve);
            $other;//Nombre Persona con la que chateamos
                //TODO: Traer Nombre Usuario al que le chateamos, 
                //podriamos hacer una query que solo con el idReserve nos lo traiga (para hacerlo mas eficiente),
                //Deberia ir el reserveDAO
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