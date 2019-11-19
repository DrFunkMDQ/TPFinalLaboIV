<div class="leftSectionTable">
    <table class="table table-borderless table-light">
        <thead>
            <tr class="my-2 rounded bg-dark text-uppercase text-light">
                <th><?php echo($cinema->getCinemaName())?></th>
            </tr>
        </thead>
    </table>
    <?php foreach($showRoomList as $showRoom):?>
        <?php $showRoomCinema = $showRoom->getCinema();
            if($showRoomCinema->getId() == $cinema->getId()) :?>
                <div class="leftSectionTableCard">
                    <?php include(VIEWS_PATH."movieShowRoomCard.php")?>
                </div>
            <?php endif?>
    <?php endforeach?>
</div>


