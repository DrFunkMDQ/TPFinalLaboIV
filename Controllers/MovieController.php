<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieDAO;

        /*public function __construct(){
            $this->movieDAO = new CinemaDAO();
        }*/

        public function ShowNowPlaying(){
            require_once(VIEWS_PATH."nowPlayingList.php");
        }        

        public function ListNowPlayingMovies(){

            $json = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=".API_KEY);
            $result = json_decode($json, true);
            var_dump($result);

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