<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IMovieFunctionDAO as IMovieFunctionDAO;
    use Models\MovieFunction as MovieFunction;

    class MovieFunctionDAO implements IMovieFunctionDAO{

        private $connection;
        private $tableName = "MovieFunction";

        public function __construct(){
        }

        public function Add(MovieFunction $movieFunction){
            try{
                $query = "INSERT INTO ".$this->tableName."(functionDate, startTime, idMovie, idRoom, tickets) VALUES (:functionDate, :startTime, :idMovie, :idRoom, :tickets);";

                $parameters["functionDate"] = $movieFunction->getDate();
                $parameters["startTime"] = $movieFunction->getStart();
                $parameters["idMovie"] = $movieFunction->getMovieId();
                $parameters["idRoom"] = $movieFunction->getIdRoom();
                $parameters["tickets"] = $movieFunction->getTickets();

                $this->connection = Connection::GetInstance();

                $idFunction = $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){
            try{
                $movieFunctionList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                
                    $movieFunction = new MovieFunction();
                    $movieFunction->setIdFunction($row["idFunction"]);
                    $movieFunction->setDate($row["functionDate"]);
                    $movieFunction->setStart($row["startTime"]);
                    $movieFunction->setMovieId($row["idMovie"]);
                    $movieFunction->setIdRoom($row["idRoom"]);
                    $movieFunction->setTickets($row["tickets"]);

                    array_push($movieFunctionList, $movieFunction);
                }

                return $movieFunctionList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Update($idFunction, $tickets){
            try{                
                $query = "UPDATE " . $this->tableName . " SET tickets = :tickets WHERE idFunction = :idFunction;";
                
                $parameters['idFunction'] = $idFunction;
                $parameters["tickets"] = $tickets;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($idFunction){
            try{                
                $query = "DELETE FROM ".$this->tableName." WHERE idFunction = :idFunction";
                $parameters['idFunction'] = $idFunction;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $param);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetById($id){
            try{
                $movieFunction = new MovieFunction();

                $query = "SELECT * FROM ".$this->tableName." WHERE idFunction = :idFunction";

                $parameters['idFunction'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row){    
                    $movieFunction->setIdFunction($row["idFunction"]);
                    $movieFunction->setDate($row["functionDate"]);
                    $movieFunction->setStart($row["startTime"]);
                    $movieFunction->setMovieId($row["idMovie"]);
                    $movieFunction->setIdRoom($row["idRoom"]);
                    $movieFunction->setTickets($row["tickets"]);
                }

                return $movieFunction;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetByMovie($idMovie){
            try{
                $movieFunctionList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE idMovie = :idMovie";

                $parameters['idMovie'] = $idMovie;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row){    
                    $movieFunction = new MovieFunction();        
                    $movieFunction->setIdFunction($row["idFunction"]);
                    $movieFunction->setDate($row["functionDate"]);
                    $movieFunction->setStart($row["startTime"]);
                    $movieFunction->setMovieId($row["idMovie"]);
                    $movieFunction->setIdRoom($row["idRoom"]);
                    $movieFunction->setTickets($row["tickets"]);

                    array_push($movieFunctionList, $movieFunction);
                }

                return $movieFunctionList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetByDate($idMovie, $date){
            try{
                $response = false;

                $query = "SELECT * FROM ".$this->tableName." WHERE idMovie = :idMovie AND functionDate = :functionDate";

                $parameters['idMovie'] = $idMovie;
                $parameters['functionDate'] = $date;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row){  
                    $response = true;                 
                }

                return $response;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetFunctions($idCinema){
            try{
                $functionsList = array();

                $query = "SELECT mf.* FROM Room r INNER JOIN movieFunction mf ON r.idRoom = mf.IdRoom INNER JOIN Cinema c ON r.idCinema = c.idCinema WHERE c.idCinema = :idCinema";
                $parameters["idCinema"] = $idCinema;
                    
                $this->connection = Connection::GetInstance();

                $functions = $this->connection->Execute($query, $parameters);

                foreach($functions as $function){
                    $func = new MovieFunction();
                    $func->setDate($function["functionDate"]);
                    $func->setStart($function["startTime"]);
                    $func->setMovieId($function["idMovie"]);
                    $func->setIdRoom($function["idRoom"]);
                    $func->setIdFunction($function["idFunction"]);
                    $func->setTickets($function["tickets"]);

                    array_push($functionsList, $func);
                }

                return $functionsList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function ExistID($idFunction){
            try{
                $response = false;
                $query = "SELECT idFunction FROM " . $this->tableName . "  WHERE idFunction = :idFunction";
                $param['idFunction'] = $idFunction;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $param);

                foreach ($resultSet as $row){   
                    if($row['idFunction'] != null){
                        $response = true;
                    }
                }

                return $response;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

    }

?>