<?php

    namespace Models;

    use Models\UserProfile as UserProfile;
    use Models\Role as Role;

    class User{

        private $email;
        private $password;
        private UserProfile $profile; 
        private Role $role;

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

        public function setRole(Role $role){
            $this->role = $role;
        }

    }
    
?>