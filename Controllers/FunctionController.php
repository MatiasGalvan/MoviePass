<?php

    namespace Controllers;

    use Models\MovieFunction as MovieFunction;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use Controllers\CinemaController as CinemaController;    

    class FunctionController{

        private $MovieFunctionDAO;
        private $MovieDAO;
        private $CinemaDAO;

        public function __construct(){
            $this->MovieFunctionDAO = new MovieFunctionDAO();
            $this->MovieDAO = new MovieDAO();
            $this->CinemaDAO = new CinemaDAO();
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
            if (!$this->checkDate($date)) array_push($errors, "Date cannot be earlier than current.");
            return $errors;
        }

        private function checkDate($date){
            $response = true;
            $time = time();
            $currentDate = date("Y-m-d", $time);
            
            if($date < $currentDate) $response = false;

            return $response;
        }

    }

?>