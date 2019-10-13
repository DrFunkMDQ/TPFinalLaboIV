<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieDAO;
        private $genreDAO;
        private $genreList;
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
            foreach($this->movieList as $movie){
                $movie = $this->assignGenreToMovie($movie);
            }
            $this->firstMovie = array_shift($this->movieList);
            $this->genreList = $this->genreDAO->GetAll();
            $this->ShowNowPlayingView();
        }

        public function getMoviesFromApi(){
            $this->movieDAO->saveMoviesFromAPI();
            $this->ListNowPlayingMovies();
        }

        public function getGenresFromApi(){
            $this->genreDAO->saveGenresFromAPI();
            $this->ListNowPlayingMovies();
        }

        private function assignGenreToMovie($movie){
            $genreIdList = $movie->getGenre();
            $genreNameList = array();
            foreach($genreIdList as $genre){
                $genre = $this->returnGenre($genre);
                array_push($genreNameList, $genre);
            }
            $movie->setGenre($genreNameList);   
        }

        private function returnGenre($id){
            $genre = null;
            $genreList = $this->genreListToArray($this->genreDAO->GetAll());
            if(array_key_exists($id, $genreList)){
                $genre = $genreList[$id];
            }
            return $genre;
        }

        private function genreListToArray($genreList){
            $genreArray = array();
            foreach($genreList as $genre){
                $genreArray[$genre->getId()] = $genre->getName();
            }
            return $genreArray;
        }
    }

        

?>