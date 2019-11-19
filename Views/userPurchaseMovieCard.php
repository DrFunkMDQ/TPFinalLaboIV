<div class="row">
    <div class="col-md-3 py-1">
        <?php echo ((($ticket->getShow())->getMovie())->getMovieName())
        ?>
    </div>
    <div class="col-md-5 py-1">
        <?php echo ((($ticket->getShow())->getShowRoom())->getName())
        ?>
    </div>
    <div class="col-md-3 py-1">
        <?php echo ((($ticket->getShow())->getShowRoom())->getTicketPrice())
        ?>
    </div>
</div>