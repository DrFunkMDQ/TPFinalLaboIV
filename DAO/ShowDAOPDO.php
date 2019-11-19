<?php namespace DAO;

use DAO\IShowDAOPDO as IShowDAOPDO;
use DAO\ShowRoomDAOPDO as ShowRoomDAO;
use DAO\MovieDAOPDO as MovieDAOPDO;
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

    public function Add(Show $show){
        array_push($this->showList, $show);       
        try{                
            $query = "INSERT INTO ".$this->tableName." (show_date, show_time, id_movie, id_show_room) VALUES (:show_date, :show_time, :id_movie, :id_show_room);";
            $parameters["show_date"] = $show->getDate();
            $parameters["show_time"] = $show->getTime();
            $parameters["id_movie"] = $show->getMovie()->getIdmovie();
            $parameters["id_show_room"] = $show->getShowRoom()->getId();                    
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);                
        }
        catch(Exception $ex){
            throw $ex;
        } 
    }

    public function showExists($show){
        try{
            $flag = 1;
            $query = "SELECT * FROM shows WHERE show_date = '".$show->getDate()."' AND show_time = '".$show->getTime()."' AND id_show_room = ".$show->getShowRoom()->getId();
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);    
            if(empty($resultSet))
                $flag = 0;
            return $flag;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetAllxMovie($movie){     
        try{
            $this->showList = array();  
            $query = "SELECT s.id_show, s.show_date, s.show_time, c.cinema_name, c.id_cinema, sr.show_room_name, sr.id_show_room FROM shows AS s JOIN showrooms AS sr ON sr.id_show_room = s.id_show_room JOIN cinemas AS c ON c.id_cinema = sr.id_cinema WHERE s.id_movie = ".$movie->getIdmovie()." AND s.active = 1 AND show_date > NOW() ORDER BY c.id_cinema;";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);                
            foreach ($resultSet as $row){                
                $show = new Show();
                $show->setId($row["id_show"]);
                $show->setDate($row["show_date"]); 
                $show->setTime($row["show_time"]);
                $show->setMovie($movie);                               
                $ShowRoom = new ShowRoom();
                $ShowRoom->setName($row["show_room_name"]);
                $ShowRoom->setId($row["id_show_room"]);
                $Cinema = new Cinema();
                $Cinema->setCinemaName($row["cinema_name"]);
                $Cinema->setId($row["id_cinema"]);  
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
        try{
            $this->showList = array();  
            $query = "SELECT * FROM shows AS s JOIN movies AS m ON s.id_movie = m.id_movie WHERE s.active = 1 AND s.id_show_room = ".$ShowRoom->getId().";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);                
            foreach ($resultSet as $row){                
                $show = new Show();
                $show->setDate($row["show_date"]); 
                $show->setTime($row["show_time"]);
                $show->setMovie($row["id_movie"]); 
                $show->setShowRoom($row["id_show_room"]);
                $show->setId($row["id_show"]);
                $show->setShowRoom($ShowRoom);                                
                $Movie = new Movie();                                          
                $Movie->setMovieName($row["movie_name"]);
                $Movie->setIdMovie($row["id_movie"]);
                $Movie->setOverview($row["movie_overview"]);
                $Movie->setLanguage($row["movie_language"]);
                $Movie->setImage($row["movie_image"]);
                $show->setMovie($Movie);        
                array_push($this->showList, $show);
            }  
            return $this->showList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    } 

    public function Remove(Show $show){                 
        try{
            $id = $show->getId();                        
            $query = "UPDATE Shows as s SET active = 0 WHERE s.id_show = '$id'";               
            $this->connection = Connection::GetInstance();
            $removedShow = $this->connection->ExecuteNonQuery($query);  
            return $removedShow;                                          
        }
        catch(Exception $ex){
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
    
    public function getById($idShow){ 
        
        try {
            $this->showList = array();
            $query = "SELECT * FROM ". $this->tableName. " where id_show = '$idShow'";            
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $show = new Show();
            foreach ($resultSet as $row){
                $show->setDate($row["show_date"]);                
                $show->setTime($row["show_time"]);
                $show->setMovie($row["id_movie"]);
                $show->setShowRoom($row["id_show_room"]);
                $show->setId($row["id_show"]);                
            } 
            return $show;
        } 
        catch (Exception $ex) {
            throw $ex;
        }
    } 
    
    public function update($show, Movie $movie, ShowRoom $showRoom){
        $showList = $this->GetAllxShowRoom($showRoom);
        try{
            $id = $show->getId();                       
            $query = "UPDATE Shows SET show_date = :show_date, show_time = :show_time, id_movie = :id_movie, id_show_room = :id_show_room WHERE id_show = '$id'"; 
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
            $query = "SELECT id_movie FROM shows where show_date > NOW() and active = 1 group by id_movie;"; 
            $this->connection = Connection::GetInstance();
            $aux = $this->connection->Execute($query); 
            $movieList = array();
            $movieDAO = new MovieDAOPDO;
            foreach ($aux as $movie) {
                $listedMovie = $movieDAO->searchMovieById($movie['id_movie']);
                array_push($movieList, $listedMovie);
            }                       
            return $movieList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function ListingMoviesByGenre($genre){
        try{
            $this->genreList = array();
            $query = "SELECT m.movie_name, m.id_movie, m.movie_overview, m.movie_language, m.movie_image 
            FROM movies_by_genres AS mbg 
            JOIN genres AS g 
            ON g.id_genre = mbg.id_genre 
            JOIN shows AS s 
            ON mbg.id_movie = s.id_movie 
            JOIN movies as m
            ON m.id_movie = s.id_movie
            WHERE s.show_date > NOW() and active = 1 AND g.genre_name ='$genre'
            GROUP BY m.id_movie";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);               
            foreach ($resultSet as $row){                
                $movie = new Movie();
                $movie->setMovieName($row["movie_name"]);
                $movie->setIdMovie($row["id_movie"]);
                $movie->setOverview($row["movie_overview"]);
                $movie->setLanguage($row["movie_language"]);
                $movie->setImage($row["movie_image"]);
                $genreQuery = "SELECT g.genre_name FROM movies_by_genres AS mbg INNER JOIN genres AS g ON g.id_genre = mbg.id_genre INNER JOIN movies AS m ON mbg.id_movie = m.id_movie where m.id_movie =".$movie->getIdMovie();
                $this->connection = Connection::GetInstance();       
                $resultSet = $this->connection->Execute($genreQuery);
                $genreArray = array();
                foreach($resultSet as $value){
                    $genres = $value['genre_name'];
                    array_push($genreArray, $genres);
                }
                $movie->setGenre($genreArray); 
                array_push($this->genreList, $movie);
            }  
            return $this->genreList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getListingsByDate($date){
        try{
            $this->genreList = array();
            $query = "SELECT m.movie_name, m.id_movie, m.movie_overview, m.movie_language, m.movie_image
            from shows AS s 
            JOIN movies as m
            ON m.id_movie = s.id_movie
            WHERE s.show_date > NOW() and active = 1 AND s.show_date ='$date'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);               
            foreach ($resultSet as $row){                
                $movie = new Movie();
                $movie->setMovieName($row["movie_name"]);
                $movie->setIdMovie($row["id_movie"]);
                $movie->setOverview($row["movie_overview"]);
                $movie->setLanguage($row["movie_language"]);
                $movie->setImage($row["movie_image"]);
                $genreQuery = "SELECT g.genre_name FROM movies_by_genres AS mbg INNER JOIN genres AS g ON g.id_genre = mbg.id_genre INNER JOIN movies AS m ON mbg.id_movie = m.id_movie where m.id_movie =".$movie->getIdMovie();
                $this->connection = Connection::GetInstance();       
                $resultSet = $this->connection->Execute($genreQuery);
                $genreArray = array();
                foreach($resultSet as $value){
                    $genres = $value['genre_name'];
                    array_push($genreArray, $genres);
                }
                $movie->setGenre($genreArray); 
                array_push($this->genreList, $movie);
            }  
            return $this->genreList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getRemianingTicketsList(){
        try{
            $remainingList = array();
            $query = "SELECT s.id_show, ifnull((sr.show_room_capacity - (count(t.id_ticket))), sr.show_room_capacity) as 'remaining_tickets'
            from shows AS s 
            LEFT JOIN tickets AS t
            ON s.id_show = t.id_show
            JOIN showrooms AS sr
            ON sr.id_show_room = s.id_show_room
            group by id_show";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach ($resultSet as $row) {
                $remainingList[$row['id_show']] = $row['remaining_tickets'];
            }         
            return $remainingList;
            }  
        catch(Exception $ex){
            throw $ex;
        }
    }

    
}
?>