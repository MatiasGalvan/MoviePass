<?php

    namespace Controllers;

    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;
    use Utils\Utils as Utils; 

    class RoomController{

        private $roomDAO;
        private $utils;

        public function __construct(){
            $this->roomDAO = new RoomDAO();
            $this->utils = new Utils();
        }
        
        public function ShowAddRoomView($idCinema = "",$data = array(), $errors = array(), $message = ""){
            require_once(VIEWS_PATH."add-room.php");#CAMBIAR ESTO
        }

        public function ShowRooms($message = ""){
            $roomList = $this->roomDAO->GetAll();
            require_once(VIEWS_PATH."cinema-list.php");#CAMBIAR ESTO
        }

        public function AddRoom($idCinema, $roomName, $capacity){
            #$errors = $this->checkData($idRoom, $idCinema, $roomName, $capacity);
                $room = new Room();
                $room->setIdCinema($idCinema);
                $room->setRoomName($roomName);
                $room->setCapacity($capacity);
    
                $this->roomDAO->Add($room);
    
                $this->ShowAddRoomView(array(), array(), "Room added successfully");
 
        }

        private function checkData($name, $address, $capacity, $ticketValue, $update = -1){
            $errors = array();

            if (!$this->utils->checkString($name)) array_push($errors, "Invalid format. Name must be between 3 and 20 characters. And start with uppercase.");
            if (!$this->utils->checkAddress($address)) array_push($errors, "Invalid format. Start with uppercase. Address must be between 3 and 20 characters. Followed by number");
            if (!$this->utils->checkNumber($capacity)) array_push($errors, "Invalid format. Value must be between 1 to 4 digits.");
            if (!$this->utils->checkNumber($ticketValue)) array_push($errors, "Invalid format. Value must be between 1 to 5 digits. Numbers with commas can be included");
            if($update == -1){
                if ($this->cinemaDAO->Exist($address)) array_push($errors, "The address is already taken.");
            }
            else{
                $modifyCinema = $this->cinemaDAO->GetById($update);
                if($modifyCinema->getAddress() != $address){
                    if ($this->cinemaDAO->Exist($address)) array_push($errors, "The address is already taken.");
                }
            }

            return $errors;
        }

        public function RemoveRoom($idRoom){
            $message = "The ID entered does not exist";

            if($this->roomDAO->ExistID($idRoom)){
                $this->roomDAO->Remove($idRoom);
                $message = "Cinema removed successfully";
            }
            
            $this->ShowRooms($message);
        }     
    }

?>