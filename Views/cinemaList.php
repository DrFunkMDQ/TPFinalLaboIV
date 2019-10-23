<?php include('adminNav.php')?>

<body class="align-items-end bg-gray">
  <div class="py-5 align">
    <div class="container  rounded">
      <div class="row rounded bg-dark text-uppercase text-light">
        <div class="col-md-3  font-weight-bold  ">Name</div>
        <div class="col-md-3  font-weight-bold ">Address</div>
        <div class="col-md-2  font-weight-bold ">Capacity</div>
        <div class="col-md-2  font-weight-bold ">Ticket Price</div>
      </div>
      <form  method="post">
        <div class="accordion" id="cinemas">
          <?php
            foreach($cinemaList as $cinema):          ?>
            <div class="card">
              <div class="card-header" id = "heading<?php echo str_replace(' ','',$cinema->getCinemaName());?>">
                <div class="row bg-light">
                    <div class="col-md-3 py-1">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="collapse<?php echo str_replace(' ','',$cinema->getCinemaName()); ?>">
                        <?php echo $cinema->getCinemaName();?>  
                      </button>
                    </div>
                    <div class="col-md-3 py-1"><?php echo $cinema->getAddress();?></div>
                    <div class="col-md-2 py-1"><?php echo $cinema->getCapacity();?></div>
                    <div class="col-md-2 py-1"><?php echo $cinema->getTicketPrice();?></div>
                    <div class="col-md-1 py-1"><button class ="btn btn-dark" type="submit"  name="CinemaUpdate" onclick = "this.form.action = '<?php echo FRONT_ROOT?>Cinema/UpdateCinema'" value="<?php echo $cinema->getCinemaName(); ?>">Modify</button></div>
                    <div class="col-md-1 py-1"><button class ="btn btn-dark" type="submit" name="CinemaRemove" onclick = "this.form.action = '<?php echo FRONT_ROOT?>Cinema/RemoveCinema'" value="<?php echo $cinema->getCinemaName(); ?>" >Delete</button></div>
                </div>
              </div>
              <div id="collapse<?php echo str_replace(' ','',$cinema->getCinemaName()); ?>" class="collapse show" aria-labelledby="heading<?php echo str_replace(' ','',$cinema->getCinemaName());?>" data-parent="#cinemas">
                <div class="card-body">
                  <p>Salas del cine <?php echo $cinema->getCinemaName()?></p>
                </div>
              </div>
            </div>
            <?php endforeach;
            ?>
        </div>
        </form>
    </div>
  </div>
