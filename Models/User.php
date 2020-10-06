<?php

    namespace Models;

    use Models\UserProfile as UserProfile;

    class User{

        private $username;
        private $password;
        private UserProfile $profile; 
        private $role; # Mirar si vale la pena hacer una clase aparte para el rol

        public function getUsername(){
            return $this->username;
        }

        public function setUsername($username){
            $this->username = $username;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function getUserProfile(){
            return $this->userProfile;
        }

        public function setUserProfile(UserProfile $userProfile){
            $this->userProfile = $userProfile;
        }

        public function getRole(){
            return $this->role;
        }

        public function setRole($role){
            $this->role = $role;
        }

    }
    
?>