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
            require_once(VIEWS_PATH."statistics.php");
        }

        public function FilterStats($idCinema, $idMovie, $start, $end){

        }

    }



?>