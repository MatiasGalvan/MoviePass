<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\ITicketDAO as ITicketDAO;
    use Models\Ticket as Ticket;

    class TicketDAO{

        private $connection;
        private $tableName = "Ticket";

        public function __construct(){
        }

        public function Exist($idTicket){
            try{
                $response = false;
                $query = "SELECT address FROM ".$this->tableName." WHERE idTicket = :idTicket";
                $param['idTicket'] = $idTicket;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $param);

                foreach ($resultSet as $row){   
                    if($row['idTicket'] != null){
                        $response = true;
                    }
                }

                return $response;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Add(Ticket $ticket){
            try{
                $query = "INSERT INTO ".$this->tableName." (cinemaName, idFunction, functionDate, functionStart, finalValue, idUser,quantity) VALUES (:cinemaName, :idFunction, :functionDate, :functionStart, :finalValue, :idUser, :quantity);";

                $parameters["cinemaName"] = $ticket->getCinemaName();
                $parameters["idFunction"] = $ticket->getIdFunction();
                $parameters["functionDate"] = $ticket->getFunctionDate();
                $parameters["functionStart"] = $ticket->getFunctionStart();
                $parameters["finalValue"] = $ticket->getFinalValue();
                $parameters["idUser"] = $ticket->getIdUser();
                $parameters["quantity"] = $ticket->getQuantity();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){
            try{
                $ticketList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                

                    $ticket = new Ticket();
                    $ticket->setIdTicket($row["idTicket"]);
                    $ticket->setCinemaName($row["cinemaName"]);
                    $ticket->setIdFunction($row["idFunction"]);
                    $ticket->setFunctionDate($row["functionDate"]);
                    $ticket->setFunctionStart($row["functionStart"]);
                    $ticket->setFinalValue($row["finalValue"]);
                    $ticket->setIdUser($row["idUser"]);
                    $ticket->setQuantity($row["quantity"]);
                    array_push($ticketList, $ticket);
                }

                return $ticketList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($idTicket){
            try{                
                $query = "DELETE FROM ".$this->tableName." WHERE idTicket = :idTicket";
                $param['idTicket'] = $idTicket;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $param);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetTickets($idUser){
            try{
                $ticketsList = array();

                $query = "SELECT * FROM " . $this->tableName . " WHERE idUser = :idUser";

                $parameters["idUser"] = $idUser;
                    
                $this->connection = Connection::GetInstance();

                $tickets = $this->connection->Execute($query, $parameters);

                foreach($tickets as $ticket){
                    $tk = new Ticket();
                    $tk->setIdTicket($ticket["idTicket"]);
                    $tk->setCinemaName($ticket["cinemaName"]);
                    $tk->setIdFunction($ticket["idFunction"]);
                    $tk->setFunctionDate($ticket["functionDate"]);
                    $tk->setFunctionStart($ticket["functionStart"]);
                    $tk->setFinalValue($ticket["finalValue"]);
                    $tk->setIdUser($ticket["idUser"]); 
                    $tk->setQuantity($ticket["quantity"]); 
                    array_push($ticketsList, $tk);
                }

                return $ticketsList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }

?>