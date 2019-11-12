<?php

//var_dump($showList);
//var_dump($cinemaList);
//var_dump($showRoomList);
foreach ($cinemaList as $cinema) {
    echo $cinema->getCinemaName();
    echo "<br>";
    foreach($showRoomList as $showRoom){
        if($showRoom->getCinema()->getId() == $cinema->getId()){
            echo $showRoom->getName();
            echo "<br>";
            foreach($showList as $show){
                if($show->getShowRoom()->getId() == $showRoom->getId()){
                    echo $show->getMovie()->getMovieName();
                    echo "<br>";
                    echo "<br>";
                }
            }
        }
    }
}
    
    //array_push($cinemaList, $show->getShowRoom()->getCinema());

//var_dump($cinemaList);*/
?>