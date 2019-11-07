<?php namespace DAO;

use DAO\IShowDAOPDO as IShowDAO;
use DAO\ShowRoomDAOPDO as ShowRoomDAO;
use Models\Show as Show;
use Models\Cinema as Cinema;
use Models\ShowRoom as ShowRoom;
use Models\Movie as Movie;

class ShowDAOPDO implements IShowDAOPDO{

    private $showList = array();
    private $cinemasList = array();
    private $connection;
    private $tableName = "Shows";
    private $tableMovie = 'movies';
    private $tableShowRooms = "ShowRooms";

    public function GetAll(){
        try {
            $this->showList = array();
            $query = "SELECT * FROM ". $this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach ($resultSet as $row){
                $show = new Show();
                $show->setDate($row["show_date"]);
                $show->setDate($row["show_time"]);
                $show->setDate($row["id_movie"]);
                $show->setDate($row["id_show_room"]);
                $show->setDate($row["id_show"]);
                array_push($this->showList, $show);
            }

            return $this->showList;
        } 
        catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Add(Show $show, Movie $movie, ShowRoom $showRoom){
        
        array_push($this->showList, $show);
                    
            try
        {                
            $query = "INSERT INTO ".$this->tableName." (show_date, show_time, id_movie, id_show_room) VALUES (:show_date, :show_time, :id_movie, :id_show_room);";
            $parameters["show_date"] = $show->getDate();
            $parameters["show_time"] = $show->getTime();
            $parameters["id_movie"] = $movie->getIdmovie();
            $parameters["id_show_room"] = $showRoom->getId();                    
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);                
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
        
    }

    public function GetAllxMovie($movie){     
        try
        {
            $this->showList = array();  
            $id = $movie->getIdmovie();   
            $query = "SELECT s.show_date, s.show_time, c.cinema_name, c.id_cinema, sr.show_room_name, sr.id_show_room FROM shows AS s JOIN showrooms AS sr ON sr.id_show_room = s.id_show_room JOIN cinemas AS c ON c.id_cinema = sr.id_cinema WHERE s.id_movie = ".$movie->getIdmovie()." AND show_date > NOW();";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);                
            foreach ($resultSet as $row)
            {                
                $show = new Show();
                $show->setDate($row["show_date"]); 
                $show->setTime($row["show_time"]);
                $show->setMovie($movie);                               
                $ShowRoom = new ShowRoom();
                $ShowRoom->setName($row["show_room_name"]);
                $ShowRoom->setId($row["id_show_room"]);
                $Cinema = new Cinema();
                $Cinema->setCinemaName($row["cinema_name"]);
                $Cinema->setCinemaName($row["id_cinema"]);  
                $ShowRoom->setCinema($Cinema); 
                $show->setShowRoom($ShowRoom);                    
                array_push($this->showList, $show);
            }  
            return $this->showList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
                    
    }     

    function GetAllxShowRoom(ShowRoom $ShowRoom) {
        try
        {
            $this->showList = array();  
            $id = $ShowRoom->getId(); 
            $query = "SELECT * FROM ".$this->tableName . " as s WHERE s.id_show_room = '$id' AND s.active = 1";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);                
            foreach ($resultSet as $row)
            {                
                $show = new Show();
                $show->setDate($row["show_date"]); 
                $show->setTime($row["show_time"]);
                $show->setMovie($row["id_movie"]); 
                $show->setShowRoom($row["id_show_room"]);
                $show->setId($row["id_show"]);
                $show->setShowRoom($ShowRoom);                    
                $movieQuery = "SELECT * FROM movies AS m INNER JOIN Shows AS s ON s.id_movie = m.id_movie";
                $this->connection = Connection::GetInstance();       
                $resultSet = $this->connection->Execute($movieQuery);
                foreach($resultSet as $myMovie){                
                    if($myMovie["id_movie"] == $row["id_movie"]){
                        $Movie = new Movie();                                          
                        $Movie->setMovieName($myMovie["movie_name"]);
                        $Movie->setIdMovie($myMovie["id_movie"]);
                        $Movie->setOverview($myMovie["movie_overview"]);
                        $Movie->setLanguage($myMovie["movie_language"]);
                        $Movie->setImage($myMovie["movie_image"]);
                    }                
                } 
                $show->setMovie($Movie);        
                array_push($this->showList, $show);
            }  
            return $this->showList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    } 

    public function Remove(Show $show){                 
            try
                {
                    $id = $show->getId();                        
                    $query = "UPDATE Shows as s SET active = 0 WHERE s.id_show = '$id'";               
                    $this->connection = Connection::GetInstance();
                    $a = $this->connection->ExecuteNonQuery($query);  
                    return $a;                                          
                }
            catch(Exception $ex)
                {
                    throw $ex;
                }            
    }

    
    public function searchById($idShow, $showRoom){ 
        $showList = $this->GetAllxShowRoom($showRoom);            
        $myShow = null;
        foreach ($showList as $show) {
            if($show->getId() == $idShow){
                $myShow = $show;
            }
        }
        return $myShow;
    }    
    
    public function update($show, Movie $movie, ShowRoom $showRoom){
        $showList = $this->GetAllxShowRoom($showRoom);
        try{
            $id = $show->getId();                       
            $query = "UPDATE Shows SET show_date = :show_date, show_time = :show_time, id_movie = :id_movie, id_show_room = :id_show_room WHERE id_show = '$id' AND s.active = 1 and s.show_date > NOW() ORDER BY sr.id_cinema;"; 
            $parameters["show_date"] = $show->getDate();
            $parameters["show_time"] = $show->getTime();
            $parameters["id_movie"] = $movie->getIdmovie();
            $parameters["id_show_room"] = $showRoom->getId();
            $this->connection = Connection::GetInstance();
            $aux = $this->connection->ExecuteNonQuery($query, $parameters);                        
            return $aux;                        
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getListingMovies(){
        try{                 
            $query = "SELECT id_movie FROM shows group by id_movie;"; 
            $this->connection = Connection::GetInstance();
            $aux = $this->connection->Execute($query); 
            $movieIdList = array();
            foreach ($aux as $movie) {
                array_push($movieIdList, $movie['id_movie']);
            }                       
            return $movieIdList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getMovieShows($movie){
        try{                 
            $query = "SELECT id_movie FROM shows group by id_movie;"; 
            $this->connection = Connection::GetInstance();
            $aux = $this->connection->Execute($query); 
            $movieIdList = array();
            foreach ($aux as $movie) {
                array_push($movieIdList, $movie['id_movie']);
            }                       
            return $movieIdList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

}
?>