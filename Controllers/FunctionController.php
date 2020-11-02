<?php

    namespace Controllers;

    use Models\MovieFunction as MovieFunction;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\MovieDAO as MovieDAO;
    

    class FunctionController{

        private $MovieFunctionDAO;
        private $MovieDAO;

        public function __construct(){
            $this->MovieFunctionDAO = new MovieFunctionDAO();
            $this->MovieDAO = new MovieDAO();
        }

        public function ShowAddFunctionView($idCinema = "", $data = array(), $errors = array(), $message = ""){
            $movieList = $this->MovieDAO->GetAll();
            require_once(VIEWS_PATH."add-functions.php");
        }
        
        public function ShowFunctions(){
            $functionList = $this->MovieFunctionDAO->GetAll();
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