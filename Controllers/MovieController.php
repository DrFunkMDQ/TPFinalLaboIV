<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieDAO;
        private $genreDAO;
        private $firstMovie;
        private $movieList;

        public function __construct(){
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
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
            $this->movieDAO->saveMoviesFromAPI();
            $this->ListNowPlayingMovies();
        }

        public function getGenresFromApi(){
            $this->genreDAO->saveGenresFromAPI();
        }

        

    }
?>