<?php

    namespace Models;

    class Ticket{

        private $idTicket;
        private $cinemaName;
        private $idFunction;
        private $functionDate;
        private $functionStart;
        private $finalValue;
        private $idUser;
        private $quantity;

        public function getIdTicket()
        {
            return $this->idTicket;
        }

        public function setIdTicket($idTicket)
        {
            $this->idTicket = $idTicket;
        }

        public function getCinemaName()
        {
            return $this->cinemaName;
        }

        public function setCinemaName($cinemaName)
        {
            $this->cinemaName = $cinemaName;
        }

        public function getIdFunction()
        {
            return $this->idFunction;
        }

        public function setIdFunction($idFunction)
        {
            $this->idFunction = $idFunction;
        }

        public function getFunctionDate()
        {
            return $this->functionDate;
        }

        public function setFunctionDate($functionDate)
        {
            $this->functionDate = $functionDate;
        }

        public function getFunctionStart()
        {
            return $this->functionStart;
        }

        public function setFunctionStart($functionStart)
        {
            $this->functionStart = $functionStart;
        }

        public function getFinalValue()
        {
            return $this->finalValue;
        }

        public function setFinalValue($finalValue)
        {
            $this->finalValue = $finalValue;
        }

        public function getIdUser()
        {
            return $this->idUser;
        }

        public function setIdUser($idUser)
        {
            $this->idUser = $idUser;
        }

        public function getQuantity()
        {
            return $this->quantity;
        }

        public function setQuantity($quantity)
        {
            $this->quantity = $quantity;
        }
    }

?>