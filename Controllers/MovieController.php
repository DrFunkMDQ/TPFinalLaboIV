<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieDAO;

        public function __construct(){
            $this->movieDAO = new MovieDAO();
        }

        public function ShowNowPlayingView(){
            require_once(VIEWS_PATH."nowPlayingList.php");
        }        

        public function ListNowPlayingMovies(){
            $this->movieDAO->getAll();
            $this->ShowNowPlayingView();
        }

        /*public function AddMovieList($name, $address, $capacity, $ticketPrice){
            $cinema = new Cinema();
            $cinema->setCinemaName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setTicketPrice($ticketPrice);

            $this->movieDAO->Add($cinema);
            $this->ShowAddCinema();
        }*/
    }
?>