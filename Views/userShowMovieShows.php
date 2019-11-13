<?php

//var_dump($showList);
//var_dump($cinemaList);
//var_dump($showRoomList);
/*foreach ($cinemaList as $cinema) {
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

include('adminNav.php');
?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <?php foreach ($cinemaList as $cinema) { ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><b><?php echo $cinema->getCinemaName() ?></b></h5>
                <?php foreach($showRoomList as $showRoom){
                    if($showRoom->getCinema()->getId() == $cinema->getId()){ ?>
                        <div class="card-body" style="">
                        <h6 class="card-subtitle my-1 text-muted"><?php echo $showRoom->getName(); ?></h6>
                        <?php foreach($showList as $show){
                            if($show->getShowRoom()->getId() == $showRoom->getId()){?>
                                <div class="card-body" style="">
                                    <p class="card-text"><?php echo $show->getMovie()->getMovieName(); ?></p>
                                    <a class="btn btn-primary" href="#">Buy Tickets</a>
                                </div>
                        </div>
            </div>
                  <?php } } } } }?>
          </div>
        </div>
      </div>
    </div>
  </div>
