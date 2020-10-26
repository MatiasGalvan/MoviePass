<?php

    namespace Models;

    class MovieFunction{

        private $date = date("Y-m-d");
        private $start = time("H:i:s");     
        private $movieId;

        public function getDate(){
            return $this->date;
        }

        public function setDate($date){
            $this->date = $date;
        }

        public function getStart(){
            return $this->start;
        }

        public function setStart($start){
            $this->start = $start;
        }

        public function getMovieId(){
            return $this->movieId;
        }

        public function setMovieId($movieId){
            $this->movieId = $movieId;
        }

    }
    
?>