<?php
    namespace DAO;

    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;

    class GenreDAO implements IGenreDAO
    {
        private $GenreList = array();

        public function Add(Genre $Genre){
            $this->RetrieveData();
            array_push($this->GenreList, $Genre);
            $this->SaveData();
        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->GenreList;
        }

        public function SaveData(){
            $arrayToEncode = array();
            foreach($this->GenreList as $Genre){
                $valuesArray["id"] = $Genre['id'];
                $valuesArray["name"] = $Genre['name'];
                array_push($arrayToEncode, $valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents('Data/Genres.json', $jsonContent);
        }

        public function Remove(){
            return 1;
        }

        public function RetrieveData(){
            $this->GenreList = array();
            if(file_exists('Data/Genres.json')){
                $jsonContent = file_get_contents('Data/Genres.json');
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                foreach($arrayToDecode as $jsonGenre){
                        $Genre = new Genre();
                        $Genre->setId($jsonGenre["id"]);
                        $Genre->setName($jsonGenre["name"]);
                        array_push($this->GenreList, $Genre);             
                }
            }
        }
        
        private function GetGenres(){
            $json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=3a826f6a0e7fb42cdf899bbba2e08621&language=en-US");
            $result = json_decode($json, true);
            $GenreList = $result['genres'];
            return $GenreList;   
        }

        public function SaveGenresFromAPI(){
            $this->GenreList = $this->GetGenres();
            $this->SaveData();
        }

        
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
            $genreList = array();
            foreach($movieList as $movie){
                $valid = false;
                foreach($movie->getGenre() as $movieGenre){
                    if($movieGenre == $genre)
                        $valid = true;
                }
                if($valid)
                    array_push($genreList, $movie);
            }                        
            $movieList = $genreList;
            return $movieList;
        }






    }
?>