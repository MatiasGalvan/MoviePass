<?php

    namespace Models;

    class MovieFunction{

        private $date = date("Y-m-d H:i:s");
        private $movieId;

        public function getDate(){
            return $this->date;
        }

        public function setDate($date){
            $this->date = $date;
        }

        public function getMovieId(){
            return $this->movieId;
        }

        public function setMovieId($movieId){
            $this->movieId = $movieId;
        }

    }
    
?>