<?php

    namespace Models;

    class Ticket{

        private $idTicket;
        private $idCinema;
        private $idFunction;
        private $movieStart;

        public function getIdTicket()
        {
            return $this->idTicket;
        }

        public function setIdTicket($idTicket)
        {
            $this->idTicket = $idTicket;
        }

        public function getIdCinema()
        {
            return $this->idCinema;
        }

        public function setIdCinema($idCinema)
        {
            $this->idCinema = $idCinema;
        }

        public function getIdFunction()
        {
            return $this->idFunction;
        }

        public function setIdFuncton($idFunction)
        {
            $this->idFunction = $idFunction;
        }

        public function getMovieStart()
        {
            return $this->movieStart;
        }

        public function setMovieStart($movieStart)
        {
            $this->movieStart = $movieStart;
        }
    }

?>