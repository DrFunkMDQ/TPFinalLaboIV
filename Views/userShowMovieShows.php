<?php

//var_dump($showList);
var_dump($cinemaList);
$showRoomList = array();
foreach ($cinemaList as $cinema) {
    echo $cinema->getCinemaName();
    echo "<br>";
    foreach($showList as $show){
        if($show->getShowroom()->getCinema()->getId() == $cinema->getId()){
            echo $show->getShowroom()->getName();
            array_pop($showList);
        }    
    }
}
    
    //array_push($cinemaList, $show->getShowRoom()->getCinema());

//var_dump($cinemaList);
?>