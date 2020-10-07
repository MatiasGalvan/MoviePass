<?php

    namespace Controllers;

    use Models\Movie as Movie;

    class MovieController{

        private $movieList = array();

        public function ShowMovies($message = ""){
            $this->RetrieveMovies();
            $movieList = $this->movieList;
            require_once(VIEWS_PATH."billboard.php");
        }

        public function RetrieveMovies(){
            $moviesToDecode = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?" . TMDb_KEY);
            # "https://api.themoviedb.org/3/movie/now_playing?" . TMBd_KEY . "&page=3"
            $result = json_decode($moviesToDecode, true);
            $movies = $result['results'];

            foreach($movies as $movie){
                $m = new Movie();
                $m->setTitle($movie['title']);
                # $m->setTagline($movie['tagline']);
                # Me tira error en el tagline 
                $m->setReleaseDate($movie['release_date']);
                $m->setPosterPath($movie['poster_path']);
                $m->setOverview($movie['overview']);
                $m->setOriginalLanguage($movie['original_language']);

                $genres = $movie['genre_ids'];
            # Devulve una lista solo con lo id de los generos, ver si conviene guardar los generos en un archivo

                array_push($this->movieList, $m);
            }
        }

    }

?>