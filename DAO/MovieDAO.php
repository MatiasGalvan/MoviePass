<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\GenreDAO as GenreDAO;
    use DAO\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;

    class MovieDAO implements IMovieDAO{

        private $connection;
        private $tableName = "Movie";
        private $tableGenXMov = "MovieXGenre";
        private $genreDAO;

        public function __construct(){
            $this->genreDAO = new GenreDAO();
        }

        public function Add(Movie $movie){
            try{
                $query = "INSERT INTO ".$this->tableName." (idApi, title, releaseDate, posterPath, overview, originalLanguage, runtime) VALUES (:idApi, :title, :releaseDate, :posterPath, :overview, :originalLanguage, :runtime);";

                $parameters["idApi"] = $movie->getId();
                $parameters["title"] = $movie->getTitle();
                $parameters["releaseDate"] = $movie->getReleaseDate();
                $parameters["posterPath"] = $movie->getPosterPath();
                $parameters["overview"] = $movie->getOverview();
                $parameters["originalLanguage"] = $movie->getOriginalLanguage();
                $parameters["runtime"] = $movie->getRuntime();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                $genres = $movie->getGenres();

                foreach($genres as $genre){
                    $this->AddGenre($genre, $movie->getId());
                }
            }
            catch(Exception $ex){
                throw $ex;
            }
        }


        public function AddGenre($idGenre, $idMovie){
            try{
                if($this->genreDAO->Exist($idGenre)){
                    $query = "INSERT INTO ".$this->tableGenXMov." (idGenre, idMovie) VALUES (:idGenre, :idMovie);";
                    
                    $parameters["idGenre"] = $idGenre;
                    $parameters["idMovie"] = $idMovie;
                    
                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetGenres($idMovie){
            try{
                $genreList = array();

                $query = "SELECT idGenre FROM ".$this->tableGenXMov." WHERE idMovie = :idMovie GROUP BY idGenre";

                $parameters["idMovie"] = $idMovie;
                    
                $this->connection = Connection::GetInstance();

                $genres = $this->connection->Execute($query, $parameters);

                foreach($genres as $genre){
                    array_push($genreList, $genre['idGenre']);
                }

                return $genreList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetById($idMovie){
            if($this->Exist($idMovie)){
                try{
                    $query = "SELECT * FROM " . $this->tableName . " WHERE idApi = :idApi";

                    $parameters["idApi"] = $idMovie;

                    $this->connection = Connection::GetInstance();

                    $result = $this->connection->Execute($query, $parameters);

                    foreach ($result as $row){
                        $movie = new Movie();
                        $movie->setId($row["idApi"]);
                        $movie->setTitle($row["title"]);
                        $movie->setReleaseDate($row["releaseDate"]);
                        $movie->setPosterPath($row["posterPath"]);
                        $movie->setOverview($row["overview"]);
                        $movie->setOriginalLanguage($row["originalLanguage"]);
                        $movie->setRuntime($row["runtime"]);
                        $movie->setGenres($this->GetGenres($row["idApi"]));
                    }

                    return $movie;
                }
                catch(Exception $ex){
                    throw $ex;
                }
            }
        }

        public function GetAll(){
            try{
                $movieList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){

                    $movie = new Movie();
                    $movie->setId($row["idApi"]);
                    $movie->setTitle($row["title"]);
                    $movie->setReleaseDate($row["releaseDate"]);
                    $movie->setPosterPath($row["posterPath"]);
                    $movie->setOverview($row["overview"]);
                    $movie->setOriginalLanguage($row["originalLanguage"]);
                    $movie->setRuntime($row["runtime"]);
                    $movie->setGenres($this->GetGenres($row["idApi"]));

                    array_push($movieList, $movie);
                }

                return $movieList;
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