<?php

    namespace Models;

    class MovieFunction{

        private $date;
        private $start;    
        private $idMovie;
        private $idCinema;

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
            return $this->idMovie;
        }

        public function setMovieId($idMovie){
            $this->idMovie = $idMovie;
        }

        public function getIdCinema(){
            return $this->idCinema;
        }

        public function setIdCinema($idCinema){
            $this->idCinema = $idCinema;
        }
    }
    
?>