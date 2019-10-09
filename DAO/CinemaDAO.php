<?php
    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;

    class CinemaDAO implements ICinemaDAO
    {
        private $cinemaList = array();

        public function Add(Cinema $cinema){
            $this->RetrieveData();
            array_push($this->cinemaList, $cinema);
            $this->SaveData();
        }

        public function GetAll(){
            $this->RetrieveData();

            return $this->cinemaList;
        }

        public function SaveData(){
            $arrayToEncode = array();
            foreach($this->cinemaList as $cinema){   
                $valuesArray["CinemaName"] = $cinema->getCinemaName();
                $valuesArray["Address"] = $cinema->getAddress();
                $valuesArray["Capacity"] = $cinema->getCapacity();
                $valuesArray["TicketPrice"] = $cinema->getTicketPrice();

                array_push($arrayToEncode, $valuesArray);
            }

            var_dump($arrayToEncode);

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/Cinemas.json', $jsonContent);
        }

        public function Search(){

        }

        public function Remove(){

            return 1;
        }

        public function RetrieveData(){
            $this->cinemaList = array();

            if(file_exists('Data/Cinemas.json'))
            {
                $jsonContent = file_get_contents('Data/Cinemas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cinema = new Cinema();
                    $cinema->setCinemaName($valuesArray["CinemaName"]);
                    $cinema->setAddress($valuesArray["Address"]);
                    $cinema->setCapacity($valuesArray["Capacity"]);
                    $cinema->setTicketPrice($valuesArray["TicketPrice"]);

                    array_push($this->cinemaList, $cinema);
                }
            }
        }
    }
?>