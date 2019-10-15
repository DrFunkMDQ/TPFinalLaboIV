<?php
            require "../Config/Autoload.php";
            require "../Config/Config.php";
            
            use Config\Autoload as Autoload;
            use Config\Router 	as Router;
            use Config\Request 	as Request;
                    
            Autoload::start();
            use Controllers\MovieController as MovieController;
            use DAO\MovieDAOPDO as MovieDAOPDO; 
            use Models\Movie as Movie;
            
            //$movieController = new MovieController();
            //$movieController->GetMoviesByGenre("Action");

            //$json = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=3a826f6a0e7fb42cdf899bbba2e08621");
            //$result = json_decode($json, true);
            //$restult2 = $result['results'];
            //file_put_contents('../Data/Movies.json', $restult2);
     
            //var_dump($result);
            //$json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=3a826f6a0e7fb42cdf899bbba2e08621&language=es-ES");
            //$result = json_decode($json, true);
            //var_dump($result);

            //$list = array("1", "2", "3");

            //$movie = new Movie();
            //$movie->setMovieName("peli de prueba")->setOverview("test")->setLanguage("en")->setGenre($list)->setIdMovie(1);


            $mdao = new MovieDAOPDO();
            $mdao->SaveMoviesFromAPI();



?>
