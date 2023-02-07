<?php 
    namespace DAO;

    use Models\Review as Review;
    use DAO\Connection as Connection;
    use \Exception as Exception;

    class ReviewDAO
    {
        private $reviewList=array();
        
        private $connection;
        private $tableName;

        public function __construct()
        {
            $this->tableName = "review";
            $this->reviewList=array();
        }

        public function GetAll()
        {
            try
            {
                $query = "CALL p_get_Review();";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
                return $this->getReviewList($resultSet);
        
        }
            catch(Exception $ex)
            {
                throw new Exception ("Error al mostrar todas las reviews");
            }
        }
        public function getReview($resultSet)
        {
            if($resultSet !== null) 
            {
                foreach($resultSet as $row) {
                $review = new Review();
                $review->setIdReview($row["id_review"]);
                $review->setIdReserve($row["id_reserve"]);
                $review->setIdGuardian($row["id_guardian"]);
                $review->setCalificacion($row["calificacion"]);
                $review->setDescription($row["description"]);
                return $review;
    
            }
        }
            else 
            {
            return null;
            }
        }

        public function getReviewList($resultSet)
        {
            $array= array();
            if($resultSet !== null) 
            {
                foreach($resultSet as $row) {
                $review = new Review();
                $review->setIdReview($row["id_review"]);
                $review->setIdReserve($row["id_reserve"]);
                $review->setIdGuardian($row["id_guardian"]);
                $review->setCalificacion($row["calificacion"]);
                $review->setDescription($row["description"]);
                array_push($array,$review);
            }
        }
            
            return $array;
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
                throw new Exception ("Error al agregar la review");
            }
        }

        public function getByIdGuardian($idGuardian){
            try
            {
                $query = "CALL p_get_ByIGuardianReview(:pIdGuardian);";
                $parameters["pIdGuardian"]=$idGuardian;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query,$parameters);

             return $this->getReviewList($resultSet);
        }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar las reviews de ese guardian");
        }
        }
        public function getByIdReserve($idReserve){
            try
            {
                $query = "CALL p_get_ByIdReserveReview(:pIdReserve);";
                $parameters["pIdReserve"]=$idReserve;

            $this->connection = Connection::GetInstance();

            $row = $this->connection->Execute($query,$parameters);

            return $this->getReview($row);
        }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar la review de esa reserva");
        }
        }

        public function getByIdReview($idReview){
            try
            {
                $query = "CALL p_get_ByIdReview(:pIdReview);";
                $parameters["pIdReview"]=$idReview;

            $this->connection = Connection::GetInstance();

            $row = $this->connection->Execute($query,$parameters);

            return $this->getReview($row);
        }
        catch(Exception $ex)
        {
            throw new Exception ("Error al mostrar la review");
        }
        }

        
    }

?>