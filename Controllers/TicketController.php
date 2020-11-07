<?php

    namespace Controllers;

    use Models\Ticket as Ticket;
    use DAO\TicketDAO as TicketDAO;

    class TicketController{

        private $ticketDAO;

        public function __construct(){
            $this->ticketDAO = new TicketDAO();
        }

        public function ShowTicketPurchaseView($data = array(), $errors = array(), $message = ""){
            require_once(VIEWS_PATH."add-ticket.php");
        }


        public function ShowTickets($message = ""){
            $ticketList = $this->ticketDAO->GetAll();
            require_once(VIEWS_PATH."ticket-list.php");
        }

        public function AddTicket($cinemaName, $idFunction, $functionDate, $functionStart, $finalValue){

            $errors = array();

            if(count($errors) == 0){
                $ticket = new Ticket();
                $ticket->setCinemaName($cinemaName);
                $ticket->setIdFunction($idFunction);
                $ticket->setFunctionDate($functionDate);
                $ticket->setFunctionStart($functionStart);
                $ticket->setFinalValue($finalValue);

                $this->ticketDAO->Add($ticket);

                $this->ShowTicketPurchaseView(array(), array(), "Ticket added successfully");
            }
            else{
                $data['cinemaName'] = $cinemaName;
                $data['idFunction'] = $idFunction;
                $data['functionDate'] = $functionDate;
                $data['functionStart'] = $functionStart;
                $data['finalValue'] = $finalValue;
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