<?php

    namespace Models;

    class Room{

        private $idRoom;
        private $idCinema;
        private $roomName;
        private $capacity;
        private $functions = array();

        public function getIdRoom(){
            return $this->idRoom;
        }

        public function setIdRoom($idRoom){
            $this->idRoom = $idRoom;
        }

        public function getIdCinema(){
            return $this->idCinema;
        }

        public function setIdCinema($idCinema){
            $this->idCinema = $idCinema;
        }

        public function getRoomName(){
            return $this->roomName;
        }

        public function setRoomName($roomName){
            $this->roomName = $roomName;
        }

        public function getCapacity(){
            return $this->capacity;
        }

        public function setCapacity($capacity){
            $this->capacity = $capacity;
        }

        public function getFunctions(){
            return $this->functions;
        } 

        public function setFunctions($functions){
            $this->functions = $functions;
        }
        
    }
    
?>