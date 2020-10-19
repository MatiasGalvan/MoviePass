<?php

    namespace Controllers;

    use Models\Movie as Movie;
    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;
    use Models\Genre as Genre;

    class MovieController{

        private $genreDAO;
        private $movieList = array();
        private $movieDAO; 

        public function __construct(){
            $this->movieDAO = new MovieDAO();
        }

        public function __construct(){
            $this->genreDAO = new GenreDAO();
        }


        public function ShowMovies($message = "", $movieList = array()){
            if(empty($movieList)){
                $this->RetrieveMovies();
                    $movieList = $this->movieList;
            }
                 $genreList = $this->genreDAO->GetAll();
                require_once(VIEWS_PATH."billboard.php");
        }

        # Funcion para actualizar peliculas levantandolas de la api

        # Funcion para actualizar generos levantandolas de la api

        public function RetrieveMovies(){ #Modificar esta para que las agarre del json

            $moviesToDecode = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?" . TMDb_KEY);
            # "https://api.themoviedb.org/3/movie/now_playing?" . TMBd_KEY . "&page=3"
            $result = json_decode($moviesToDecode, true);
            $movies = $result['results'];




            foreach($movies as $movie){
                $m = new Movie();
                $m->setTitle($movie['title']);
                $m->setReleaseDate($movie['release_date']);
                $m->setPosterPath($movie['poster_path']);
                $m->setOverview($movie['overview']);
                $m->setOriginalLanguage($movie['original_language']);

                $genres = $movie['genre_ids'];
                
                $m->setGenres($genres);
                
                 # Devuelve una lista solo con lo id de los generos
                # Habria que hacer una funcio en GenreDAO para recuperar el nombre de uun genero pasandole el id
               
                array_push($this->movieList,$m);
            }

        }
        public function SaveGenres(){
            $genreToDecode = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=a2c8cc87dc896f37eb6ca3258529f6d5");
            $result = json_decode($genreToDecode, true);
            $genres = $result['genres'];
            foreach ($genres as $value) {
                $genre = new Genre();
                $genre->setId($value['id']);
                $genre->setName($value['name']);
                $this->genreDAO->Add($genre);
            }
        }

      
        
        public function FilterMovies(){
            $this->RetrieveMovies();
            $filteredMovies = array();
            $filterList = $_POST["genres"];
        
            foreach($this->movieList as $movie){
                $result = array_intersect($filterList, $movie->getGenres());
                if(count($result) == count($filterList)) array_push($filteredMovies, $movie);
            }
        
            $this->ShowMovies("",$filteredMovies);
        }
        
    }

?>