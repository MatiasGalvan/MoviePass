<?php

    namespace Controllers;

    use Models\Ticket as Ticket;
    use DAO\TicketDAO as TicketDAO;
    use DAO\UserDAO as UserDAO;

    class TicketController{

        private $ticketDAO;
        private $userDAO;

        public function __construct(){
            $this->ticketDAO = new TicketDAO();
            $this->userDAO = new UserDAO();
        }

        public function ShowTicketPurchaseView($cinemaName, $idFunction, $functionDate, $functionStart,$ticketValue,$data = array(), $errors = array(), $message = ""){
            require_once(VIEWS_PATH."add-ticket.php");
        }


        public function ShowTickets($message = ""){
            $ticketList = $this->ticketDAO->GetTickets($_SESSION["idUser"]);
            if(empty($ticketList)){
                $empty = "No tickets available";
            }
            require_once(VIEWS_PATH."tickets-list.php");
        }

        public function AddTicket($cinemaName, $idFunction, $functionDate, $functionStart, $finalValue, $quantity){
            $errors = array();

            if(count($errors) == 0){
                $ticket = new Ticket();
                $ticket->setCinemaName($cinemaName);
                $ticket->setIdFunction($idFunction);
                $ticket->setFunctionDate($functionDate);
                $ticket->setFunctionStart($functionStart);
                $ticket->setFinalValue($finalValue);
                $ticket->setQuantity($quantity);
                $ticket->setIdUser($this->userDAO->GetByEmail($_SESSION["email"]));

                $this->ticketDAO->Add($ticket);

                $this->ShowTicketPurchaseView("","","","","",array(), array(), "Ticket added successfully");
            }
            else{
                $data['cinemaName'] = $cinemaName;
                $data['idFunction'] = $idFunction;
                $data['functionDate'] = $functionDate;
                $data['functionStart'] = $functionStart;
                $data['finalValue'] = $finalValue;
                $data['quantity'] = $quantity;
                $this->ShowTicketPurchaseView($data, $errors);
            }
        }

        public function RemoveTicket($idTicket){
            $message = "The ID entered does not exist";

            if($this->ticketDAO->ExistID($idTicket)){
                $this->ticketDAO->Remove($idTicket);
                $message = "Ticket removed successfully";
            }

            $this->ShowTicketPurchaseView($data,$errors);
        }

    }

?>