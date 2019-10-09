<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;

    class CinemaController
    {
        private $cinemaDAO;

        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowAddCinemaView(){
            require_once(VIEWS_PATH."addCinema.php");
        }      
        
        public function ShowListCinemaView(){
            $this->cinemaDAO->GetAll();
            //var_dump($this->cinemaDAO);
            require_once(VIEWS_PATH."cinemaList.php");
        }     

        public function AddCinema($name, $address, $capacity, $ticketPrice){
            $cinema = new Cinema();
            $cinema->setCinemaName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setTicketPrice($ticketPrice);
            $this->cinemaDAO->Add($cinema);
            $this->ShowAddCinemaView();
        }
        
        public function RemoveCinema($cinemaName){            
            $this->cinemaDAO->Remove($cinemaName);
            $this->ShowListCinemaView();
        }
    }
?>