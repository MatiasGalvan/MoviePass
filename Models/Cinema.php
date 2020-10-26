<?php

    namespace Models;

    use Models\MovieFunction as MovieFunction;

    class Cinema{

        private $id;
        private $name;
        private $address;
        private $capacity; 
        private $ticketValue;
        private $billboard = array();

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }
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

        public function getBillboard(){
            return $this->billboard;
        }
        
        public function setBillboard($billboard){
            $this->billboard = $billboard;
        }

        public function addFunction(MovieFunction $function){
            array_push($this->billboard, $function);
        }
    }
    
?>