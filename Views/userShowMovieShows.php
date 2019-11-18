
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        
        <?php foreach ($cinemaList as $cinema) { ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><b><?php echo $cinema->getCinemaName() ?></b></h5>
              
                <?php foreach($showRoomList as $showRoom){                  
                    if($showRoom->getCinema()->getId() == $cinema->getId()){ ?>
                        <div class="card-body" style="">
                          <h6 class="card-subtitle my-1 text-muted"><?php echo $showRoom->getName(); ?></h6>                        
                          <?php foreach($showList as $show){                          
                              if($show->getShowRoom()->getId() == $showRoom->getId()){ ?>
                              <form  action="<?php echo FRONT_ROOT?>Purchase/AddToCart" method="POST">                            
                                  <div class="card-body" style="">
                                      <p class="card-text"><?php echo $show->getMovie()->getMovieName(); ?></p>
                                      <div class="col-2">                                    
                                        <input type="input" class="form-control" name="id_Show" onclick ="<?php $id = $show->getId();?>" style= "display:none" value="<?php echo $id;?>">
                                        <input type="number" class="form-control" name="quantity" placeholder="Quantity" min="1" required>
                                      </div>
                                      <button class="btn btn-primary" type="submit" class="btn btn-light">Add to Cart</button>
                              </form>
                                  </div>
                        </div>
            </div>
                <?php } } } } }?>
                  
          </div>
        </div>
      </div>
    </div>
  </div>
