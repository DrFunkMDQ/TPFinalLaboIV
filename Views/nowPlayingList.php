<?php
  include('adminNav.php');
  //$this->GetMoviesByGenre("Action");
?>
<table id="tablePreview" class="table table-striped table-hover table-borderless">
  <thead>
  <form  method="post">
  <div class="btn-group pull-right px-2">
    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Filter by Genre </button>
    <div class="dropdown-menu"> 
    <?php foreach ($this->genreList as $genre){?>
      <button class="dropdown-item" type="submit" name="<?php echo $genre->getName(); ?>" onclick = "this.form.action = '<?php echo FRONT_ROOT ?>Movie/ListMoviesByGenre'" value="<?php echo $genre->getName(); ?>"><?php echo $genre->getName(); ?></button>
      <div class="dropdown-divider"></div>
      <?php } ?>
    </div>
  </div>
  </form>
    <tr>
      <th>Name</th>
      <th>Overview</th>
      <th>Genres</th>
      <th>Language</th>
      <th>Poster</th>
    </tr>
  </thead>
  <!--Table head-->
  <!--Table body-->
  <tbody>
    <tr>
      <td><?php echo $this->firstMovie->getMovieName();?></td>
      <td><?php echo $this->firstMovie->getOverview();?></td>
      <td>
      <?php foreach($this->firstMovie->getGenre() as $genre){?>
        <?php echo $genre;?>
      <?php }?>
      </td>
      <td><?php echo $this->firstMovie->getLanguage();?></td>
      <td><img class="d-block img-fluid w-154" src="<?php echo W154_IMG.$this->firstMovie->getImage();?>"></td>
    </tr>
    <?php foreach($this->movieList as $movieDisplayed){?>
    <tr>
      <td><?php echo $movieDisplayed->getMovieName();?></td>
      <td><?php echo $movieDisplayed->getOverview();?></td>
      <td>
      <?php foreach($movieDisplayed->getGenre() as $genre){?>
        <?php echo $genre;?>
      <?php }?>
      </td>
      <td><?php echo $movieDisplayed->getLanguage();?></td>
      <td><img class="d-block img-fluid w-154" src="<?php echo W154_IMG.$movieDisplayed->getImage();?>"></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php
  include('movieCarousel.php');
?>
