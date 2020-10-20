<?php

    namespace Controllers;

    use Models\Movie as Movie;
    use Models\Genre as Genre;
    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;
    use Contollers\CinemaController as CinemaController;

    class MovieController{

        private $genreDAO;
        private $movieDAO; 
        private $movieList = array();

        public function __construct(){
            $this->genreDAO = new GenreDAO();
            $this->movieDAO = new MovieDAO();
        }

        public function ShowMovies($message = "", $movieList = array()){
            if(empty($movieList)){
                $this->RetrieveMovies();
                $movieList = $this->movieList;
            }
            $genreList = $this->genreDAO->GetAll();
            require_once(VIEWS_PATH."billboard.php");
        }

        public function ReloadMovies(){
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                $moviesToDecode = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?" . TMDb_KEY);
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
                    $this->movieDAO->Add($m);
                }
                $cinema = new CinemaController();
                $cinema->ShowCinemas();
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
                foreach ($genres as $value) {
                    $genre = new Genre();
                    $genre->setId($value['id']);
                    $genre->setName($value['name']);
                    $this->genreDAO->Add($genre);
                }
                $cinema = new CinemaController();
                $cinema->ShowCinemas();
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