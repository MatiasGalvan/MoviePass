<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\RoomDAO as RoomDAO;

    class CinemaDAO implements ICinemaDAO{

        private $connection;
        private $tableName = "Cinema";
        private $functions;
        private $rooms;

        public function __construct(){
            $this->functions = new MovieFunctionDAO();
            $this->rooms = new RoomDAO();
        }

        public function Exist($address){
            try{
                $response = false;
                $query = "SELECT address FROM ".$this->tableName." WHERE address = :address";
                $param['address'] = $address;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $param);

                foreach ($resultSet as $row){   
                    if($row['address'] != null){
                        $response = true;
                    }
                }

                return $response;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function ExistName($cinemaName){
            try{
                $response = false;
                $query = "SELECT cinemaName FROM ".$this->tableName." WHERE cinemaName = :cinemaName";
                $param['cinemaName'] = $cinemaName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $param);

                foreach ($resultSet as $row){
                    if($row['cinemaName'] != null){
                        $response = true;
                    }
                }

                return $response;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function ExistID($idCinema){
            try{
                $response = false;
                $query = "SELECT idCinema FROM ".$this->tableName." WHERE idCinema = :idCinema";
                $param['idCinema'] = $idCinema;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $param);

                foreach ($resultSet as $row){   
                    if($row['idCinema'] != null){
                        $response = true;
                    }
                }

                return $response;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Add(Cinema $cinema){
            try{
                $query = "INSERT INTO ".$this->tableName." (cinemaName, address, capacity, ticketValue) VALUES (:cinemaName, :address, :capacity, :ticketValue);";

                $parameters["cinemaName"] = $cinema->getName();
                $parameters["address"] = $cinema->getAddress();
                $parameters["capacity"] = 0;
                $parameters["ticketValue"] = $cinema->getTicketValue();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){
            try{
                $cinemaList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                

                    $cinema = new Cinema();
                    $cinema->setId($row["idCinema"]);
                    $cinema->setName($row["cinemaName"]);
                    $cinema->setAddress($row["address"]);
                    $cinema->setCapacity($row["capacity"]);
                    $cinema->setTicketValue($row["ticketValue"]);
                    $rooms = $this->rooms->GetRooms($row["idCinema"]);
                    $cinema->setRooms($rooms);

                    array_push($cinemaList, $cinema);
                }
                return $cinemaList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($idCinema){
            try{                
                $query = "DELETE FROM ".$this->tableName." WHERE idCinema = :idCinema";
                $param['idCinema'] = $idCinema;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $param);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Update(Cinema $cinema){
            try{                
                $query = "UPDATE ".$this->tableName." SET cinemaName = :cinemaName, address = :address, ticketValue = :ticketValue WHERE idCinema = :idCinema;";
                
                $parameters['idCinema'] = $cinema->getId();
                $parameters["cinemaName"] = $cinema->getName();
                $parameters["address"] = $cinema->getAddress();
                $parameters["ticketValue"] = $cinema->getTicketValue();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function UpdateCapacity($idCinema, $capacity){
            try{                
                $query = "UPDATE ".$this->tableName." SET capacity = :capacity WHERE idCinema = :idCinema;";
                
                $parameters['idCinema'] = $idCinema;
                $parameters["capacity"] = $capacity;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetById($idCinema){
            try{
                $cinema = new Cinema();

                $query = "SELECT * FROM ".$this->tableName." WHERE idCinema = :idCinema";

                $parameters['idCinema'] = $idCinema;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row){                

                    $cinema->setId($row["idCinema"]);
                    $cinema->setName($row["cinemaName"]);
                    $cinema->setAddress($row["address"]);
                    $cinema->setCapacity($row["capacity"]);
                    $cinema->setTicketValue($row["ticketValue"]);
                    $rooms = $this->rooms->GetRooms($row["idCinema"]);
                    $cinema->setRooms($rooms);
                    
                }

                return $cinema;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

    }

?>