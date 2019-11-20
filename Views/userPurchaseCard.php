<div class="card">
    <div class="card-header" id="headingOne">
        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo($purchase->getId())?>" aria-expanded="true" aria-controls="collapse<?php echo($purchase->getId())?>"><?php echo $purchase->getId() ?></button>
            </div>
            <div class="col-md-4 py-1"><?php echo $purchase->getPurchaseDate() ?></div>
            <div class="col-md-3 py-1"><?php echo $purchase->getTotal() ?></div>
        </div>
    </div>
    <div id="collapse<?php echo($purchase->getId())?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
            <div class="table">
                <div class="row bg-dark text-uppercase text-light">
                    <div class="col-md-3 py-1">Movie</div>
                    <div class="col-md-5 py-1">ShowRoom</div>
                    <div class="col-md-3 py-1">Ticket Price</div>
                </div>
                <?php foreach ($purchase->getTicketList() as $ticket){
                    include(VIEWS_PATH."userPurchaseMovieCard.php");
                }?>
            </div>
        </div>
    </div>
</div>