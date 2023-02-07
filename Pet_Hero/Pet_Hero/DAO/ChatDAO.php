<?php 
    namespace DAO;

    use Models\Chat as Chat;
    use Models\LineaChat as LineaChat;
    use DAO\Connection as Connection;
    use \Exception as Exception;

    class ChatDAO
    {
        private $chatList=array();
        
        private $connection;
        private $tableName;

        public function __construct()
        {
            $this->tableName = "chat";
            $this->chatList=array();
        }

        public function GetAll() //TODO Esta función no se va a usar. La borro?
        {
            try
            {
                $query = "CALL p_get_Chat();";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
                return $this->getChat($resultSet);
        
        }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getChat($resultSet)
        {
            if($resultSet !== null) 
            {
                foreach($resultSet as $row) {
                    $id_chat=($row["id_chat"]);

                return $id_chat;
            }
            }
            else 
            {
            return null;
            }
        }

        public function getLineaChat($resultSet)
        {
            if($resultSet !== null) 
            {
                foreach($resultSet as $row) {
                    $LineaChat = new LineaChat();
                    $LineaChat->setId($row["id_lineaChat"]);
                    $LineaChat->setMensaje($row["mensaje"]);
                    $LineaChat->setUser_type($row["user_type"]);
                    $LineaChat->setFecha($row["fecha"]);
                    $LineaChat->setId_chat($row["id_chat"]);
                return $LineaChat;
    
            }
        }
            else 
            {
            return null;
            }
        }

        public function getLineaChatList($resultSet)
        {
            $array= array();
            if($resultSet !== null) 
            {
                foreach($resultSet as $row) {
                $LineaChat = new LineaChat();
                $LineaChat->setId($row["id_lineaChat"]);
                $LineaChat->setMensaje($row["mensaje"]);
                $LineaChat->setUser_type($row["user_type"]);
                $LineaChat->setFecha($row["fecha"]);
                $LineaChat->setId_chat($row["id_chat"]);
                array_push($array,$LineaChat);
            }
        }
            
            return $array;
        }

        public function AddChat($idReserve)
        {
            try {
                
            $query = "CALL p_insert_chat (:pId_Reserve);";
            $parameters["pId_Reserve"] = $idReserve;
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function AddLineaChat(LineaChat $LineaChat)
        {
            try {
                
            $query = "CALL p_insert_lineaChat (:pId_Chat, :pId_usertype, :pMensaje, :pFecha);";
            $parameters["pId_Chat"] = $LineaChat->getId_chat();
            $parameters["pId_usertype"] = $LineaChat->getUser_type();
            $parameters["pMensaje"] = $LineaChat->getMensaje();
            $parameters["pFecha"] = $LineaChat->getFecha();
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getChatByIdreserve($idReserve)
        {
            try
            {
                $query = "CALL p_get_ByIdReserveChat(:pId_reserve);";
                $parameters["pId_Reserve"] = $idReserve;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);
                return $this->getChat($resultSet);
        
        }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function getLineaChatByIdreserve($idReserve)
        {
            try
            {
                $query = "CALL p_get_LineaChatByIdreserve(:pId_reserve);";
                $parameters["pId_Reserve"] = $idReserve;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);
                return $this->getLineaChatList($resultSet);
        
        }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }




        
    }

?>