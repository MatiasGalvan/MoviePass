<?php

    namespace DAO;

    use DAO\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;

    class MovieDAO implements IMovieDAO{

        private $movieList = array();
        private $fileName;

        public function __construct(){
            $this->fileName = dirname(__DIR__)."/Data/movies.json";
        }

        public function Add(Movie $movie){
            $this->RetrieveData();
            array_push($this->movieList, $movie);
            $this->SaveData();
        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->movieList;
        }

        private function SaveData(){
            $arrayToEncode = array();

            foreach ($this->movieList as $movie) {
                $valuesArray['title'] = $movie->getTitle();
                $valuesArray['release_date'] = $movie->getReleaseDate();
                $valuesArray['poster_path'] = $movie->getPosterPath();
                $valuesArray['overview'] = $movie->getOverview();
                $valuesArray['original_language'] = $movie->getOriginalLanguage();
                $valuesArray['genre_ids'] = $movie->getGenres();
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData(){
            $this->movieList = array();

            if(file_exists($this->fileName)){
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $title = $valuesArray['title'];
                    $releaseDate = $valuesArray['release_date'];
                    $posterPath = $valuesArray['poster_path'];
                    $overview = $valuesArray['overview'];
                    $original_language = $valuesArray['original_language'];
                    $genres = $valuesArray['genre_ids'];

                    $movie = new Movie();
                    $movie->setTitle($title);
                    $movie->setReleaseDate($releaseDate);
                    $movie->setPosterPath($posterPath);
                    $movie->setOverview($overview);
                    $movie->setGenres($genres);

                    array_push($this->movieList, $movie);
                }
            }
        }
    }

?>