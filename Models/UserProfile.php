<?php

    namespace Models;

    class UserProfile{

        private $dni;
        private $name;
        private $lastname; 

        public function getDni(){
            return $this->dni;
        }

        public function setDni($dni){
            $this->dni = $dni;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getLastname(){
            return $this->lastname;
        }

        public function setLastname($lastname){
            $this->lastname = $lastname;
        }

    }
    
?>