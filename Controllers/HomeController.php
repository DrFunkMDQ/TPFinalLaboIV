<?php
    namespace Controllers;

    use DAO\MovieDAOPDO as MovieDAOPDO;

    class HomeController
    {
        private $movieDAO;
        private $firstMovie;

        public function __construct()
        {
            $this->movieDAO = new MovieDAOPDO();
        }
        public function Index($message = "")
        {
            $this->PrepareMovieList();
            require_once(VIEWS_PATH."index.php");
        }          
        
        private function PrepareMovieList(){
            $this->movieList = $this->movieDAO->GetAll();
            $this->firstMovie = array_shift($this->movieList);
        }

    }
?>