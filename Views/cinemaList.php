<?php include('adminNav.php') ?>

<body class="align-items-end bg-gray">
  <div class="py-5 align">
    <div class="container  rounded">
      <div class="row rounded bg-dark text-uppercase text-light">
        <div class="col-md-3  font-weight-bold ">Name</div>
        <div class="col-md-3  font-weight-bold ">Address</div>
        <div class="col-md-2  font-weight-bold ">Capacity</div>
        <div class="col-md-2  font-weight-bold ">Ticket Price</div>
      </div>
      <form method="post">
        <div class="accordion" id="theaters">
          <?php foreach ($cinemaList as $cinema) : ?>
          <?php $activeTab = array_shift($firstShowRooms);?>
            <div class="card">
              <div class="card-header">
                <div class="row bg-light">
                  <div class="col-md-3 py-1">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo str_replace(' ', '', $cinema->getCinemaName()); ?>">
                      <?php echo $cinema->getCinemaName(); ?>
                    </button>
                  </div>
                  <div class="col-md-7 py-1"><?php echo $cinema->getAddress(); ?></div>
                  <div class="col-md-1 py-1"><button class="btn btn-dark" type="submit" name="CinemaUpdate" onclick="this.form.action = '<?php echo FRONT_ROOT ?>Cinema/UpdateCinema'" value="<?php echo $cinema->getCinemaName(); ?>">Modify</button></div>
                  <div class="col-md-1 py-1"><button class="btn btn-dark" type="submit" name="CinemaRemove" onclick="this.form.action = '<?php echo FRONT_ROOT ?>Cinema/RemoveCinema'" value="<?php echo $cinema->getCinemaName(); ?>">Delete</button></div>
                </div>
              </div>
              <div class="collapse" id="collapse<?php echo str_replace(' ', '', $cinema->getCinemaName()); ?>" aria-labelledby="heading<?php echo str_replace(' ', '', $cinema->getCinemaName()); ?>" data-parent="#theaters">
                <div class="card-body">                
                  <?php if(isset($activeTab)) : ?>

                    <ul class="nav nav-tabs" id="showRoomsTabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="<?php echo str_replace(' ','',$activeTab->getName())?>-tab" href="#<?php echo str_replace(' ','',$activeTab->getName())?>" role="tab" aria-controls="<?php echo str_replace(' ','',$activeTab->getName())?>" data-toggle="tab" aria-selected="true"><?php echo $activeTab->getName()?></a>
                      </li>
                      <?php foreach ($cinema->getShowRoomsList() as $showRoom):?>                    
                        <li class="nav-item">
                          <a class="nav-link" id="<?php echo str_replace(' ','', $showRoom->getName());?>-tab" href="#<?php echo str_replace(' ','', $showRoom->getName());?>" role="tab" aria-controls="<?php echo str_replace(' ','', $showRoom->getName());?>" data-toggle="tab" aria-selected="false"> <?php echo $showRoom->getName()?> </a>
                        </li>
                      <?php endforeach ?> 
                      <li class="nav-item">
                        <a class="nav-link" id="newShowRoom<?php echo str_replace(' ','',$cinema->getCinemaName())?>-tab" href="#newShowRoom<?php echo str_replace(' ','',$cinema->getCinemaName())?>" role="tab" aria-controls="newShowRoom<?php echo str_replace(' ','',$cinema->getCinemaName())?>" data-toggle="tab" aria-selected="false" >+</a>
                      </li>                  
                    </ul>

                    <div class="tab-content" id="showRoomsContent">
                      <div class="tab-pane fade active show" id="<?php echo str_replace(' ','', $activeTab->getName());?>"role="tabpanel" aria-labelledby="<?php echo str_replace(' ','', $activeTab->getName());?>-tab">
                        <div class="row">
                          <div class="col-md-6 py-1"> <?php echo $activeTab->getName()?> </div>
                          <div class="col-md-2 py-1"> <?php echo $activeTab->getCapacity()?> </div>
                          <div class="col-md-2 py-1"> <?php echo $activeTab->getTicketPrice()?> </div>
                          <div class="col-md-1 py-1"> <button class="btn btn-dark" type="submit" name="ShowRoomUpdate" onclick="this.form.action = '<?php echo FRONT_ROOT?>ShowRoom/UpdateShowRoomView'" value="<?php echo $activeTab->getId()?>">Modify</button></div>
                          <div class="col-md-1 py-1"> <button class="btn btn-dark" type="submit" name="ShowRoomRemove" onclick="this.form.action = '<?php echo FRONT_ROOT?>ShowRoom/RemoveShowRoomView'" value="<?php echo $activeTab->getId()?>">Delete</button></div>
                        </div>
                      </div>
                      <?php foreach ($cinema->getShowRoomsList() as $showRoom):?>
                        <div class="tab-pane fade" id="<?php echo str_replace(' ','', $showRoom->getName());?>" role="tabpanel" aria-labelledby="<?php echo str_replace(' ','', $showRoom->getName());?>-tab">
                          <div class="row"> 
                            <div class="col-md-6 py-1"> <?php echo $showRoom->getName()?> </div>
                            <div class="col-md-2 py-1"> <?php echo $showRoom->getCapacity()?> </div>
                            <div class="col-md-2 py-1"> <?php echo $showRoom->getTicketPrice()?> </div>
                            <div class="col-md-1 py-1"> <button class="btn btn-dark" type="submit" name="ShowRoomUpdate" onclick="this.form.action = '<?php echo FRONT_ROOT?>ShowRoom/UpdateShowRoomView'" value= "<?php echo $showRoom->getId()?>">Modify</button></div>
                            <div class="col-md-1 py-1"> <button class="btn btn-dark" type="submit" name="ShowRoomRemove" onclick="this.form.action = '<?php echo FRONT_ROOT?>ShowRoom/RemoveShowRoomView'" value=" <?php echo $showRoom->getId()?>">Delete</button></div>
                          </div>
                        </div>
                      <?php endforeach ?>
                      <div class="tab-pane fade" id="newShowRoom<?php echo str_replace(' ','',$cinema->getCinemaName())?>" role="tabpanel" aria-labelledby="newShowRoom<?php echo str_replace(' ','',$cinema->getCinemaName())?>-tab">
                        <div class="row">
                          <div class="col-md-12 py-1">
                            <button class="btn btn-dark" type="submit" name = "idCinema" onclick="this.form.action = '<?php echo FRONT_ROOT?>ShowRoom/AddShowRoomView'" value="<?php echo $cinema->getId()?>">Add new ShowRoom</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php 
                    else: {?>
                      <ul class="nav nav-tabs" id="showRoomsTabs" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="newShowRoom<?php echo str_replace(' ','',$cinema->getCinemaName())?>-tab" href="#newShowRoom<?php echo str_replace(' ','',$cinema->getCinemaName())?>" role="tab" aria-controls="newShowRoom<?php echo str_replace(' ','',$cinema->getCinemaName())?>" data-toggle="tab" aria-selected="false" >+</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="showRoomsContent">
                        <div class="tab-pane fade active show" id="newShowRoom<?php echo str_replace(' ','',$cinema->getCinemaName())?>" role="tabpanel" aria-labelledby="newShowRoom<?php echo str_replace(' ','',$cinema->getCinemaName())?>-tab">
                          <div class="row">
                            <div class="col-md-12 py-1">
                              <button class="btn btn-dark" type="submit" name = "idCinema" onclick="this.form.action = '<?php echo FRONT_ROOT?>ShowRoom/AddShowRoomView'" value="<?php echo $cinema->getId()?>">Add new ShowRoom</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  <?php } 
                  endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </form>
    </div>
  </div>