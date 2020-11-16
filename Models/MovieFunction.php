<?php

    namespace Models;

    class MovieFunction{

        private $date;
        private $start;    
        private $idMovie;
        private $idRoom;
        private $idFunction;
        private $maxTickets;
        private $tickets;

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

        public function getIdRoom(){
            return $this->idRoom;
        }

        public function setIdRoom($idRoom){
            $this->idRoom = $idRoom;
        }

        public function getIdFunction(){
            return $this->idFunction;
        }
 
        public function setIdFunction($idFunction){
            $this->idFunction = $idFunction;
        }

        public function getTickets(){
            return $this->tickets;
        }
 
        public function setTickets($tickets){
            $this->tickets = $tickets;
        }
    }
    
?>