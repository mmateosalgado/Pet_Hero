<?php 
    namespace DAO;

    use Models\Review as Review;
    use DAO\Connection as Connection;
    use \Exception as Exception;

    class ReviewDAO
    {
        private $reserveList=array();
        
        private $connection;
        private $tableName;

        public function __construct()
        {
            $this->tableName = "review";
            $this->reserveList=array();
        }

        public function GetAll()
        {
            try
            {
                $query = "CALL p_get_Review();";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
            
            foreach($resultSet as $row) 
            {
                $review = new Review();
                $review->setIdReview($row["id_review"]);
                $review->setIdReserve($row["id_reserve"]);
                $review->setIdGuardian($row["id_Guardian"]);
                $review->setCalificacion($row["calificacion"]);
                $review->setDescription($row["description"]);
                array_push($this->reserveList,$review);
    
            }
            return $this->reserveList;
        
        }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Add(Review $review)
        {
            try {
                
            $query = "CALL p_insert_review (:pId_Reserve, :pCalificacion, :pDescription);";
            $parameters["pId_Reserve"] = $review->getIdReserve();
            $parameters["pCalificacion"] = $review->getCalificacion();
            $parameters["pDescription"] = $review->getDescription();
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByIdGuardian($idGuardian){
            try
            {
                $query = "CALL p_get_ByIGuardianReview(:pIdGuardian);";
                $parameters["pIdGuardian"]=$idGuardian;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);

            foreach($resultSet as $row) 
            {
                $review = new Review();
                $review->setIdReview($row["id_review"]);
                $review->setIdReserve($row["id_reserve"]);
                $review->setIdGuardian($row["id_guardian"]);
                $review->setCalificacion($row["calificacion"]);
                $review->setDescription($row["description"]);
                array_push($this->reserveList,$review);
    
            }
            return $this->reserveList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
        }
        public function getByIdReserve($idReserve){
            try
            {
                $query = "CALL p_get_ByIdReserveReview(:pIdReserve);";
                $parameters["pIdReserve"]=$idReserve;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);

            foreach($resultSet as $row) 
            {
                $review = new Review();
                $review->setIdReview($row["id_review"]);
                $review->setIdReserve($row["id_reserve"]);
                $review->setIdGuardian($row["id_Guardian"]);
                $review->setCalificacion($row["calificacion"]);
                $review->setDescription($row["description"]);
                return $review;
    
            }
            return null;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
        }

        public function getByIdReview($idReview){
            try
            {
                $query = "CALL p_get_ByIdReview(:pIdReview);";
                $parameters["pIdReview"]=$idReview;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);

            foreach($resultSet as $row) 
            {
                $review = new Review();
                $review->setIdReview($row["id_review"]);
                $review->setIdReserve($row["id_reserve"]);
                $review->setIdGuardian($row["id_Guardian"]);
                $review->setCalificacion($row["calificacion"]);
                $review->setDescription($row["description"]);
                return $review;
    
            }
            return null;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
        }

        
    }

?>