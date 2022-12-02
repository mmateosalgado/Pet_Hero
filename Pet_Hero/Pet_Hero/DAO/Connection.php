<?php
    namespace DAO;

    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType AS QueryType;
    class Connection
    {
        private $pdo = null;
        private $pdoStatement = null;
        private static $instance = null;

        private function __construct()
        {
            try
            {
                $this->pdo = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $ex)
            {
                throw new Exception ("Error en la BBDD ". $ex->getMessage());
            }
        }

        public static function GetInstance()
        {
            if(self::$instance == null)
                self::$instance = new Connection();

            return self::$instance;
        }

        public function Execute($query, $parameters = array(), $queryType = QueryType::Query)
	    {
            try
            {
                $this->Prepare($query);
                
                $this->BindParameters($parameters, $queryType);
                
                $this->pdoStatement->execute();

                return $this->pdoStatement->fetchAll();
            }
            catch(Exception $ex)
            {
                throw new Exception ("Error en la Ejecución". $ex->getMessage());
            }
        }
        
        public function ExecuteNonQuery($query, $parameters = array(), $queryType = QueryType::Query)
	    {            
            try
            {
                $this->Prepare($query);
                
                $this->BindParameters($parameters, $queryType);

                $this->pdoStatement->execute();

                return $this->pdoStatement->rowCount();
            }
            catch(Exception $ex)
            {
                throw new Exception ("Error en la Ejecución Sin Query". $ex->getMessage());
            }        	    	
        }
        
        private function Prepare($query)
        {
            try
            {
                $this->pdoStatement = $this->pdo->prepare($query);
            }
            catch(Exception $ex)
            {
                throw new Exception ("Error en la Preparación". $ex->getMessage());
            }
        }
        
        private function BindParameters($parameters = array(), $queryType = QueryType::Query)
        {
            $i = 0;

            foreach($parameters as $parameterName => $value)
            {                
                $i++;

                if($queryType == QueryType::Query)
                    $this->pdoStatement->bindParam(":".$parameterName, $parameters[$parameterName]);
                else
                    $this->pdoStatement->bindParam($i, $parameters[$parameterName]);
            }
        }
    }
?>