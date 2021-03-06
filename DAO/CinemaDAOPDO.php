<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use \Exception as Exception;
    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;
    use Models\ShowRoom as ShowRoom;
    

    class CinemaDAOPDO implements ICinemaDAO
    {
        private $cinemaList = array();
        private $connection;
        private $tableName = "cinemas";


        public function Add(Cinema $cinema){
            array_push($this->cinemaList, $cinema);
             try{
                $query = "INSERT INTO ".$this->tableName." (cinema_name, cinema_address) VALUES (:cinema_name, :cinema_address);";
                $parameters["cinema_name"] = $cinema->getCinemaName();
                $parameters["cinema_address"] = $cinema->getAddress();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function cinemaExists($cinema){
            try{
                $flag = 1;
                $query = "SELECT * FROM CINEMAS WHERE cinema_name = '" .$cinema->getCinemaName()."'";
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

        public function GetAll(){
            try{
                $this->cinemaList = array();
                $query = "SELECT c.id_cinema, c.cinema_name, c.cinema_address, ifnull(sum(sr.show_room_capacity), 0) as 'cinema_capacity'
                FROM cinemas as c
                left join showrooms as sr
                on c.id_cinema = sr.id_cinema
                where c.active = 1
                group by c.id_cinema";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row){                
                    $cinema = new Cinema();
                    $cinema->setCinemaName($row["cinema_name"]);
                    $cinema->setAddress($row["cinema_address"]);
                    $cinema->setCapacity($row["cinema_capacity"]);                                
                    $cinema->setId($row["id_cinema"]);
                    array_push($this->cinemaList, $cinema);
                }  
                return $this->cinemaList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }        

        public function Remove($cinema){ 
            try
                {
                    $name = $cinema->getCinemaName();
                    $query = "UPDATE cinemas SET active = 0 WHERE cinema_name = '$name'";               
                    $this->connection = Connection::GetInstance();
                    $a = $this->connection->ExecuteNonQuery($query);  
                    return $a;                                          
                }
            catch(Exception $ex)
                {
                    throw $ex;
                }
        }

        public function searchById($cinemaId){ /// Se puede hacer que reotorne un boolean y no el cine
            $cinemaList = $this->GetAll();
            $myCinema = null;
            foreach ($cinemaList as $cinema) {
                if($cinema->getId() == $cinemaId){
                    $myCinema = $cinema;
                }
            }
            return $myCinema;
        }    

        public function searchByName($cinemaName){ /// Se puede hacer que reotorne un boolean y no el cine
            $cinemaList = $this->GetAll();
            $myCinema = null;
            foreach ($cinemaList as $cinema) {
                if($cinema->getCinemaName() == $cinemaName){
                    $myCinema = $cinema;
                }
            }
            return $myCinema;
        } 
        
        public function update($cinema){
            try{     
                $query = "UPDATE cinemas SET cinema_name = :cinema_name, cinema_address = :cinema_address WHERE id_cinema = ".$cinema->getId();
                $parameters["cinema_name"] = $cinema->getCinemaName();
                $parameters["cinema_address"] = $cinema->getAddress();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                    throw $ex;
            }
        }
       
        public function cinemaByMovieList($movie){
            try{
                $this->cinemaList = array();
                $query = "SELECT c.id_cinema, c.cinema_name 
                FROM shows AS s 
                JOIN showrooms AS sr 
                ON s.id_show_room = sr.id_show_room
                JOIN cinemas AS c
                ON c.id_cinema = sr.id_cinema
                WHERE s.active = 1
                AND show_date > NOW()
                AND s.id_movie = ".$movie->getIdmovie()." GROUP BY c.id_cinema ORDER BY c.id_cinema";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row){                
                    $cinema = new Cinema();          
                    $cinema->setId($row["id_cinema"]);
                    $cinema->setCinemaName($row["cinema_name"]);
                    array_push($this->cinemaList, $cinema);
                }  
                return $this->cinemaList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }
?>