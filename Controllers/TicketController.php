<?php

    namespace Controllers;

    use Models\Ticket as Ticket;
    use DAO\TicketDAO as TicketDAO;
    use DAO\UserDAO as UserDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use Controllers\HomeController as HomeController;
    use Utils\Utils as Utils; 

    class TicketController{

        private $TicketDAO;
        private $UserDAO;
        private $MovieDAO;
        private $FunctionDAO;
        private $CinemaDAO;
        private $RoomDAO;
        private $utils;

        public function __construct(){
            $this->TicketDAO = new TicketDAO();
            $this->UserDAO = new UserDAO();
            $this->MovieDAO = new MovieDAO();
            $this->FunctionDAO = new MovieFunctionDAO();
            $this->CinemaDAO = new CinemaDAO();
            $this->RoomDAO = new RoomDAO();
            $this->utils = new Utils();
        }

        public function ShowTicketPurchaseView($idCinema, $idFunction, $data = array(), $errors = array(), $message = ""){
            if($this->utils->ValidateUser()){
                if($this->CinemaDAO->ExistID($idCinema) && $this->FunctionDAO->ExistID($idFunction)){
                    $cinema = $this->CinemaDAO->GetById($idCinema);
                    require_once(VIEWS_PATH."add-ticket.php");
                }
                else{
                    $home = new HomeController();
                    $home->Logout("There was a problem loading the data");
                }
            }
            else{
                $home = new HomeController();
                $home->Logout("You are not allowed to see this page");
            }
        }

        public function ShowTickets($message = ""){
            if($this->utils->ValidateUser()){
                $ticketList = $this->TicketDAO->GetTickets($_SESSION["idUser"]);
                if(empty($ticketList)){
                    $empty = "No tickets available";
                }

                $movieList = $this->MovieDAO->GetAll();
                $data = array();
                $i = 0;

                foreach($ticketList as $ticket){
                    $function = $this->FunctionDAO->GetById($ticket->getIdFunction());
                    $cinema = $this->CinemaDAO->GetById($ticket->getIdCinema());

                    $data[$i]["idTicket"] = $ticket->getIdTicket();
                    $data[$i]["cinemaName"] = $cinema->getName();
                    $data[$i]["date"] = $function->getDate();
                    $data[$i]["time"] = $function->getStart();
                    $data[$i]["quantity"] = $ticket->getQuantity();
                    $data[$i]["total"] = $ticket->getFinalValue();

                    foreach($movieList as $movie){
                        if($movie->getId() == $function->getMovieId()){
                            $data[$i]["movie"] = $movie->getTitle();
                        }
                    }

                    $i++;
                }

                require_once(VIEWS_PATH."tickets-list.php");
            }
            else{
                $home = new HomeController();
                $home->Logout("You are not allowed to see this page");
            }
        }

        public function ShowTicketDetails($idTicket, $message = ""){
            if($this->TicketDAO->Exist($idTicket)){
                $movieList = $this->MovieDAO->GetAll();
                $data = array();

                $ticket = $this->TicketDAO->GetById($idTicket);
                $function = $this->FunctionDAO->GetById($ticket->getIdFunction());
                $cinema = $this->CinemaDAO->GetById($ticket->getIdCinema());
                $room = $this->RoomDAO->GetById($function->getIdRoom());

                $data["idTicket"] = $ticket->getIdTicket();
                $data["cinemaName"] = $cinema->getName();
                $data["date"] = $function->getDate();
                $data["time"] = $function->getStart();
                $data["quantity"] = $ticket->getQuantity();
                $data["total"] = $ticket->getFinalValue();
                $data["room"] = $room->getRoomName();
                
                foreach($movieList as $movie){
                    if($movie->getId() == $function->getMovieId()){
                        $data["movie"] = $movie->getTitle();
                    }
                }

                require_once(VIEWS_PATH."ticket-details.php");
            }
            else{
                $home = new HomeController();
                $home->Logout("The ID entered does not exist.");
            }
        }

        public function AddTicket($idCinema, $idFunction, $quantity){
            if($this->utils->ValidateUser()){
                $errors = $this->checkData($idCinema, $idFunction, $quantity);;
                    
                if(count($errors) == 0){
                    $ticket = new Ticket();
                    $ticket->setIdCinema($idCinema);
                    $ticket->setIdFunction($idFunction);
                    $ticket->setQuantity($quantity);
                    $ticket->setIdUser($this->UserDAO->GetByEmail($_SESSION["email"]));
                    
                    $cinema = $this->CinemaDAO->GetById($idCinema);
                    $ticket->setFinalValue($cinema->GetTicketValue() * $quantity);

                    $this->TicketDAO->Add($ticket);

                    $function = $this->FunctionDAO->GetById($idFunction);
                    $tickets = $function->getTickets() - $quantity;
                    $this->FunctionDAO->Update($idFunction, $tickets);

                    $this->ShowTicketPurchaseView($idCinema, $idFunction, array(), array(), "Ticket added successfully");
                }
                else{
                    $data['quantity'] = $quantity;
                    $this->ShowTicketPurchaseView($idCinema, $idFunction, $data, $errors);
                }
            }
            else{
                $home = new HomeController();
                $home->Logout("You are not allowed to see this page");
            }
        }

        private function checkData($idCinema, $idFunction, $quantity){
            $errors = array();
            if ($quantity < 0 || $quantity > 10) array_push($errors, "The number entered must be between 1 and 10.");
            if (!$this->CinemaDAO->ExistID($idCinema)) array_push($errors, "The cinema ID entered does not exist.");
            if (!$this->FunctionDAO->ExistID($idFunction)){
                array_push($errors, "The function ID entered does not exist.");
            }
            else{
                $function = $this->FunctionDAO->GetById($idFunction);
                if( ($function->getTickets() - $quantity) < 0) array_push($errors, "There are only " . $function->getTickets() . " tickets available.");
            }
            return $errors;
        }

    }

?>