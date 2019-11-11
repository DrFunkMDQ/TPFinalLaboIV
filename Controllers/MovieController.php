<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use DAO\MovieDAOPDO as MovieDAOPDO;
    use DAO\GenreDAO as GenreDAO;
    use DAO\GenreDAOPDO as GenreDAOPDO;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieDAO;
        private $genreDAO;
        private $genreList;
        private $firstMovie;
        private $movieList;

        public function __construct(){
            //$this->movieDAO = new MovieDAO(); //DESCOMENTAR PARA JSON
            $this->movieDAO = new MovieDAOPDO();//DESCOMENTAR ESTA PARA SQL
            //$this->genreDAO = new GenreDAO(); //DESCOMENTAR PARA JSON
            $this->genreDAO = new GenreDAOPDO();//DESCOMENTAR ESTA PARA SQL
        }

        public function ShowNowPlayingView(){
            require_once(VIEWS_PATH."nowPlayingList.php");
        }        

        public function ListNowPlayingMovies(){
            $this->movieList = $this->movieDAO->GetAll();
            $this->PrepareMovieList();
            $this->ShowNowPlayingView();
        }

        private function PrepareMovieList(){
                $this->firstMovie = array_shift($this->movieList);
                $this->genreList = $this->genreDAO->GetActiveGenres();
        }

        public function GetMoviesFromApi(){
            $this->movieDAO->SaveMoviesFromAPI();
            $this->ListNowPlayingMovies();
        }

        public function GetGenresFromApi(){
            $this->genreDAO->SaveGenresFromAPI();
            $this->ListNowPlayingMovies();
        }

        public function ListMoviesByGenre(string $genre){
            $this->movieList = $this->movieDAO->GetAll();
            $this->movieList = $this->genreDAO->MoviesByGenre($genre, $this->movieList);
            $this->PrepareMovieList();
            $this->ShowNowPlayingView();
        }

        public function SetActive($movie_name){
            $movie = $this->movieDAO->SearchByName($movie_name);
            $this->movieDAO->SetActive($movie);
            $this->ListNowPlayingMovies();
        }

    }

        

?>