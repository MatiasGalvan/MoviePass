<?php

    namespace Controllers;

    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use Controllers\HomeController as HomeController;
    use Utils\Utils as Utils; 

    class RoomController{

        private $roomDAO;
        private $CinemaDAO;
        private $utils;

        public function __construct(){
            $this->roomDAO = new RoomDAO();
            $this->CinemaDAO = new CinemaDAO();
            $this->utils = new Utils();
        }
        
        public function ShowAddRoomView($idCinema = "",$data = array(), $errors = array(), $message = ""){
            require_once(VIEWS_PATH."add-room.php");
        }

        public function AddRoom($idCinema, $roomName, $capacity){
            if($this->utils->ValidateAdmin()){

                $errors = $this->checkData($idCinema, $roomName, $capacity);

                if(count($errors) == 0){
                    $cinema = $this->CinemaDAO->GetById($idCinema);

                    $room = new Room();
                    $room->setIdCinema($idCinema);
                    $room->setRoomName($roomName);
                    $room->setCapacity($capacity);
        
                    $this->roomDAO->Add($room);
                    $cap = $cinema->getCapacity() + $capacity;
                    $this->CinemaDAO->UpdateCapacity($cinema->getId(), $cap);
        
                    $this->ShowAddRoomView($idCinema, array(), array(), "Room added successfully");
                }
                else{
                    $data['roomName'] = $roomName;
                    $data['capacity'] = $capacity;
                    $this->ShowAddRoomView($idCinema, $data, $errors);
                }
            }
            else{
                $home = new HomeController();
                $home->Logout("You are not allowed to see this page");
            }
        }

        private function checkData($idCinema, $roomName, $capacity){
            $errors = array();

            if (!$this->CinemaDAO->ExistID($idCinema)) array_push($errors, "The ID entered does not exist");
            if (!$this->utils->checkString($roomName)) array_push($errors, "Invalid format. Name must be between 3 and 20 characters. And start with uppercase.");
            if (!$this->utils->checkNumber($capacity)) array_push($errors, "Invalid format. Value must be between 1 to 4 digits.");
            if ($this->roomDAO->ExistName($roomName,$idCinema)) array_push($errors, "The name entered is already taken");

            return $errors;
        }

        public function RemoveRoom($idRoom){
            if($this->utils->ValidateAdmin()){
                $message = "The ID entered does not exist";

                if($this->roomDAO->ExistID($idRoom)){
                    $this->roomDAO->Remove($idRoom);
                    $message = "Cinema removed successfully";
                }
                
                #$this->ShowRooms($message); ESTO NO EXISTE
            }
            else{
                $home = new HomeController();
                $home->Logout("You are not allowed to see this page");
            }
        }     
    }

?>