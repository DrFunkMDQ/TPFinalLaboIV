<?php namespace DAO;

use DAO\IShowDAOPDO as IShowDAO;
use DAO\ShowRoomDAOPDO as ShowRoomDAO;
use Models\Show as Show;
use Models\Cinema as Cinema;
use Models\ShowRoom as ShowRoom;
use Models\Movie as Movie;

class ShowDAOPDO implements IShowDAOPDO{

    private $showList = array();
    private$cinemasList = array();
    private $connection;
    private $tableName = "Shows";
    private $tableMovie = 'movies';
    private $tableShowRooms = "ShowRooms";

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

                $query = "SELECT * FROM ".$this->tableName . " as s WHERE s.id_movie = '$id' AND s.active = 1;";

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
                    $show->setMovie($movie);   
                    
                    $showRoomQuery = "SELECT * FROM ShowRooms AS sr INNER JOIN Shows AS s ON s.id_show_room = sr.id_show_room;";
                    $this->connection = Connection::GetInstance();       
                    $resultSet = $this->connection->Execute($showRoomQuery);
                    foreach($resultSet as $myShowRoom){                
                        if($myShowRoom["id_show_room"] == $row["id_show_room"]){
                            $ShowRoom = new ShowRoom();
                            $ShowRoom->setName($myShowRoom["show_room_name"]);
                            $ShowRoom->setCapacity($myShowRoom["show_room_capacity"]);                                  
                            $ShowRoom->setId($myShowRoom["id_show_room"]); 
                        }                
                    }                    
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
                try
                    {
                        $id = $show->getId();                       
                        $query = "UPDATE Shows SET show_date = :show_date, show_time = :show_time, id_movie = :id_movie, id_show_room = :id_show_room WHERE id_show = '$id'"; 
                        
                        $parameters["show_date"] = $show->getDate();
                        $parameters["show_time"] = $show->getTime();
                        $parameters["id_movie"] = $movie->getIdmovie();
                        $parameters["id_show_room"] = $showRoom->getId();                               
                        
                        $this->connection = Connection::GetInstance();
                        $aux = $this->connection->ExecuteNonQuery($query, $parameters);
                        ;
                        return $aux;
                        
                    }
                catch(Exception $ex)
                    {
                        throw $ex;
                    }
        }
}
?>