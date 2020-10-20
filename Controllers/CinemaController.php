<?php

    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;

    class CinemaController{

        private $cinemaDAO;

        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
        }
        
        public function ShowAddCinemaView($data = array()){
            require_once(VIEWS_PATH."add-cinema.php");
        }

        public function ShowCinemas($message = ""){
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function AddCinema($id, $name, $address, $capacity, $ticketValue){

            $available = $this->cinemaDAO->Exist($id);

            if(!$available){
                $cinema = new Cinema();
                $cinema->setId($id);
                $cinema->setName($name);
                $cinema->setAddress($address);
                $cinema->setCapacity($capacity);
                $cinema->setTicketValue($ticketValue);
    
                $this->cinemaDAO->Add($cinema);
    
                $this->ShowAddCinemaView("Cinema added successfully");
            }
            else{
                $this->ShowAddCinemaView("The ID is already taken");
            }
        }

        public function RemoveCinema($id){
            $message = "The ID entered does not exist";

            if($this->cinemaDAO->Exist($id)){
                $this->cinemaDAO->Remove($id);
                $message = "Cinema removed successfully";
            }
            
            $this->ShowCinemas($message);
        }

        public function ModifyCinema($id){
            $this->cinemaList = $this->cinemaDAO->GetAll();
            $available = false;
            $ModifyCinema = new Cinema();
            foreach($this->cinemaList as $cinema){
                if($cinema->getId() == $id){
                    $ModifyCinema = $cinema;
                    $available = true;
                }
            }

            if($available){
                $data['id'] = $ModifyCinema->getId();
                $data['name'] = $ModifyCinema->getName();
                $data['address'] = $ModifyCinema->getAddress();
                $data['capacity'] = $ModifyCinema->getCapacity();
                $data['ticketValue'] = $ModifyCinema->getTicketValue();
                $this->cinemaDAO->Remove($id);
                $this->ShowAddCinemaView($data);
            }
            else{
                $this->ShowCinemas("The ID entered does not exist");
            }
        }
    }

?>