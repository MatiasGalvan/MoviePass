<?php

    namespace Models;

    use Models\FilmFunction as FilmFunction;

    class Cinema{

        private $name;
        private $address;
        private $capacity; 
        private $ticketValue;
        private FilmFunction $functions = array();

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getAddress(){
            return $this->address;
        }

        public function setAddress($address){
            $this->address = $address;
        }

        public function getCapacity(){
            return $this->capacity;
        }

        public function setCapacity($capacity){
            $this->capacity = $capacity;
        }

        public function getTicketValue(){
            return $this->ticketValue;
        }

        public function setTicketValue($ticketValue){
            $this->ticketValue = $ticketValue;
        }

    }
    
?>