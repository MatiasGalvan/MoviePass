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

                $MovieFunction = new MovieFunction();
                $MovieFunction->setDate($date);
                $MovieFunction->setStart($start);
                $MovieFunction->setMovieId($idMovie);
                
                $this->MovieFunctionDAO->Add($MovieFunction, $idCinema);
    
                $this->ShowAddFunctionView(array(), array(), "Function added successfully");
        }

        private function checkData($date, $start, $idMovie){
            $errors = array();
            if (!$this->checkNumber($idMovie)) array_push($errors, "Invalid format. Value must be between 1 to 4 digits.");
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

    }

?>