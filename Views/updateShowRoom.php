<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">

<div class="py-1 bg-dark">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <h1 class="display-4 shadow-none bg-dark text-white">Update Show Room</h1>
    </div>
    </div>
<?php include('adminNav.php') ?>

<div class="py-2 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12 bg-dark text-white">
                <form id="c_form-h" action="<?php echo FRONT_ROOT?>ShowRoom/UpdateShowRoom" method="post">
                    
                            <div class="col-md-12 bg-dark text-white">
                                <div class="form-group row"> <label for="" class="col-2 col-form-label">ShowRoom Name<br></label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" value = "<?php echo $myShowRoom->getName(); ?>"> </div>
                                    </div>
                                
                                <div class="form-group row"> <label for="" class="col-2 col-form-label">Capacity<br></label>
                                    <div class="col-10">              
                                        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Capacity" min="1" value = "<?php echo $myShowRoom->getCapacity(); ?>"> </div>            
                                    </div>
                                
                                <div class="form-group row"> <label for="" class="col-2 col-form-label">Ticket Price<br></label>
                                    <div class="col-10">    
                                        <input type="number" class="form-control" id="ticketPrice" name="ticketPrice" placeholder="Ticket Price" min="1" value ="<?php echo $myShowRoom->getTicketPrice(); ?>"></div>
                                    </div>
                                
                                <div class="form-group row" style="display:none"> <label for="" class="col-2 col-form-label">Id<br></label>
                                    <div class="col-10">    
                                        <input type="number" class="form-control" id="id" name="id" placeholder="Id" min="1" value ="<?php echo $myShowRoom->getId(); ?>"></div>
                                    </div>
                                                      
                                        <button type="submit" class="btn btn-light">Apply</button>
                            </div>                    
                </form>
            </div>            
        </div>
    </div>
</div>   

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>