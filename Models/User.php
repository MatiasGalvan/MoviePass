<?php

    namespace Models;

    use Models\UserProfile as UserProfile;

    class User{

        private $email;
        private $password;
        private UserProfile $profile; 
        private $role; # Mirar si vale la pena hacer una clase aparte para el rol

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function getProfile(){
            return $this->profile;
        }

        public function setProfile(UserProfile $profile){
            $this->profile = $profile;
        }

        public function getRole(){
            return $this->role;
        }

        public function setRole($role){
            $this->role = $role;
        }

    }
    
?>