<!DOCTYPE html>
<html>

<?php
  $movieList = $this->movieDAO->GetAll();
  $firstMovie = array_shift($movieList);
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
</head>

<body>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="carousel slide" data-ride="carousel" id="carousel">
            <div class="carousel-inner">
            
              <div class="carousel-item active"> <img class="d-block img-fluid w-342" src="<?php echo W342_IMG.$firstMovie->getImage()?>">
                <div class="carousel-caption">
                  <h5 class="m-0"><?php echo $firstMovie->getMovieName();?></h5>
                  <p></p>
                </div>
              </div>
              <?php foreach($movieList as $movieDisplayed){?>
                  <div class="carousel-item"> <img class="d-block img-fluid w-342" src="<?php echo W342_IMG.$movieDisplayed->getImage();?>">
                    <div class="carousel-caption">
                      <h5 class="m-0"><?php echo $movieDisplayed->getMovieName();?></h5>
                      <p></p>
                    </div>
                  </div>
              <?php }?>
            </div> <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carousel" role="button" data-slide="next"> <span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span> </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>