<?php var_dump($myCinema); ?>

<form action="<?php echo FRONT_ROOT?>Cinema/AddCinemaUpdate" method="post">
    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" value = "<?php echo $myCinema->getCinemaName(); ?>"> </div>
            
    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required="required" value = "<?php echo $myCinema->getAddress(); ?>"> </div>
                          
    <input type="number" class="form-control" id="" name="capacity" placeholder="Capacity" min="1" value = "<?php echo $myCinema->getCapacity(); ?>"> </div>            
           
    <input type="number" class="form-control" id="" name="ticketPrice" placeholder="Ticket Price" min="1" value ="<?php echo $myCinema->getTicketPrice(); ?>"></div>
            
    <button type="submit" class="btn btn-light">New Cinema</button>
</form>