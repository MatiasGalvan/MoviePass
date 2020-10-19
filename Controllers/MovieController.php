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
                # Devuelve una lista solo con lo id de los generos
                # Habria que hacer una funcio en GenreDAO para recuperar el nombre de uun genero pasandole el id

                array_push($this->movieList, $m);
            }
        }
    }

?>