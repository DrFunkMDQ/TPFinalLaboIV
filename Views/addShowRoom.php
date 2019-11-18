<?php require_once('VerifySessionAdmin.php'); ?>  

<div class="py-1 bg-dark">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <h1 class="display-4 shadow-none bg-dark text-white">Add New Show Room</h1>
    </div>
    </div>
<div class="py-2 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12 bg-dark text-white">
                <form id="c_form-h" action="<?php echo FRONT_ROOT?>ShowRoom/AddShowRoom" method="post">
                    
                            <div class="col-md-12 bg-dark text-white">
                                <div class="form-group row"> <label for="" class="col-2 col-form-label">ShowRoom Name<br></label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" value = ""> </div>
                                    </div>
                                
                                <div class="form-group row"> <label for="" class="col-2 col-form-label">Capacity<br></label>
                                    <div class="col-10">              
                                        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Capacity" min="1" value = ""> </div>            
                                    </div>
                                
                                <div class="form-group row"> <label for="" class="col-2 col-form-label">Ticket Price<br></label>
                                    <div class="col-10">    
                                        <input type="number" class="form-control" id="ticketPrice" name="ticketPrice" placeholder="Ticket Price" min="1" value =""></div>
                                    </div>
                                
                                <div class="form-group row" style="display:none"> <label for="" class="col-2 col-form-label">Id<br></label>
                                    <div class="col-10">    
                                        <input type="number" class="form-control" id="cinemaId" name="cinemaId" placeholder="Id" min="1" value ="<?php echo $showRoomCinemaId?>"></div>
                                    </div>
                                                      
                                        <button type="submit" class="btn btn-light">Apply</button>
                            </div>                    
                </form>
            </div>            
        </div>
    </div>
</div>   
