


<body>
  <div class="py-5 bg-dark text-white">
    <div class="container ">
      <div class="row">
        <div class="col-md-12">
          <form class="col-md-3" method="post" action="<?php echo FRONT_ROOT?>Show/ShowUpdate">
          <input type="input" class="form-control" Name="idShow" style= "display:none" value="<?php echo $id;?>">
            <div class="form-group"> <label>Start Date<br></label> <input type="date" class="form-control" Name="startDate" value = "<?php echo $show->getDate(); ?>"> </div>
            <div class="form-group"> <label>Time Frame<br></label> <input type="time" class="form-control" Name ="time" value = "<?php echo $show->getTime(); ?>"> </div>             
            <input type="input" class="form-control" Name="idShowRoom" style= "display:none" value="<?php echo $idShowRoom;?>">             
            <div class="form-group"> <label>Movie</label> <select name = "movie"><?php foreach($movieList as $movie){?>
            <option class="col-md-4" value="<?php echo $movie->getIdmovie();?>"><?php echo $movie->getMovieName();?></option>
            <?php } ?></select></div><button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

