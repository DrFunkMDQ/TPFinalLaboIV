<?php
    namespace DAO;

    use DAO\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;

    class MovieDAO implements IMovieDAO
    {
        private $MovieList = array();

        public function Add(Movie $Movie){
            $this->RetrieveData();
            array_push($this->MovieList, $Movie);
            $this->SaveData();
        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->MovieList;
        }

        public function SaveData(){
            $arrayToEncode = array();
            foreach($this->MovieList as $Movie){
                $valuesArray["MovieName"] = $Movie['title'];
                $valuesArray["Overview"] = $Movie['overview'];
                $valuesArray["Language"] = $Movie['original_language'];
                $valuesArray["Image"] = $Movie['poster_path'];
                $valuesArray["Gender"] = $Movie['genre_ids'];
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/Movies.json', $jsonContent);
        }

        public function Remove(){
            return 1;
        }

        public function RetrieveData(){
            $this->MovieList = array();
            if(file_exists('Data/Movies.json')){
                $jsonContent = file_get_contents('Data/Movies.json');
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                foreach($arrayToDecode as $jsonMovie){
                        $Movie = new Movie();
                        $Movie->setMovieName($jsonMovie["MovieName"]);
                        $Movie->setDuration($jsonMovie["Overview"]);
                        $Movie->setLanguage($jsonMovie["Language"]);
                        $Movie->setImage($jsonMovie["Image"]);
                        $Movie->setGender($jsonMovie["Gender"]);
                        array_push($this->MovieList, $Movie);             
                }
            }
        }
        
        private function getDataFromAPI(){
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

        public function saveDataFromAPI(){
            $this->MovieList = $this->getDataFromAPI();
            $this->SaveData();
        }
    }
?>