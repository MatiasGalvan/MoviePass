<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IMovieFunctionDAO as IMovieFunctionDAO;
    use Models\MovieFunction as MovieFunction;
    use DAO\CinemaDAO as CinemaDAO;

    class MovieFunctionDAO{

        private $connection;
        private $tableName = "MovieFunction";
        private $tablefunctionXCinema = "CinemaXFunction";
        private $cinemaDAO;


        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
        }

        public function Add(MovieFunction $movieFunction,$idCinema){
            try{
                $query = "INSERT INTO ".$this->tableName."(functionDate, startTime, idMovie) VALUES (:functionDate, :startTime, :idMovie);";

                $parameters["functionDate"] = $movieFunction->getDate();
                $parameters["startTime"] = $movieFunction->getStart();
                $parameters["idMovie"] = $movieFunction->getMovieId();

                $this->connection = Connection::GetInstance();

                $idFunction = $this->connection->ExecuteNonQuery($query, $parameters);

                $this->AddCinema($idFunction,$idCinema);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function AddCinema($idFunction, $idCinema){
            try{
                if($this->cinemaDAO->ExistID($idCinema)){
                    $query = "INSERT INTO ".$this->tablefunctionXCinema." (idCinema, idFunction) VALUES (:idCinema, :idFunction);";
                    $parameters["idCinema"] = $idCinema;
                    $parameters["idFunction"] = $idFunction;
                    
                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
                    
                }
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
                    $movieFunction->setDate($row["functionDate"]);
                    $movieFunction->setStart($row["startTime"]);
                    $movieFunction->setMovieId($row["idMovie"]);

                    array_push($movieFunctionList, $movieFunction);
                }

                return $movieFunctionList;
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

                    $movieFunction->setDate($row["functionDate"]);
                    $movieFunction->setStart($row["startTime"]);
                    $movieFunction->setMovieId($row["idMovie"]);
                }

                return $movieFunction;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

    }

?>