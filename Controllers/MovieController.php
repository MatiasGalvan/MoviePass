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
    use Controllers\HomeController as HomeController;
    use Utils\Utils as Utils;

    class MovieController{

        private $genreDAO;
        private $movieDAO; 
        private $functionDAO;
        private $cinemaDAO;
        private $utils;
        private $movieList = array();

        public function __construct(){
            $this->genreDAO = new GenreDAO();
            $this->movieDAO = new MovieDAO();
            $this->functionDAO = new MovieFunctionDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->utils = new Utils();
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
            $aux = array();

            $movie = new Movie();
            $movie = $this->movieDAO->GetById($idMovie);

            $cinemaList = $this->cinemaDAO->GetAll();
            $genreList = $this->genreDAO->GetAll();

            foreach($cinemaList as $cinema){
                $flag2 = false;
                $roomList = array();
                if(!empty($cinema->existFunction())){
                    
                    foreach($cinema->getRooms() as $room){
                        $flag = false;
                        $functionList = array();
                        foreach($room->getFunctions() as $function){
                            if($function->getMovieId() == $idMovie && $this->utils->checkDate($function->getDate())){
                                array_push($functionList, $function);
                                $flag = true;
                            }
                        }
                        if($flag){
                            $room->setFunctions($functionList);
                            array_push($roomList,$room);
                            
                            $flag2 = true;
                        }
                    }
                    if($flag2){
                        $cinema->setRooms($roomList);
                        array_push($aux, $cinema);
                    }
                }
            }

            $cinemaList = $aux;

            require_once(VIEWS_PATH."movie-details.php");
        }

        public function ShowUpdateMovies($message = ""){
            $movieList = $this->movieDAO->GetAll();
            require_once(VIEWS_PATH."update-movies.php");
        }

        public function ShowUpdateGenres($message = ""){
            $genreList = $this->genreDAO->getAll();
            require_once(VIEWS_PATH."update-genres.php");
        }

        public function ReloadMovies(){
            if($this->utils->ValidateAdmin()){
                if(!empty($this->genreDAO->GetAll())){
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
                else{
                    $this->ShowUpdateMovies("There are no genres loaded in the database");
                }
            }
            else{
                $home = new HomeController();
                $home->Logout("You are not allowed to see this page");
            }
        }
        
        public function SaveGenres(){
            if($this->utils->ValidateAdmin()){
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
            else{
                $home = new HomeController();
                $home->Logout("You are not allowed to see this page");
            }
        }      
        
        public function FilterMovies(){
            $message = "";
            $filteredMovies = array();
            $flag = false;

            if(isset($_POST['genres'])){
                $this->RetrieveMovies();
                $filteredMovies = array();
                $filterList = $_POST['genres'];
                
                
                foreach($this->movieList as $movie){
                    $result = array_intersect($filterList, $movie->getGenres());
                    if(count($result) == count($filterList)) array_push($filteredMovies, $movie);
                }

                if(empty($filteredMovies)){
                    $message = "There are no movies with the specified genres";
                    $flag = true;
                }
            }

            if(isset($_POST['date']) && $_POST['date'] != "" && $flag == false){
                if($this->utils->checkDate($_POST['date'])){
                    if(empty($filteredMovies)){
                        $this->RetrieveMovies();
                        $filteredMovies = $this->movieList;
                    }
                    $filteredMovies = $this->FilterDate($filteredMovies, $_POST['date']);
                    if(empty($filteredMovies)){
                        $message = "There are no movies in the specified date";
                    }
                }
                else{
                    $message = "The date cannot be earlier than the current one";
                }
            }

            $this->ShowMovies($message, $filteredMovies);
        }

        private function FilterDate($filteredMovies, $date){
            $newFilter = array();
            foreach($filteredMovies as $movie){
                if($this->functionDAO->GetByDate($movie->getId(), $date)){
                    array_push($newFilter, $movie);
                }
            }
            return $newFilter;
        }

        private function RetrieveMovies(){
            $movieList = $this->movieDAO->GetAll();
            $this->movieList = array();

            foreach($movieList as $movie){
                $func = $this->functionDAO->GetByMovie($movie->getId());
                if(!empty($func)){
                    $i = 0;
                    $flag = false;
                    while($i < count($func) && $flag == false){
                        if($this->utils->checkDate($func[$i]->getDate()) && $func[$i]->getTickets() > 0){
                            array_push($this->movieList, $movie);
                            $flag = true;
                        }
                        $i++;
                    }
                    
                }
            }
        }

    }

?>