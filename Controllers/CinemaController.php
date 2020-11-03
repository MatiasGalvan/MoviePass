<?php

    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;

    class CinemaController{

        private $cinemaDAO;

        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
        }
        
        public function ShowAddCinemaView($data = array(), $errors = array(), $message = ""){
            require_once(VIEWS_PATH."add-cinema.php");
        }

        public function ShowUpdateCinemaView($data = array(), $errors = array(), $message = ""){
            require_once(VIEWS_PATH."update-cinema.php");
        }

        public function ShowCinemas($message = ""){
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function AddCinema($name, $address, $capacity, $ticketValue){
            $errors = $this->checkData($name, $address, $capacity, $ticketValue);

            if(count($errors) == 0){
                $cinema = new Cinema();
                $cinema->setName($name);
                $cinema->setAddress($address);
                $cinema->setCapacity($capacity);
                $cinema->setTicketValue($ticketValue);
    
                $this->cinemaDAO->Add($cinema);
    
                $this->ShowAddCinemaView(array(), array(), "Cinema added successfully");
            }
            else{
                $data['name'] = $name;
                $data['address'] = $address;
                $data['capacity'] = $capacity;
                $data['ticketValue'] = $ticketValue;
                $this->ShowAddCinemaView($data, $errors);
            }
        }

        private function checkData($name, $address, $capacity, $ticketValue, $update = -1){
            $errors = array();

            if (!$this->checkName($name)) array_push($errors, "Invalid format. Name must be between 3 and 20 characters. And start with uppercase.");
            if (!$this->checkAddress($address)) array_push($errors, "Invalid format. Start with uppercase. Address must be between 3 and 20 characters. Followed by number");
            if (!$this->checkNumber($capacity)) array_push($errors, "Invalid format. Value must be between 1 to 4 digits.");
            if (!$this->checkNumber($ticketValue)) array_push($errors, "Invalid format. Value must be between 1 to 5 digits. Numbers with commas can be included");
            if($update == -1){
                if ($this->cinemaDAO->Exist($address)) array_push($errors, "The address is already taken.");
            }
            else{
                $modifyCinema = $this->cinemaDAO->GetById($update);
                if($modifyCinema->getAddress() != $address){
                    if ($this->cinemaDAO->Exist($address)) array_push($errors, "The address is already taken.");
                }
            }

            return $errors;
        }

        private function checkNumber($value){
            $regularNumber = "/(^[0-9]{1,4}$)/";
            $response = false;
            if (preg_match($regularNumber, $value) && $value > 0){
                $response = true;
            }
            return $response; 
        }

        private function checkAddress($value){
            $regularString = "/(^(?=.{3,20}$)[A-ZÁÉÍÓÚ]{1}([a-zñáéíóú]+){2,} \d{1,5})$/";
            
            $response = false;
            if (preg_match($regularString, $value)){
                $response = true;
            }
            return $response;
        }

        private function checkName($value){
            $regularString = "/(^(?=.{3,20}$)[A-ZÁÉÍÓÚ]{1}([a-zñáéíóú]+){2,})$/";
            
            $response = false;
            if (preg_match($regularString, $value)){
                $response = true;
            }
            return $response;
        }

        public function RemoveCinema($id){
            $message = "The ID entered does not exist";

            if($this->cinemaDAO->ExistID($id)){
                $this->cinemaDAO->Remove($id);
                $message = "Cinema removed successfully";
            }
            
            $this->ShowCinemas($message);
        }

        public function UpdateCinema($id){
            $available = false;
            $ModifyCinema = new Cinema();

            if($this->cinemaDAO->ExistID($id)){
                $ModifyCinema = $this->cinemaDAO->GetById($id);
                $available = true;
            }

            if($available){
                $data['id'] = $ModifyCinema->getId();
                $data['name'] = $ModifyCinema->getName();
                $data['address'] = $ModifyCinema->getAddress();
                $data['capacity'] = $ModifyCinema->getCapacity();
                $data['ticketValue'] = $ModifyCinema->getTicketValue();
                $this->ShowUpdateCinemaView($data);
            }
            else{
                $this->ShowCinemas("The ID entered does not exist");
            }
        }

        public function ModifyCinema($id, $name, $address, $capacity, $ticketValue){

            $errors = $this->checkData($name, $address, $capacity, $ticketValue, $id);

            if(count($errors) == 0 && $this->cinemaDAO->ExistID($id)){
                $cinema = new Cinema();
                $cinema->setId($id);
                $cinema->setName($name);
                $cinema->setAddress($address);
                $cinema->setCapacity($capacity);
                $cinema->setTicketValue($ticketValue);
    
                $this->cinemaDAO->Update($cinema);
    
                $this->ShowUpdateCinemaView(array(), array(), "Cinema updated successfully");
            }
            else{
                $data['name'] = $name;
                $data['address'] = $address;
                $data['capacity'] = $capacity;
                $data['ticketValue'] = $ticketValue;
                $this->ShowUpdateCinemaView($data, $errors);
            }
        }

    }

?>