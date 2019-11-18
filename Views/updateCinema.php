<?php require_once('VerifySessionAdmin.php'); ?>  

<div class="py-2 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12 bg-dark text-white">
                <form id="c_form-h" action="<?php echo FRONT_ROOT?>Cinema/AddCinemaUpdate" method="post">
                            <div class="col-md-12 bg-dark text-white">
                                <div class="form-group row"> <label for="" class="col-2 col-form-label">Cinema ID<br></label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="id" name="id" placeholder="id" required="required" readonly="readonly" value = "<?php echo $this->cinema->getId(); ?>"> </div>
                                    </div>
                                <div class="form-group row"> <label for="" class="col-2 col-form-label">Name<br></label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" value = "<?php echo $this->cinema->getCinemaName(); ?>"> </div>
                                    </div>
                                     
                                <div class="form-group row"> <label for="" class="col-2 col-form-label">Address<br></label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required="required" value = "<?php echo $this->cinema->getAddress(); ?>"> </div>
                                    </div>
                                        <button type="submit" class="btn btn-light">Apply</button>
                            </div>                    
                </form>
            </div>            
        </div>
    </div>
</div>   
