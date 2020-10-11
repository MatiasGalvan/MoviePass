<?php

    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;

    class CinemaDAO implements ICinemaDAO{

        private $cinemaList = array();
        private $fileName;

        public function __construct(){
            $this->fileName = dirname(__DIR__)."/Data/cinemas.json";
        }

        public function Add(Cinema $cinema){
            $this->RetrieveData();
            array_push($this->cinemaList, $cinema);
            $this->SaveData();
        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->cinemaList;
        }

        /*public function Remove($name){
            $response = false;
            $i = 0;
            $this->RetrieveData();

            foreach($this->userList as $user){
                if($user->getEmail() == $name){
                    unset($this->userList[$i]);
                    $this->SaveData();
                    $response = true;
                }
                $i++;
            }
            return $response;
        }*/ #Ver el tipo de parametro para remover

        public function Remove($id){
            $this->retrieveData();
            $newList = array();
            foreach ($this->cinemaList as $cinema) {
                if($cinema->getId() != $id){
                    array_push($newList, $cinema);
                }
            }
            $this->cinemaList = $newList;
            $this->saveData();
        }

        private function SaveData(){
            $arrayToEncode = array();

            foreach ($this->cinemaList as $cinema) {
                $valuesArray['id'] = $cinema->getId();
                $valuesArray['name'] = $cinema->getName();
                $valuesArray['address'] = $cinema->getAddress();
                $valuesArray['capacity'] = $cinema->getCapacity();
                $valuesArray['ticketValue'] = $cinema->getTicketValue();
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData(){
            $this->cinemaList = array();

            if(file_exists($this->fileName)){
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $id = $valuesArray['id'];
                    $name = $valuesArray['name'];
                    $address = $valuesArray['address'];
                    $capacity = $valuesArray['capacity'];
                    $ticketValue = $valuesArray['ticketValue'];

                    $cinema = new Cinema();
                    $cinema->setId($id);
                    $cinema->setName($name);
                    $cinema->setAddress($address);
                    $cinema->setCapacity($capacity);
                    $cinema->setTicketValue($ticketValue);

                    array_push($this->cinemaList, $cinema);
                }
            }
        }
    }

?>