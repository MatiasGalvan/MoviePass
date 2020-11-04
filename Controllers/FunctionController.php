<?php

    namespace Controllers;

    use Models\MovieFunction as MovieFunction;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use Controllers\CinemaController as CinemaController;   
    use Utils\Utils as Utils; 

    class FunctionController{

        private $MovieFunctionDAO;
        private $MovieDAO;
        private $CinemaDAO;
        private $utils;

        public function __construct(){
            $this->MovieFunctionDAO = new MovieFunctionDAO();
            $this->MovieDAO = new MovieDAO();
            $this->CinemaDAO = new CinemaDAO();
            $this->utils = new Utils();
        }

        public function ShowAddFunctionView($idCinema = "", $data = array(), $errors = array(), $message = ""){
            if($this->CinemaDAO->ExistID($idCinema)){
                $movieList = $this->MovieDAO->GetAll();
                require_once(VIEWS_PATH."add-functions.php");
            }
            else{
                $cinemas = new CinemaController();
                $cinemas->ShowCinemas("A valid ID was not sent");
            }
        }
        
        public function ShowFunctions(){
            $cinemaList = $this->CinemaDAO->GetAll();
            require_once(VIEWS_PATH."functions-list.php");
        }

        public function AddFunction($date, $start, $idMovie, $idCinema){

            $errors = $this->checkData($date);

            if(count($errors) == 0){
                $MovieFunction = new MovieFunction();
                $MovieFunction->setDate($date);
                $MovieFunction->setStart($start);
                $MovieFunction->setMovieId($idMovie);
                
                $this->MovieFunctionDAO->Add($MovieFunction, $idCinema);
    
                $this->ShowAddFunctionView($idCinema, array(), array(), "Function added successfully");
            }
            else{
                $data['date'] = $date;
                $data['start'] = $start;
                $data['idMovie'] = $idMovie;
                $this->ShowAddFunctionView($idCinema, $data, $errors);
            }
        }

        private function checkData($date){
            $errors = array();
            if (!$this->utils->checkDate($date)) array_push($errors, "Date cannot be earlier than current.");
            return $errors;
        }

    }

?>