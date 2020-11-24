<?php

    namespace Controllers;

    use Models\MovieFunction as MovieFunction;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use Controllers\CinemaController as CinemaController;   
    use Controllers\HomeController as HomeController;
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
                $room = $this->RoomDAO->GetById($idRoom);
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
            $movieList = $this->MovieDAO->GetAll();
            if(empty($cinemaList)) $message = "No functions available";
            require_once(VIEWS_PATH."functions-list.php");
        }

        public function AddFunction($date, $start, $idMovie, $idRoom){
            if($this->utils->ValidateAdmin()){
                $errors = $this->checkData($date,$start,$idRoom,$idMovie);

                if(count($errors) == 0){
                    $MovieFunction = new MovieFunction();
                    $MovieFunction->setDate($date);
                    $MovieFunction->setStart($start);
                    $MovieFunction->setMovieId($idMovie);
                    $MovieFunction->setIdRoom($idRoom);

                    $room = $this->RoomDAO->GetById($idRoom);

                    $MovieFunction->setTickets($room->getCapacity());
                    
                    $this->MovieFunctionDAO->Add($MovieFunction);
        
                    $this->ShowAddFunctionView($idRoom, array(), array(), "Function added successfully");
                }
                else{
                    $data['date'] = $date;
                    $data['start'] = $start;
                    $data['idMovie'] = $idMovie;
                    $data['idRoom'] = $idRoom;
                    $this->ShowAddFunctionView($idRoom, $data, $errors);
                }
            }
            else{
                $home = new HomeController();
                $home->Logout("You are not allowed to see this page");
            }
        }

        
        private function checkData($date, $start, $idRoom, $idMovie){
            $errors = array();
            $currentDate = date("Y-m-d", time());
            $currentTime = date("H:i:s", time());

            $start = date("H:i:s", strtotime($start));

            if (!$this->utils->checkDate($date)) array_push($errors, "Date cannot be earlier than current.");
            if($date == $currentDate && $start < $currentTime) array_push($errors, "Time cannot be earlier than current.");

            if (!$this->RoomDAO->ExistID($idRoom)){
                array_push($errors, "The ID Room entered does not exist.");
            }
            else{
                $room = $this->RoomDAO->GetById($idRoom);
                $functions = $room->getFunctions();
                $flag = true;
                $i = 0;

                while($flag == true && $i < count($functions) ){
                    
                    $movie = $this->MovieDAO->GetById($functions[$i]->getMovieId());
                    $time = $this->utils->AddMinutes($functions[$i]->getStart(), $movie->getRuntime());
                    $time = $this->utils->AddMinutes($time, 15);

                    $movie = $this->MovieDAO->GetById($idMovie);
                    $end = $this->utils->AddMinutes($start, $movie->getRuntime());

                    if($functions[$i]->getDate() == $date ){
                        if( ($start >= $functions[$i]->getStart() && $start <= $time) || ( $end >= $functions[$i]->getStart() && $end <= $time) ){
                            $flag = false;
                        }
                    }
                    $i++;
                }
                echo $flag;
                if (!$flag) array_push($errors, "The schedule is not available.");
            }

            return $errors;
        }
        
    }

?>