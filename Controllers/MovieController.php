<?php

    namespace Controllers;

    use Models\Movie as Movie;
    use Models\Genre as Genre;
    use Models\Cinema as Cinema;
    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use Controllers\CinemaController as CinemaController;

    class MovieController{

        private $genreDAO;
        private $movieDAO; 
        private $functionDAO;
        private $cinemaDAO;
        private $movieList = array();

        public function __construct(){
            $this->genreDAO = new GenreDAO();
            $this->movieDAO = new MovieDAO();
            $this->functionDAO = new MovieFunctionDAO();
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowMovies($message = "", $movieList = array()){
            if(empty($movieList)){
                $this->RetrieveMovies();
                $movieList = $this->movieList;
            }
            $genreList = $this->genreDAO->GetAll();
            require_once(VIEWS_PATH."billboard.php");
        }

        public function ShowMovieDetails($idMovie, $message = ""){
            $movie = new Movie();
            $movie = $this->movieDAO->GetById($idMovie);
            $genreList = $this->genreDAO->GetAll();
            $functionList = $this->functionDAO->getByMovie($idMovie);
        
            $cinemaList = array();

            if(!empty($functionList)){
                foreach ($functionList as $func){
                    $cinema = new Cinema();
                    $cinema = $this->cinemaDAO->GetById($func->getIdCinema());
                    array_push($cinemaList, $cinema);
                }
            }

            require_once(VIEWS_PATH."movie-details.php");
        }

        public function ShowUpdateMovies($message = ""){
            $this->RetrieveMovies();
            $movieList = $this->movieList;
            require_once(VIEWS_PATH."update-movies.php");
        }

        public function ShowUpdateGenres($message = ""){
            $this->RetrieveMovies();
            $genreList = $this->genreDAO->getAll();
            require_once(VIEWS_PATH."update-genres.php");
        }

        public function ReloadMovies(){
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                $moviesToDecode = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?" . TMDb_KEY);
                $result = json_decode($moviesToDecode, true);
                $movies = $result['results'];
                $i = 0;
                foreach($movies as $movie){
                    if(!($this->movieDAO->Exist($movie['id']))){
                        $m = new Movie();
                        $m->setId($movie['id']);
                        $m->setTitle($movie['title']);
                        $m->setReleaseDate($movie['release_date']);
                        $m->setPosterPath($movie['poster_path']);
                        $m->setOverview($movie['overview']);
                        $m->setOriginalLanguage($movie['original_language']);
                        $genres = $movie['genre_ids'];
                        $m->setGenres($genres);
                        $this->movieDAO->Add($m);
                        $i++;
                    }
                }
                ($i != 0) ? $message = $i . " movies have been added." : $message = "The movies are already updated.";
                $this->ShowUpdateMovies($message);
            }
        }

        public function RetrieveMovies(){
            $this->movieList = $this->movieDAO->GetAll();
        }
        
        public function SaveGenres(){
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                $genreToDecode = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?" . TMDb_KEY);
                $result = json_decode($genreToDecode, true);
                $genres = $result['genres'];
                $i = 0;
                foreach ($genres as $value) {
                    if(!($this->genreDAO->Exist($value['id']))){
                        $genre = new Genre();
                        $genre->setId($value['id']);
                        $genre->setName($value['name']);
                        $this->genreDAO->Add($genre);
                        $i++;
                    }
                }
                ($i != 0) ? $message = $i . " genres have been added." : $message = "The genres are already updated.";
                $this->ShowUpdateGenres($message);
            }
        }      
        
        public function FilterMovies(){

            if(isset($_POST['genres'])){
                $this->RetrieveMovies();
                $filteredMovies = array();
                $filterList = $_POST['genres'];
                $message = "";
                
                foreach($this->movieList as $movie){
                    $result = array_intersect($filterList, $movie->getGenres());
                    if(count($result) == count($filterList)) array_push($filteredMovies, $movie);
                }

                if(empty($filteredMovies)) $message = "There are no movies with the specified genres";

                $this->ShowMovies($message, $filteredMovies);
            }
            else{
                $this->ShowMovies();
            }
        }
        
    }

?>