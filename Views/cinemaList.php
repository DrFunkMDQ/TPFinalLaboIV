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
      <?php
        foreach($cinemaList as $cinema):          ?>
          <div class="row bg-light">
            <div class="col-md-3 py-1"><?php echo $cinema->getCinemaName();?></div>
            <div class="col-md-3 py-1"><?php echo $cinema->getAddress();?></div>
            <div class="col-md-2 py-1"><?php echo $cinema->getCapacity();?></div>
            <div class="col-md-2 py-1"><?php echo $cinema->getTicketPrice();?></div>
            <div class="col-md-1 py-1"><button class ="btn btn-dark" type="submit"  name="CinemaUpdate" onclick = "this.form.action = '<?php echo FRONT_ROOT?>Cinema/UpdateCinema'" value="<?php echo $cinema->getCinemaName(); ?>">Modify</button></div>
            <div class="col-md-1 py-1"><button class ="btn btn-dark" type="submit" name="CinemaRemove" onclick = "this.form.action = '<?php echo FRONT_ROOT?>Cinema/RemoveCinema'" value="<?php echo $cinema->getCinemaName(); ?>" >Delete</button></div>
          </div>
        <?php endforeach;
        ?>
        </form>
    </div>
  </div>
