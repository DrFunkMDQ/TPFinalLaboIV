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

            foreach($this->MovieList as $Movie)
            {
                $valuesArray["MovieName"] = $Movie->getMovieName();
                $valuesArray["Duration"] = $Movie->getDuration();
                $valuesArray["Language"] = $Movie->getLanguage();
                $valuesArray["Image"] = $Movie->getImage();
                $valuesArray["Gender"] = $Movie->getGender();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/Movies.json', $jsonContent);
        }

        public function Remove(){
            return 1;
        }

        /*public function RetrieveData(){
            $this->MovieList = array();

            if(file_exists('Data/Movies.json'))
            {
                $jsonContent = file_get_contents('Data/Movies.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $Movie = new Movie();
                    $Movie->setMovieName($valuesArray["MovieName"]);
                    $Movie->setDuration($valuesArray["Duration"]);
                    $Movie->setLanguage($valuesArray["Language"]);
                    $Movie->setImage($valuesArray["Image"]);
                    $Movie->setGender($valuesArray["Gender"]);

                    array_push($this->MovieList, $Movie);
                }
            }
        }*/

        public function RetrieveData(){
            $this->MovieList = array();
            $arrayToDecode = $this->getDataFromAPI();
            $results = $arrayToDecode['results'];
            foreach($results as $jsonMovie){
                    $Movie = new Movie();
                    $Movie->setMovieName($jsonMovie["original_title"]);
                    $Movie->setDuration($jsonMovie["overview"]);
                    $Movie->setLanguage($jsonMovie["original_language"]);
                    $Movie->setImage($jsonMovie["poster_path"]);
                    $Movie->setGender($jsonMovie["genre_ids"]);
                    array_push($this->MovieList, $Movie);             
            }
        }
        
        public function getDataFromAPI(){
            $json = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=".API_KEY);
            $result = json_decode($json, true);
            return $result;   
        }
    }
?>