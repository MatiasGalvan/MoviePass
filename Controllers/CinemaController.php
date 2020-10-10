<?php

    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;

    class CinemaController{

        private $cinemaDAO;

        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
        }
        
        public function ShowAddCinemaView(){
            require_once(VIEWS_PATH."add-cinema.php");
        }

        public function AddCinema($name, $address, $capacity, $ticketValue){

            $cinema = new Cinema();

            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setTicketValue($ticketValue);

            $this->cinemaDAO->Add($cinema);

            $this->ShowAddCinemaView("Cine agregado con exito");
        }
    }

?>