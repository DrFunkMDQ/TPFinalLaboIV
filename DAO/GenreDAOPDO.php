<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use \Exception as Exception;
    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;
    use Models\Movie as Movie;
        

    class GenreDAOPDO implements IGenreDAO
    {
        private $genreList = array();
        private $tableName = 'genres';

        public function Add(Genre $genre){
            array_push($this->genreList, $genre);
            try{
                $query = "INSERT INTO ".$this->tableName." (id_genre, genre_name) VALUES (:id_genre, :genre_name);";
                $parameters["id_genre"] = $genre->getId();
                $parameters["genre_name"] = $genre->getName();           
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove(){
            return 1;
        }

        public function GetAll(){
            try{
                $this->genreList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);               
                foreach ($resultSet as $row){                
                    $Genre = new Genre();
                    $Genre->setName($row["genre_name"]);
                    $Genre->setId($row["id_genre"]);
                    array_push($this->genreList, $Genre);
                }  
                return $this->genreList;
            }
            catch(Exception $ex){
                throw $ex;
            }          
        }        

        public function GetActiveGenres(){
            try{
                $this->genreList = array();
                $query = "SELECT g.id_genre, g.genre_name FROM genres AS g JOIN movies_by_genres AS mbg ON g.id_genre = mbg.id_genre group by g.id_genre order by g.genre_name asc;";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);               
                foreach ($resultSet as $row){                
                    $Genre = new Genre();
                    $Genre->setName($row["genre_name"]);
                    $Genre->setId($row["id_genre"]);
                    array_push($this->genreList, $Genre);
                }  
                return $this->genreList;
            }
            catch(Exception $ex){
                throw $ex;
            }          
        }        

        private function GetGenresFromApi(){
            $json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=".API_KEY."&language=en-US");
            $result = json_decode($json, true);
            $genreList = $result['genres'];
            return $genreList;   
        }

        public function SaveGenresFromAPI(){
            $this->genreList = $this->GetGenresFromApi();
            foreach($this->genreList as $genreArray){
                $genre = new Genre();
                $genre->setId($genreArray['id'])->setName($genreArray['name']);
                $this->Add($genre);
            }
        }




        /////MODIFICAR ESTO

        public function GenreToMovies(Array $movieList){
            foreach($movieList as $movie){
                $genreIdList = $movie->GetGenre();
                $genreNameList = array();
                foreach($genreIdList as $genre){
                    $genre = $this->ReturnGenre($genre);
                    array_push($genreNameList, $genre);
                }
                $movie->SetGenre($genreNameList);   
            }
            return $movieList;
        }

        private function ReturnGenre($id){
            $genre = null;
            $genreList = $this->GenreListToArray($this->GetAll());
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

        public function MoviesByGenre(string $genre, Array $movieList){
            try{
                $this->genreList = array();
                $query = "SELECT m.* FROM movies_by_genres AS mbg INNER JOIN genres AS g ON g.id_genre = mbg.id_genre INNER JOIN movies AS m ON mbg.id_movie = m.id_movie WHERE g.genre_name ='$genre'";
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






    }
?>