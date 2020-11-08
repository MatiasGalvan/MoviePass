<?php

    namespace Controllers;

    use Models\Ticket as Ticket;
    use DAO\TicketDAO as TicketDAO;
    use DAO\UserDAO as UserDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use Controllers\HomeController as HomeController;
    use Utils\Utils as Utils; 

    class TicketController{

        private $ticketDAO;
        private $userDAO;
        private $movieDAO;
        private $functionDAO;
        private $utils;

        public function __construct(){
            $this->ticketDAO = new TicketDAO();
            $this->userDAO = new UserDAO();
            $this->movieDAO = new MovieDAO();
            $this->functionDAO = new MovieFunctionDAO();
            $this->utils = new Utils();
        }

        public function ShowTicketPurchaseView($cinemaName, $idFunction, $functionDate, $functionStart,$ticketValue,$data = array(), $errors = array(), $message = ""){
            require_once(VIEWS_PATH."add-ticket.php");
        }


        public function ShowTickets($message = ""){
            $ticketList = $this->ticketDAO->GetTickets($_SESSION["idUser"]);
            if(empty($ticketList)){
                $empty = "No tickets available";
            }

            $movieList = $this->movieDAO->GetAll();
            $data = array();
            $i = 0;

            foreach($ticketList as $ticket){
                $f = $this->functionDAO->GetById($ticket->getIdFunction());
                $data[$i][0] = $ticket->getIdFunction();

                foreach($movieList as $movie){
                    if($movie->getId() == $f->getMovieId()){
                        $data[$i][1] = $movie->getTitle();
                    }
                }

                $i++;
            }

            require_once(VIEWS_PATH."tickets-list.php");
        }

        public function AddTicket($cinemaName, $idFunction, $functionDate, $functionStart, $ticketValue, $quantity){
            if($this->utils->ValidateAdmin()){
                $errors = array();
                
                if(count($errors) == 0){
                    $ticket = new Ticket();
                    $ticket->setCinemaName($cinemaName);
                    $ticket->setIdFunction($idFunction);
                    $ticket->setFunctionDate($functionDate);
                    $ticket->setFunctionStart($functionStart);
                    $ticket->setFinalValue($ticketValue * $quantity);
                    $ticket->setQuantity($quantity);
                    $ticket->setIdUser($this->userDAO->GetByEmail($_SESSION["email"]));

                    $this->ticketDAO->Add($ticket);

                    $this->ShowTicketPurchaseView($cinemaName, $idFunction, $functionDate, $functionStart, $ticketValue, array(), array(), "Ticket added successfully");
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
            else{
                $home = new HomeController();
                $home->Logout("You are not allowed to see this page");
            }
        }

    }

?>