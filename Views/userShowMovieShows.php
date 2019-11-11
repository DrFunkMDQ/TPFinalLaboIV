<?php

var_dump($showList);
$cinemaList = array();
$showRoomList = array();
foreach ($showList as $show) {
    var_dump($show);
    array_push($cinemaList, $show->getShowRoom()->getCinema());
}

var_dump($cinemaList);
?>