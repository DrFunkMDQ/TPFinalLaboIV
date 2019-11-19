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
use DAO\GenreDAOPDO as GenreDAO;
use \Datetime;

class ShowController
{
    private $ShowDAOPDO;
    private $ShowRoomDAOPDO;
    private $MovieDAOPDO;
    private $CinemaDAOPDO;
    private $GenreDAO;
    private $myShow;
    private $moviesList;
    private $genreList;
        

    public function __construct(){            
        $this->ShowDAOPDO = new ShowDAOPDO();//PDO
        $this->ShowRoomDAOPDO = new ShowRoomDAOPDO();
        $this->MovieDAOPDO = new MovieDAOPDO();
        $this->CinemaDAOPDO = new CinemaDAOPDO();
        $this->GenreDAO = new GenreDAO();
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
        $now = new DateTime();
        if($date >= $now->format('Y-m-d')){
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
            if(!$this->ShowDAOPDO->showExists($show)){    
                $this->ShowDAOPDO->Add($show);
                header('location:http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView'); 
            }
            else{
                echo'<script type="text/javascript">
                alert("Show already exists");
                location="http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView";                
                </script>';    
            }
        }
        else{
            echo'<script type="text/javascript">
            alert("Date in the past!");   
            location="http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView";                     
            </script>';    
        }
    }  

    //Divides with a slash the show ID and the showroom ID
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
        $movieList = $this->ShowDAOPDO->getListingMovies();
        $this->genreList = $this->GenreDAO->GetActiveListingGenres();
        require_once(VIEWS_PATH."userShowListings.php");
    }

    public function ShowMovieShowList($idMovie){
        $movie = $this->MovieDAOPDO->searchMovieById($idMovie);
        $showList = $this->ShowDAOPDO->GetAllxMovie($movie);
        $cinemaList= $this->CinemaDAOPDO->cinemaByMovieList($movie);
        $showRoomList= $this->ShowRoomDAOPDO->showRoomByMovieList($movie);
        $remainingList = $this->ShowDAOPDO->getRemianingTicketsList();
        require_once(VIEWS_PATH."userShowMovieShows.php");        
    }

    public function ShowListingByGenre($genre){
        $movieList = $this->ShowDAOPDO->ListingMoviesByGenre($genre);
        $this->genreList = $this->GenreDAO->GetActiveListingGenres();
        require_once(VIEWS_PATH."userShowListings.php");
    }

    public function ShowListingByDate($date){
        $movieList = $this->ShowDAOPDO->getListingsByDate($date);
        $this->genreList = $this->GenreDAO->GetActiveListingGenres();
        require_once(VIEWS_PATH."userShowListings.php");
    }

    public function AddToCart($idShow, $quantity){ 
        $_SESSION["Shopping-Cart-String"][$idShow] = $quantity;
        $show = $this->ShowDAOPDO->getById($idShow);//Esta funcion del ShowDAOPDO devuelve el objeto show, pero dentro solo tiene un ID MOVIE, no el objeto movie completo
        $this->ShowMovieShowList($show->getMovie());
    }
}

?>

