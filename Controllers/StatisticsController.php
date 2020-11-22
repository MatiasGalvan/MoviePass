<?php

    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;
    use Utils\Utils as Utils; 
    use DAO\MovieDAO as MovieDAO;

    class StatisticsController{

        private $cinemaDAO;
        private $movieDAO;
        private $utils;

        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
            $this->movieDAO = new MovieDAO();
            $this->utils = new Utils();
        }

        public function ShowStatistics(){
            $cinemaList = $this->cinemaDAO->GetAll();
            $movieList = $this->movieDAO->GetAll();
            $response = array();
            $i = 0;

            foreach($cinemaList as $cinema){
                foreach($cinema->getRooms() as $room){
                    foreach($room->getFunctions() as $function){
                        $tickets = $room->getCapacity() - $function->getTickets();
                        $total = $tickets * $cinema->getTicketValue();
                        $response[$i]['cinema'] = $cinema->getName();
                        $response[$i]['date'] = $function->getDate();
                        $response[$i]['totalTickets'] = $room->getCapacity();
                        $response[$i]['availableTickets'] = $function->getTickets();
                        $response[$i]['remainder'] = $tickets;
                        $response[$i]['total'] = $total;
                        foreach($movieList as $movie){
                            if($movie->getId() == $function->getMovieId()){
                            $response[$i]['movie'] = $movie->getTitle();
                            }
                        }
                        $i++;
                    }
                }
            }
            require_once(VIEWS_PATH."statistics.php");

        }

        

    }



?>