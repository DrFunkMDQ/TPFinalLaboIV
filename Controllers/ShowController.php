<?php 
namespace Controllers;

use Models\Cinema as Cinema;
use Models\ShowRoom as ShowRoom;
use Models\Show as Show;
use DAO\CinemaDAOPDO as CinemaDAOPDO;
use DAO\MovieDAOPDO as MovieDAOPDO;
use DAO\ShowRoomDAOPDO as ShowRoomDAOPDO;
use DAO\ShowDAOPDO as ShowDAOPDO;

class ShowController
{
    private $ShowDAOPDO;
    private $ShowRoomDAOPDO;
    private $MovieDAOPDO;
    private $myShow;
        

    public function __construct(){            
        $this->ShowDAOPDO = new ShowDAOPDO();//PDO
        $this->ShowRoomDAOPDO = new ShowRoomDAOPDO();
        $this->MovieDAOPDO = new MovieDAOPDO();
    }

    public function ShowListShowView($idShowroom){
        $this->myShow = $this->ShowRoomDAOPDO->searchById($idShowroom);
        $this->ShowDAOPDO = $this->ShowDAOPDO->GetAllxShowRoom($this->myShow);            
        require_once(VIEWS_PATH."showList.php");
    }
    
    public function ShowUpdateShowView($myShow){
        $this->myShow = $myShow;
        require_once(VIEWS_PATH."updateShowRoom.php");
    }

    public function Add($date, $time, $idShowRoom, $idMovie){
        $movie = $this->MovieDAOPDO->searchMovieById($idMovie);
        $showRoom = $this->ShowRoomDAOPDO->searchById($idShowRoom);        
        $show = new Show();
        $show->setDate($date);            
        $show->setTime($time);                               
        $this->ShowDAOPDO->Add($show, $movie, $showRoom);
        header('location:http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView');
    }
    
    public function Remove($id, $showRoom){            
        $Show = $this->ShowDAOPDO->searchById($id, $showRoom);        
        if($Show != null){
            $this->ShowDAOPDO->Remove($Show);               
        }            
        else{                
            echo'<script type="text/javascript">
            alert("Processing Error!");                
            </script>';                
        }
        //$this->ShowListShowView();
    }

    public function Update($id, $showRoom){
        $myShow = $this->ShowDAOPDO->searchById($id, $showRoom);
            if($myShow != null){                
                //$this->ShowUpdateShowView($myShow);
                $this->ShowDAOPDO->Update($id, $myShow);                 
            }
            else{                
                echo'<script type="text/javascript">
                alert("Processing Error!");                
                </script>';   
                $this->ShowListShowView();             
            }
                    
    }

    public function AddShowUpdate($id, $date, $time, $idShowRoom, $idMovie){
        $movie = $this->MovieDAOPDO->searchMovieById($idMovie);
        $showRoom = $this->ShowRoomDAOPDO->searchById($idShowRoom);
        $show = new Show();
        $show->setDate($date);            
        $show->setTime($time);
        $show->setId($id);                               
        $this->ShowDAOPDO->Update($show, $movie, $showRoom);        
        //$this->ShowListShowView();            
    }

    public function ShowAddShowView(){
        $movieList = $this->MovieDAOPDO->getAll();
        require_once(VIEWS_PATH."addShow.php");
    }


}


?>