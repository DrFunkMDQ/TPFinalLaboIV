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

        public function ShowAddCinema(){
            require_once(VIEWS_PATH."addCinema.php");
        }        

        public function AddCinema($name, $address, $capacity, $ticketPrice){
            $cinema = new Cinema();
            $cinema->setCinemaName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setTicketPrice($ticketPrice);

            $this->cinemaDAO->Add($cinema);
            $this->ShowAddCinema();
        }
    }
?>