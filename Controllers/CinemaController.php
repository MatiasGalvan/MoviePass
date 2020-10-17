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

        public function ShowRemoveCinemaView(){
            require_once(VIEWS_PATH."remove-cinema.php");
        }
        public function ShowCinemas(){
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function ShowModifyCinemaView(){
            require_once(VIEWS_PATH."modify-cinema.php");
        }

        public function AddCinema($id, $name, $address, $capacity, $ticketValue){

            $cinemaList = $this->cinemaDAO->GetAll();
            $available = true;
            foreach($cinemaList as $cinema){
                if($cinema->getId() == $id){
                    $available = false;
                }
            }

            if($available == true){
                $cinema = new Cinema();
                $cinema->setId($id);
                $cinema->setName($name);
                $cinema->setAddress($address);
                $cinema->setCapacity($capacity);
                $cinema->setTicketValue($ticketValue);
    
                $this->cinemaDAO->Add($cinema);
    
                $this->ShowAddCinemaView("Cine agregado con exito");
            }
            else{
                $this->ShowAddCinemaView("Id no disponible");
            }
        }

        public function RemoveCinema($id){
            $this->cinemaDAO->Remove($id);
            $this->ShowRemoveCinemaView("Cine removido con exito");
        }

        public function ModifyCinema($id){
            $cinemaList = $this->cinemaDAO->GetAll();
            $ModifyCinema;
            foreach($cinemaList as $cinema){
                if($cinema->getId() == $id){
                    $ModifyCinema = $cinema;
                }
            }
            $this->cinemaDAO->Remove($id);

            $data['id'] = $ModifyCinema->GetId();
            $data['name'] = $ModifyCinema->GetName();
            $data['address'] = $ModifyCinema->GetAddress();
            $data['capacity'] = $ModifyCinema->GetCapacity();
            $data['ticketValue'] = $ModifyCinema->GetTicketValue();
            $this->ShowAddCinemaView($data);


        }
    }

?>