<?php

    namespace DAO;
    //.
    
    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;

    class GenreDAO implements IGenreDAO{

        private $genreList = array();
        private $fileName;

        public function __construct(){
            $this->fileName = dirname(__DIR__)."/Data/genre.json";
        }



        public function Add(Genre $genre){
            $this->RetrieveData();
            array_push($this->genreList, $genre);
            $this->SaveData();
        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->genreList;
        }

 
        public function Remove($id){
            $this->retrieveData();
            $newList = array();
            foreach ($this->genreList  as $genre) {
                if($genre->getId() != $id){
                    array_push($newList, $genre);
                }
            }
            $this->genreList = $newList;
            $this->saveData();
        }

        private function SaveData(){
            $arrayToEncode = array();

            foreach ($this->genreList as $genre) {
                $valuesArray['id'] = $genre->getId();
                $valuesArray['name'] = $genre->getName();
                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData(){
            $this->genreList = array();

            if(file_exists($this->fileName)){
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                
                foreach($arrayToDecode as $valuesArray){
                    $id = $valuesArray['id'];
                    $name = $valuesArray['name'];
                    $genre = new Genre();
                    $genre->setId($id);
                    $genre->setName($name);

                    array_push($this->genreList, $genre);
                }
            }
        }
    }

?>