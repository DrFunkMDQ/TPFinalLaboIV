<<<<<<< HEAD

=======
<?php require_once('VerifySessionUser.php'); ?>  
>>>>>>> sessionUser

<div class="container-fluid px-5">
    <div class="profileDataSection">
        <div>
            <h2>Personal Information</h2>
        </div>
        <div class="profileData">
            <table class="table table-borderless text-light">
                <tr>
                    <td class="rowLabel">First Name:</td>
                    <td><?php echo ($loggedUser->getUserName()) ?></td>
                </tr>
                <tr>
                    <td class="rowLabel">Last Name:</td>
                    <td><?php echo ($loggedUser->getUserLastName()) ?></td>
                </tr>
                <tr>
                    <td class="rowLabel">Email:</td>
                    <td><?php echo ($loggedUser->getEmail()) ?></td>
                </tr>
                <tr>
                    <td class="rowLabel"> Birthday:</td>
                    <td><?php echo ($loggedUser->getBirthday()) ?></td>
                </tr>
            </table>
        </div>
    </div>    
    <div class="profileTicketsSection">
        <div>
            <h2>Purchase History</h2>
        </div>       
        <table class="table table-borderless table-light">
            <thead>
            <?php foreach ($userPurchases as $purchase) {?>
                <tr class="bg-dark text-light">
                    <th>Purchase ID</th>
                    <th>Purchase Date</th>
                    <th>Purchase Amount</th>
                </tr>
            </thead>
        </table>        
        <div class="accordion" id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <div class="row">
                        <div class="col-md-4">                        
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?php echo $purchase['id_purchase']?></button>
                        </div>
                        <div class="col-md-4 py-1"><?php echo $purchase['purchase_date'] ?></div>
                        <div class="col-md-3 py-1"><?php echo $purchase['total']?></div>
                    </div>                    
                </div>     
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table">
                            <div class="row bg-dark text-uppercase text-light">
                                <div class="col-md-3 py-1">Movie</div>
                                <div class="col-md-5 py-1">ShowRoom</div>
                                <div class="col-md-3 py-1">Ticket Price</div>
                            </div>
                            <?php foreach ($ticketsList[$purchase['id_purchase']] as $ticket) {?>
                            <div class="row">
                                <div class="col-md-3 py-1"><?php echo $this->movieDAO->searchMovieById($ticket['id_movie'])->getMovieName()?></div>
                                <div class="col-md-5 py-1"><?php echo $this->showRoomDAO->searchById($ticket['id_show_room'])->getName()?></div>
                                <div class="col-md-3 py-1"><?php echo $ticket['ticket_price']?></div>
                            </div>
                            <?php }?>                            
                        </div>
                    </div>
                </div>                                
            </div>
            <?php }?>  
        </div>
    </div>
    