<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IRoomDAO as IRoomDAO;
    use Models\Room as Room;

    class RoomDAO implements IRoomDAO{

        private $connection;
        private $tableName = "Room";

        public function __construct(){
            $this->functions = new MovieFunctionDAO();
        }

        public function ExistID($idRoom){
            try{
                $response = false;
                $query = "SELECT idRoom FROM ".$this->tableName." WHERE idRoom = :idRoom";
                $param['idRoom'] = $idRoom;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $param);

                foreach ($resultSet as $row){   
                    if($row['idRoom'] != null){
                        $response = true;
                    }
                }

                return $response;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Add(Room $room){
            try{
                $query = "INSERT INTO ".$this->tableName." (idCinema,roomName,capacity) VALUES (:idCinema,:roomName,:capacity);";

                $parameters["idCinema"] = $room->getIdCinema();
                $parameters["roomName"] = $room->getRoomName();
                $parameters["capacity"] = $room->getCapacity();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){
            try{
                $roomList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                

                    $room = new Room();
                    $room->setIdRoom($row["idRoom"]);
                    $room->setIdCinema($row["idCinema"]);
                    $room->setRoomName($row["roomName"]);
                    $room->setCapacity($row["capacity"]);
                    array_push($roomList, $room);
                }

                return $roomList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($idRoom){
            try{                
                $query = "DELETE FROM ".$this->tableName." WHERE idRoom = :idRoom";
                $param['idRoom'] = $idRoom;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $param);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetById($idRoom){
            try{
                $room = new Room();

                $query = "SELECT * FROM ".$this->tableName." WHERE idRoom = :idRoom";

                $parameters['idRoom'] = $idRoom;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row){                

                    $room->setIdRoom($row["idRoom"]);
                    $room->setIdCinema($row["idCinema"]);
                    $room->setRoomName($row["roomName"]);
                    $room->setCapacity($row["capacity"]);                 
                }

                return $room;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

    }

?>