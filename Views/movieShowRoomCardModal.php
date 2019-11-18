<div class="modal" id="<?php echo ($modalId) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adding Tickets to Cart...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                You are adding X Tickets for <?php echo ($movie->getMovieName()) ?> For this DATE at TIME
                Do you want to continue shopping or checkout??
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue Shoppong</button>
                <button type="button" class="btn btn-primary">Go to Cart</button>
            </div>
        </div>
    </div>
</div>