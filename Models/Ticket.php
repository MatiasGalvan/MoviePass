<?php

    namespace Models;

    class Ticket{

        private $idTicket;
        private $idCinema;
        private $idFunction;
        private $idUser;
        private $finalValue;
        private $quantity;

        public function getIdTicket(){
            return $this->idTicket;
        }

        public function setIdTicket($idTicket){
            $this->idTicket = $idTicket;
        }

        public function getIdCinema(){
            return $this->idCinema;
        }

        public function setIdCinema($idCinema){
            $this->idCinema = $idCinema;
        }

        public function getIdFunction(){
            return $this->idFunction;
        }

        public function setIdFunction($idFunction){
            $this->idFunction = $idFunction;
        }

        public function getFinalValue(){
            return $this->finalValue;
        }

        public function setFinalValue($finalValue){
            $this->finalValue = $finalValue;
        }

        public function getIdUser(){
            return $this->idUser;
        }

        public function setIdUser($idUser){
            $this->idUser = $idUser;
        }

        public function getQuantity(){
            return $this->quantity;
        }

        public function setQuantity($quantity){
            $this->quantity = $quantity;
        }
    }

?>