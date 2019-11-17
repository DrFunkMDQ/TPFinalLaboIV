
<div class="container-fluid px-5">

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

<div class="container">
    <div class="row">
        <div class= "col-4">
        <form  method="post">
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Filter by Genre </button>
            <div class="dropdown-menu"> 
                <?php foreach ($this->genreList as $genre){?>
                <button class="dropdown-item" type="submit" name="<?php echo $genre->getName(); ?>" onclick = "this.form.action = '<?php echo FRONT_ROOT ?>Show/ShowListingByGenre'" value="<?php echo $genre->getName(); ?>"><?php echo $genre->getName(); ?></button>
                <div class="dropdown-divider"></div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
    <form method="post" action="<?php echo FRONT_ROOT?>Show/ShowListingByDate">
        <div class = "col">
        <div class="form-group"> <input type="date" class="form-control" Name="startDate"> </div>
        <button class="btn btn-primary" > Filter by Date </button>
        </div>
        </form>
    </div>
  </div>
    <div>
    </div>