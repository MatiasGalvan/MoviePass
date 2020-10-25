<?php

    namespace DAO;
    
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;

    class GenreDAO implements IGenreDAO{

        private $connection;
        private $tableName = "Genre";

        public function Add(Genre $genre){
            try{
                $query = "INSERT INTO ".$this->tableName." (idApi, genreName) VALUES (:idApi, :genreName);";
                
                $parameters["idApi"] = $genre->getId();
                $parameters["genreName"] = $genre->getName();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){
            try{
                $genreList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                
                    $genre = new Genre();
                    $genre->setId($row["idApi"]);
                    $genre->setName($row["genreName"]);

                    array_push($genreList, $genre);
                }

                return $genreList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Exist($idApi){
            try{
                $response = false;
                $query = "SELECT idApi FROM ".$this->tableName." WHERE idApi = :idApi";
                $param['idApi'] = $idApi;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $param);

                foreach ($resultSet as $row){   
                    if($row['idApi'] != null){
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