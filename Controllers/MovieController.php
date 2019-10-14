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
            $this->AssignGenreToMovies();
            $this->PrepareMovieList();
            $this->ShowNowPlayingView();
        }

        private function PrepareMovieList(){
            $this->firstMovie = array_shift($this->movieList);
            $this->genreList = $this->genreDAO->GetAll();
        }

        public function GetMoviesFromApi(){
            $this->movieDAO->SaveMoviesFromAPI();
            $this->ListNowPlayingMovies();
        }

        public function GetGenresFromApi(){
            $this->genreDAO->SaveGenresFromAPI();
            $this->ListNowPlayingMovies();
        }

        private function AssignGenreToMovies(){
            $this->movieList = $this->movieDAO->getAll();
            foreach($this->movieList as $movie){
                $genreIdList = $movie->GetGenre();
                $genreNameList = array();
                foreach($genreIdList as $genre){
                    $genre = $this->ReturnGenre($genre);
                    array_push($genreNameList, $genre);
                }
                $movie->SetGenre($genreNameList);   
            }
        }

        private function ReturnGenre($id){
            $genre = null;
            $genreList = $this->GenreListToArray($this->genreDAO->GetAll());
            if(array_key_exists($id, $genreList)){
                $genre = $genreList[$id];
            }
            return $genre;
        }

        private function GenreListToArray($genreList){
            $genreArray = array();
            foreach($genreList as $genre){
                $genreArray[$genre->getId()] = $genre->getName();
            }
            return $genreArray;
        }

        public function ListMoviesByGenre(string $genre){
            $this->AssignGenreToMovies();
            $genreList = array();
            foreach($this->movieList as $movie){
                //var_dump($movie);
                $valid = false;
                foreach($movie->getGenre() as $movieGenre){
                    //var_dump($movieGenre);
                    if($movieGenre == $genre)
                        $valid = true;
                    //var_dump($valid);
                }
                if($valid)
                    array_push($genreList, $movie);
            }                        
            $this->movieList = $genreList;
            $this->PrepareMovieList();
            $this->ShowNowPlayingView();
        }

    }

        

?>