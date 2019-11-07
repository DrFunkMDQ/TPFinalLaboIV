<?php
    include_once('adminNav.php');
    //var_dump($movieList);
        /*foreach($movieList as $myMovie){
            include('movieCard.php');
        }*/
            
?>
<div class="container-fluid px-5">
    <div>

    </div>
    <div class="moviesList">
        <div>
            <h2 class="cardsTitle">Now Playing Movies</h2>
        </div>
        <form action="post" class="cardsForm">
            <?php foreach($movieList as $myMovie){
                include('movieCard.php');
            }?>
        </form>
    </div>
</div>
