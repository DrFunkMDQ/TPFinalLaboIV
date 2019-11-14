<?php 
namespace Controllers;

use Models\Cinema as Cinema;
use Models\ShowRoom as ShowRoom;
use Models\Show as Show;
use Models\Movie as Movie;
use DAO\CinemaDAOPDO as CinemaDAOPDO;
use DAO\MovieDAOPDO as MovieDAOPDO;
use DAO\ShowRoomDAOPDO as ShowRoomDAOPDO;
use DAO\ShowDAOPDO as ShowDAOPDO;

class ShowController
{
    private $ShowDAOPDO;
    private $ShowRoomDAOPDO;
    private $MovieDAOPDO;
    private $CinemaDAOPDO;
    private $myShow;
    private $moviesList;
        

    public function __construct(){            
        $this->ShowDAOPDO = new ShowDAOPDO();//PDO
        $this->ShowRoomDAOPDO = new ShowRoomDAOPDO();
        $this->MovieDAOPDO = new MovieDAOPDO();
        $this->CinemaDAOPDO = new CinemaDAOPDO();
    }

    public function UserShowsListView(){
        $this->moviesList = $this->MovieDAOPDO->GetMoviesInDisplay();
        $this->moviesList = $this->MovieDAOPDO->GetAll();
        $myMovie = array_shift($this->moviesList);
        require_once(VIEWS_PATH."userShowList.php");
    }

    public function ShowListShowView($idShowroom){
        $this->myShowRoom = $this->ShowRoomDAOPDO->searchById($idShowroom);
        $this->ShowDAOPDO = $this->ShowDAOPDO->GetAllxShowRoom($this->myShowRoom);            
        require_once(VIEWS_PATH."showList.php");
    }
    
    public function ShowUpdateShowView($id, $idShowRoom){
        $ShowRoom = $this->ShowRoomDAOPDO->searchById($idShowRoom);
        $movieList = $this->MovieDAOPDO->GetAll();
        $show = $this->ShowDAOPDO->searchById($id, $ShowRoom);
        require_once(VIEWS_PATH."updateShow.php");
    }

    public function Add($date, $time, $idShowRoom, $idMovie){
        $movie = $this->MovieDAOPDO->searchMovieById($idMovie);
        $showRoom = $this->ShowRoomDAOPDO->searchById($idShowRoom);        
        $show = new Show();
        $movie = new Movie();
        $showRoom = new ShowRoom();
        $showRoom->setId($idShowRoom);
        $movie->setIdMovie($idMovie);
        $show->setDate($date);            
        $show->setTime($time); 
        $show->setShowRoom($showRoom);
        $show->setMovie($movie);
        if(!$this->ShowDAOPDO->showExists($show))    
            $this->ShowDAOPDO->Add($show);
        header('location:http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView'); 
    }

    
    public function Explode($values){
        $array = explode("/", $values);
        if(key($_POST) == "ShowRoomRemove"){
            $this->Remove($array[0], $array[1]);            
        }
        else{
            $this->ShowUpdateShowView($array[0], $array[1]);            
        }   
    }

    public function Remove($id, $idShowRoom){          
        $ShowRoom = $this->ShowRoomDAOPDO->searchById($idShowRoom);                 
        $Show = $this->ShowDAOPDO->searchById($id, $ShowRoom);              
        if($Show != null){
            $this->ShowDAOPDO->Remove($Show);               
        }            
        else{                
            echo'<script type="text/javascript">
            alert("Processing Error!");                
            </script>';                
        }
        header('location:http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView');
    }

    public function ShowUpdate($id, $date, $time, $idShowRoom, $idMovie){        
        $movie = $this->MovieDAOPDO->searchMovieById($idMovie);
        $showRoom = $this->ShowRoomDAOPDO->searchById($idShowRoom);
        $show = new Show();
        $show->setDate($date);            
        $show->setTime($time);
        $show->setId($id);                               
        $this->ShowDAOPDO->Update($show, $movie, $showRoom);        
        header('location:http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView');     
    }

    public function ShowAddShowView(){
        $movieList = $this->MovieDAOPDO->getAll();
        require_once(VIEWS_PATH."addShow.php");
    }

    public function ShowListingView(){
        $listing = $this->ShowDAOPDO->getListingMovies();
        $movieList = array();
        foreach ($listing as $movieID) {
            $movie = $this->MovieDAOPDO->searchMovieById($movieID);
            array_push($movieList, $movie);
        }
        require_once(VIEWS_PATH."userShowListings.php");
    }

    public function ShowMovieShowList($idMovie){
        $movie = $this->MovieDAOPDO->searchMovieById($idMovie);
        $showList = $this->ShowDAOPDO->GetAllxMovie($movie);
        $cinemaList= $this->CinemaDAOPDO->cinemaByMovieList($movie);
        $showRoomList= $this->ShowRoomDAOPDO->showRoomByMovieList($movie);
        require_once(VIEWS_PATH."userShowMovieShows.php");        
    }
}


?>