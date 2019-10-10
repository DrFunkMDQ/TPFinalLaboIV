<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieDAO;
        private $firstMovie;
        private $movieList;

        public function __construct(){
            $this->movieDAO = new MovieDAO();
        }

        public function ShowNowPlayingView(){
            require_once(VIEWS_PATH."nowPlayingList.php");
        }        

        public function ListNowPlayingMovies(){
            $this->movieList = $this->movieDAO->getAll();
            $this->firstMovie = array_shift($this->movieList);
            $this->ShowNowPlayingView();
        }

        public function getMoviesFromApi(){
            $this->movieDAO->saveDataFromAPI();
            $this->ListNowPlayingMovies();
        }

    }
?>