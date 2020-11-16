<?php

    namespace Models;

    use Models\Genre as Genre;

    class Movie{

        private $id;
        private $title;
        private $releaseDate;
        private $posterPath;
        private $overview;
        private $originalLanguage;
        private $runtime;
        private $genres = array();

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getTitle(){
            return $this->title;
        }

        public function setTitle($title){
            $this->title = $title;
        }

        public function getReleaseDate(){
            return $this->releaseDate;
        }

        public function setReleaseDate($releaseDate){
            $this->releaseDate = $releaseDate;
        }

        public function getPosterPath(){
            return $this->posterPath;
        }

        public function setPosterPath($posterPath){
            $this->posterPath = $posterPath;
        }

        public function getOverview(){
            return $this->overview;
        }

        public function setOverview($overview){
            $this->overview = $overview;
        }

        public function getOriginalLanguage(){
            return $this->originalLanguage;
        }

        public function setOriginalLanguage($originalLanguage){
            $this->originalLanguage = $originalLanguage;
        }

        public function getGenres(){
            return $this->genres;
        }

        public function setGenres($genres){
            $this->genres = $genres;
        }
        
        public function getRuntime(){
            return $this->runtime;
        }

        public function setRuntime($runtime){
            $this->runtime = $runtime;
        }

    }
    
?>