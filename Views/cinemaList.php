<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
</head>

<body class="align-items-end bg-gray">
  <div class="py-5 align">
    <div class="container  rounded">
      <div class="row rounded bg-dark text-uppercase text-light">
        <div class="col-md-3  font-weight-bold  ">Name</div>
        <div class="col-md-3  font-weight-bold ">Address</div>
        <div class="col-md-2  font-weight-bold ">Capacity</div>
        <div class="col-md-2  font-weight-bold ">Ticket Price</div>
      </div>
      <form action="<?php echo FRONT_ROOT?>Cinema/RemoveCinema" method="post">
      <?php
        foreach($this->cinemaDAO->GetAll() as $cinema):          ?>
          <div class="row bg-light">
            <div class="col-md-3 py-1"><?php echo $cinema->getCinemaName();?></div>
            <div class="col-md-3 py-1"><?php echo $cinema->getAddress();?></div>
            <div class="col-md-2 py-1"><?php echo $cinema->getCapacity();?></div>
            <div class="col-md-2 py-1"><?php echo $cinema->getTicketPrice();?></div>
            <div class="col-md-1 py-1"><button type="submit" >Modify</button></div>
            <div class="col-md-1 py-1"><button type="submit" name="CinemaRemove" value="<?php echo $cinema->getCinemaName(); ?>" >Delete</button></div>
          </div>
        <?php endforeach;
        ?>
        </form>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>