<?php

    namespace Controllers;

    use Models\MovieFunction as MovieFunction;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use Controllers\CinemaController as CinemaController;   
    use Utils\Utils as Utils; 

    class FunctionController{

        private $MovieFunctionDAO;
        private $MovieDAO;
        private $CinemaDAO;
        private $RoomDAO;
        private $utils;

        public function __construct(){
            $this->MovieFunctionDAO = new MovieFunctionDAO();
            $this->MovieDAO = new MovieDAO();
            $this->CinemaDAO = new CinemaDAO();
            $this->RoomDAO = new RoomDAO();
            $this->utils = new Utils();
        }

        public function ShowAddFunctionView($idRoom = "", $data = array(), $errors = array(), $message = ""){
            if($this->RoomDAO->ExistID($idRoom)){
                $movieList = $this->MovieDAO->GetAll();
                require_once(VIEWS_PATH."add-functions.php");
            }
            else{
                $cinemas = new CinemaController();
                $cinemas->ShowCinemas("A valid ID was not sent");
            }
        }
        
        public function ShowFunctions($message = ""){
            $cinemaList = $this->CinemaDAO->GetAll();
            if(empty($cinemaList)) $message = "No functions available";
            require_once(VIEWS_PATH."functions-list.php");
        }

        public function AddFunction($date, $start, $idMovie, $idRoom){

            $errors = $this->checkData($date);

            if(count($errors) == 0){
                $MovieFunction = new MovieFunction();
                $MovieFunction->setDate($date);
                $MovieFunction->setStart($start);
                $MovieFunction->setMovieId($idMovie);
                
                $this->MovieFunctionDAO->Add($MovieFunction, $idRoom);
    
                $this->ShowAddFunctionView($idRoom, array(), array(), "Function added successfully");
            }
            else{
                $data['date'] = $date;
                $data['start'] = $start;
                $data['idMovie'] = $idMovie;
                $this->ShowAddFunctionView($idRoom, $data, $errors);
            }
        }

        private function checkData($date){
            $errors = array();
            if (!$this->utils->checkDate($date)) array_push($errors, "Date cannot be earlier than current.");
            return $errors;
        }

    }

?>