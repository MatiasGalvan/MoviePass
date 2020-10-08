<?php

    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use Models\UserProfile as UserProfile;

    class UserDAO implements IUserDAO{

        private $userList = array();
        private $fileName;

        public function __construct(){
            $this->fileName = dirname(__DIR__)."/Data/users.json";
        }

        public function Add(User $user){
            $this->RetrieveData();
            array_push($this->userList, $user);
            $this->SaveData();
        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->userList;
        }

        public function Remove($email){
            $response = false;
            $i = 0;
            $this->RetrieveData();

            foreach($this->userList as $user){
                if($user->getEmail() == $email){
                    unset($this->userList[$i]);
                    $this->SaveData();
                    $response = true;
                }
                $i++;
            }
            return $response;
        }

        private function SaveData(){
            $arrayToEnconde = array();

            foreach ($this->userList as $user) {
                $valuesArray['email'] = $user->getEmail();
                $valuesArray['password'] = $user->getPassword();
                $valuesArray['role'] = $user->getRole();
                $valuesArray['userprofile'] = serialize($user->getProfile());

                array_push($arrayToEnconde, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEnconde, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData(){
            $this->userList = array();

            if(file_exists($this->fileName)){
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $email = $valuesArray['email'];
                    $password = $valuesArray['password'];
                    $role = $valuesArray['role'];
                    $profileSerialized = $valuesArray['userprofile'];
                    $profile = unserialize($profileSerialized);

                    $user = new User();
                    $user->setEmail($email);
                    $user->setPassword($password);
                    $user->setRole($role);
                    $user->setProfile($profile);

                    array_push($this->userList, $user);
                }
            }
        }
    }

?>