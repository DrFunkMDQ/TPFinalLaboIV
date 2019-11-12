<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use \Exception as Exception;
    use DAO\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;
        

    class MovieDAOPDO implements IMovieDAO
    {
        private $movieList = array();
        private $tableName = 'movies';
        private $movieByGenre = 'movies_by_genres';

        public function Add(Movie $movie){
            try{
                $movieId = $movie->getIdmovie();
                $query = "INSERT INTO ".$this->tableName." (id_movie, movie_name, movie_overview, movie_language, movie_image) VALUES (:id_movie, :movie_name, :movie_overview, :movie_language, :movie_image);";
                $parameters["id_movie"] = $movieId;
                $parameters["movie_name"] = $movie->getMovieName();     
                $parameters["movie_overview"] = $movie->getOverview();     
                $parameters["movie_language"] = $movie->getLanguage();     
                $parameters["movie_image"] = $movie->getImage();     
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                foreach ($movie->getGenre() as $genre) {
                    $query = "INSERT INTO ".$this->movieByGenre." (id_movie, id_genre) VALUES (:id_movie, :id_genre)";
                    $genreParameters["id_movie"] = $movieId;
                    $genreParameters["id_genre"] = $genre;
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $genreParameters);
                }
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
                $this->movieList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);               
                foreach ($resultSet as $row){                
                    $Movie = new Movie();
                    $Movie->setMovieName($row["movie_name"]);
                    $Movie->setIdMovie($row["id_movie"]);
                    $Movie->setOverview($row["movie_overview"]);
                    $Movie->setLanguage($row["movie_language"]);
                    $Movie->setImage($row["movie_image"]);
                    $genreQuery = "SELECT g.genre_name FROM movies_by_genres AS mbg INNER JOIN genres AS g ON g.id_genre = mbg.id_genre INNER JOIN movies AS m ON mbg.id_movie = m.id_movie where m.id_movie =".$Movie->getIdMovie();
                    $this->connection = Connection::GetInstance();       
                    $resultSet = $this->connection->Execute($genreQuery);
                    $genreArray = array();
                    foreach($resultSet as $value){
                        $genres = $value['genre_name'];
                        array_push($genreArray, $genres);
                    }
                    $Movie->setGenre($genreArray); 
                    array_push($this->movieList, $Movie);
                }  
                return $this->movieList;
            }
            catch(Exception $ex){
                throw $ex;
            }          
        }        

            
        private function GetMovies(){
            $json = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=".API_KEY."&region=AR");
            $result = json_decode($json, true);
            $movieList = $result['results'];
            if($result['total_pages']>1){
                for($i=2; $i<=$result['total_pages']; $i++){
                    $json = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=".API_KEY."&region=AR&page=".$i);
                    $resutlNextPage = json_decode($json, true);
                    $movieList = array_merge($movieList, $resutlNextPage['results']);
                }
            }
            return $movieList;   
        }

        public function arrayToMovie(array $movieArray){
            $movie = new Movie();
            $movie->setIdMovie($movieArray['id']);
            $movie->setMovieName($movieArray["title"]);
            $movie->setOverview($movieArray["overview"]);
            $movie->setLanguage($movieArray["original_language"]);
            $movie->setImage($movieArray["poster_path"]);
            $movie->setGenre($movieArray["genre_ids"]);            
            return $movie;                
        }

        public function SaveMoviesFromAPI(){
            $this->movieList = $this->GetMovies();
            foreach($this->movieList as $movieArray){
                $movie = new Movie();
                $movie = $this->arrayToMovie($movieArray);
                if(empty($this->validateMovieExists($movie)))
                    $this->Add($movie);
            }
        }

        public function validateMovieExists($movie){
            $flag = 1;
            $query = "SELECT * FROM movies WHERE id_movie = ".$movie->getIdmovie();
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);    
            if(empty($resultSet))
                $flag = 0;
            return $flag;
        }
        
        public function searchMovieById($id){
            $movieList = $this->GetAll();
            $movie = null;
            if($this->movieList != null){
                foreach($this->movieList as $movieArray){                
                    if($movieArray->getIdmovie() == $id){
                        $movie = $movieArray;
                    }                
                }
            }  //agregar validacion en caso de que la lista este vacia (se podria ejecutar funciones de traer pelis)          
            return $movie;
        }

        public function SetActive(Movie $movie){
            $movieList = $this->GetAll();
            try {
                         
                $query = "UPDATE movies SET movie_active = 1 WHERE id_movie = ".$movie->getIdmovie().";";                      

                $this->connection = Connection::GetInstance();

                $aux = $this->connection->ExecuteNonQuery($query);
                return $aux;
                
            }
            catch (Exception $ex) {
                throw $ex;
            }
        }

        public function SearchMovieByName($movie_name){
            $movieList = $this->GetAll();
            $myMovie = null;
            foreach ($movieList as $movie) {
                if($movie->getMovieName() == $movie_name){
                    $myMovie = $movie;
                }
            }
            return $myMovie;
        }

    }

?>
