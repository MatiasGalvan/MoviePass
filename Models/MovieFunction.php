<?php

    namespace Models;

    class MovieFunction{

        private $date = date("Y-m-d H:i:s");
        private $start = time("H:i:s");
        private $end = time("H:i:s");        
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

        public function getEnd(){
            return $this->end;
        }

        public function setEnd($end){
            $this->end = $end;
        }

        public function getMovieId(){
            return $this->movieId;
        }

        public function setMovieId($movieId){
            $this->movieId = $movieId;
        }

    }
    
?>