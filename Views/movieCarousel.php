<div class="carousel slide carousel-slide" data-ride="carousel" id="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active"> <img class="carouselImg" src="<?php echo W342_IMG . $this->firstMovie->getImage(); ?>">
      <div class="carousel-caption">
        <h5 class="m-0"><?php echo $this->firstMovie->getMovieName(); ?></h5>
        <p></p>
      </div>
    </div>
    <?php foreach ($this->movieList as $movieDisplayed) { ?>
      <div class="carousel-item"> <img class="carouselImg" src="<?php echo W342_IMG . $movieDisplayed->getImage(); ?>">
        <div class="carousel-caption">
          <h5 class="m-0"><?php echo $movieDisplayed->getMovieName(); ?></h5>
          <p></p>
        </div>
      </div>
    <?php } ?>
  </div> <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carousel" role="button" data-slide="next"> <span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span> </a>
</div>