<?php
            require "../Config/Autoload.php";
            require "../Config/Config.php";
            
            use Config\Autoload as Autoload;
            use Config\Router 	as Router;
            use Config\Request 	as Request;
                    
            Autoload::start();
            use Controllers\MovieController as MovieController;
            use DAO\MovieDAOPDO as MovieDAOPDO; 
            use DAO\MovieDAO as MovieDAO; 
            use Models\Movie as Movie;
            use Models\Cinema as Cinema;
            use Models\ShowRoom as Room;
            use Models\Show as Show;
            use DAO\ShowRoomDAOPDO as ShowRoomDAOPDO;
            use DAO\ShowDAOPDO as ShowDAOPDO;
            use Controllers\ShowRoomController as ShowRoomController;
            use Controllers\ShowController as ShowController;


            
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

            /*$password = "123456";
            $hash = password_hash($password, PASSWORD_DEFAULT);
            var_dump($hash);

            $passTry1 = '123456';
            $passTry2 = '123456789';

            if(password_verify($passTry2, $hash))
                echo 'bien ahi, wachin';
            else 
                echo 'sos medio boludo';



            //$mdao = new MovieDAO();
            //$a = $mdao->GetAll();
            //var_dump($a);

            $room = new Room();
            $show = new Show();
            $movie = new Movie();
            
            $controller = new ShowController();            
            $ShowDAOPDO = new ShowDAOPDO();
            $MovieDAO = new MovieDAOPDO();
            $ShowRoomDAOPDO = new ShowRoomDAOPDO();
            //var_dump($MovieDAO->GetAll());

            //var_dump($MovieDAO->SearchMovieByID(475557));

            $show->setDate(30011996); 
            $show->setTime(1200);
            $show->setMovie(475557); 
            $show->setShowRoom(1);
            
            $idMovie = 475557;
            $idShowRoom = 3;
            $movie = $MovieDAO->searchMovieById($idMovie);
            $newMovie = $MovieDAO->searchMovieById(475557);
            $showRoom = $ShowRoomDAOPDO->searchById($idShowRoom);
            $newShowRoom = $ShowRoomDAOPDO->searchById(3);
            //$controller->Add(20190220, 153000, 2, 636541);
            //$controller->Add(20121112, 221200, 2, 636541);
            //$controller->Add(19980220, 123000, 2, 475557);
            //$controller->Add(20121112, 221200, 3, 475557);
            //$controller->Add(19980220, 123000, 1, 636541);
            //$controller->Remove(4, $showRoom);
            $date = 19991212;
            $time = 222222;
            $idShowRoom = 1;
            $idMovie2 = 636541;
            $idShow = 2;
            $controller->AddShowUpdate($idShow, $date, $time, $idShowRoom, $idMovie2);            
            //$controller->Update(2, $showRoom, $newShowRoom, $newMovie);           
            //var_dump($ShowDAOPDO->GetAllxMovie($movie));*/

            $mdao = new MovieDAOPDO;
            $movie = new Movie();
            $movie->setIdmovie(453405);
            $movie->setMovieName('el bromas');
            var_dump($mdao->validateMovieExists($movie));

            
            
            



?>
