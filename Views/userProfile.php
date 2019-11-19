<?php require_once('VerifySessionUser.php'); ?>  

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
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Purchase 25AH89</button>
                        </div>
                        <div class="col-md-4 py-1">PURCHASE DATE</div>
                        <div class="col-md-3 py-1">PURCHASE PRICE</div>
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
                            <div class="row">
                                <div class="col-md-3 py-1">Ticket 1 Movie</div>
                                <div class="col-md-5 py-1">Ticket 1 ShowRoom</div>
                                <div class="col-md-3 py-1">Ticket 1 Price</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 py-1">Ticket 2 Movie</div>
                                <div class="col-md-5 py-1">Ticket 2 ShowRoom</div>
                                <div class="col-md-3 py-1">Ticket 2 Price</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 py-1">Ticket 3 Movie</div>
                                <div class="col-md-5 py-1">Ticket 3 ShowRoom</div>
                                <div class="col-md-3 py-1">Ticket 3 Price</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>