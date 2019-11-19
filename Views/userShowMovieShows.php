<div class="container-fluid px-5">
  <div class="pageHeader">
    <h2>Movie Shows for <?php echo ($movie->getMovieName()) ?></h2>
  </div>
  <div class="leftSection">
    <?php foreach($cinemaList as $cinema):?>
      <?php include(VIEWS_PATH . 'movieShowCinemaCard.php') ?>
    <?php endforeach?>
  </div>
  <div style="background:url('')">
    <img src="<?php echo (W342_IMG . $movie->getImage()) ?>" alt="" class="movieShowPoster">
  </div>
</div>