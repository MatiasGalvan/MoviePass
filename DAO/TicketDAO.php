<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\ITicketDAO as ITicketDAO;
    use Models\Ticket as Ticket;

    class TicketDAO implements ITicketDAO{

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

        public function ExistID($idTicket){
            try{
                $response = false;
                $query = "SELECT idTicket FROM ".$this->tableName." WHERE idTicket = :idTicket";
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
                $query = "INSERT INTO ".$this->tableName." (idCinema, idFunction, movieStart) VALUES (:idCinema, :idFunction, :movieStart);";

                $parameters["idCinema"] = $ticket->getIdCinema();
                $parameters["idFunction"] = $ticket->getIdFunction();
                $parameters["movieStart"] = $ticket->getMovieStart();

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
                    $ticket->setIdCinema($row["idCinema"]);
                    $ticket->setIdFunction($row["idFunction"]);
                    $ticket->setMovieStart($row["movieStart"]);

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
    }

?>