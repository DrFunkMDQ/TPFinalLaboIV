<div class="leftSectionTableCard">
    <div class="tableCardTitle">
        <h4><?php echo ($showRoom->getName()); ?></h4>
    </div>
    <?php foreach ($showList as $show) :
        $showShowRoom = $show->getShowRoom();
        $modalId = preg_replace('/[^A-Za-z0-9\-]/', '', $movie->getMovieName()) . $show->getId();
        if ($showShowRoom->getId() == $showRoom->getId()) : ?>
            <form method="post">
                <div class="row">
                    <div class="col-md-4 py-2">
                        <span>Date: </span>
                        <span><?php echo ($show->getDate()) ?></span>
                    </div>
                    <div class="col-md-3 py-2">
                        <span>Time: </span>
                        <span><?php echo ($show->getTime()) ?></span>
                    </div>
                    <div class="col-sm-4 py-2">
                        <span>Qty: </span>
                        <input type="text" name = "idShow" style="display:none" value="<?php echo($show->getId())?>" required>
                        <input type="number" min="1" max="<?php echo $remainingList[$show->getId()]; ?>" step="1" value="1" name = "quantity" required>
                        <?php if ($remainingList[$show->getId()] > 0){ ?>
                            <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#<?php echo ($modalId) ?>">Add</button>
                        <?php } else { ?>
                            <button type="button" disabled class="btn btn-primary" data-toggle="modal" data-target="#<?php echo ($modalId) ?>">Sold Out</button>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal" id="<?php echo ($modalId) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Adding Tickets to Cart...</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                You are adding Tickets for "<?php echo ($movie->getMovieName()) ?>"<br>
                                For this <?php echo ($show->getDate() . " at " . $show->getTime()) ?><br>
                                Do you want to continue shopping or checkout??
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary" onclick="this.form.action = '<?php echo FRONT_ROOT ?>Show/AddToCart'">Add to Cart</button>
                                <button type="submit" class="btn btn-primary" onclick="this.form.action = '<?php echo FRONT_ROOT ?>Purchase/AddShowCartView'">Add and Go to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    <?php endif;
    endforeach ?>
</div>