<?php require_once('VerifySessionUser.php');
?>

<div class="container-fluid px-5">
    <div class="profileLeftSection">
        <div>
            <h2>Admin Panel</h2>
        </div>
        <table class="table table-borderless table-light">
            <thead>
                <tr class="bg-dark text-light">
                    <td colspan="3">Options</td>
                    <td>Ticket Qty</td>
                    <td>Total $</td>
                </tr>
            </thead>
            <tbody>
                <tr class="panelRow">
                    <td class="bg-light" colspan="3">Total Earnings</td>
                    <td class="bg-light"> <?php echo $_SESSION["Grand-Totals"]["tickets"]?>
                    <td class="bg-light"> <?php echo $_SESSION["Grand-Totals"]["total"]?>
                </tr>
                <tr class="panelRow">
                    <td class="bg-light">Total by Cinema</td>
                    <td class="bg-light" colspan="2">
                        <form method="post">
                            <div class="btn-group">
                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Select Cinema</button>
                                <div class="dropdown-menu">
                                    <?php foreach ($cinemaList as $cinema) : ?>
                                        <button class="dropdown-item" type="submit" name="<?php echo $cinema->getCinemaName() ?>" onclick="this.form.action='<?php echo FRONT_ROOT ?>User/ShowTotalByCinema'" value="<?php echo ($cinema->getId()) ?>"><?php echo ($cinema->getCinemaName()) ?></button>
                                        <div class="dropdown-divider"></div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </form>
                    </td>
                        <td class="bg-light"> <?php if (isset($_SESSION["Total-cinema"])) {echo $_SESSION["Total-cinema"]["tickets"];} else {echo "-";} ?>
                    </td>
                        <td class="bg-light"> <?php if (isset($_SESSION["Total-cinema"])) {echo $_SESSION["Total-cinema"]["total"];} else {echo "-";} ?>
                    </td>
                </tr>
                <tr class="panelRow">
                    <td class="bg-light">Total by ShowRoom</td>
                    <td class="bg-light" colspan="2">
                        <form method="post">
                            <div class="btn-group">
                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Select ShowRoom</button>
                                <div class="dropdown-menu">
                                    <?php foreach ($showRoomsList as $showRoom) : ?>
                                        <button class="dropdown-item" type="submit" name="<?php echo $showRoom->getName() ?>" onclick="this.form.action='<?php echo FRONT_ROOT ?>User/ShowTotalByShowRoom'" value="<?php echo ($showRoom->getId()) ?>"><?php echo ($showRoom->getName()) ?></button>
                                        <div class="dropdown-divider"></div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td class="bg-light"> <?php if (isset($_SESSION["Total-Showroom"])) {echo $_SESSION["Total-Showroom"]["tickets"];} else {echo "-";} ?>
                    <td class="bg-light"> <?php if (isset($_SESSION["Total-Showroom"])) {echo $_SESSION["Total-Showroom"]["total"];} else {echo "-";} ?>
                </tr>
                <tr class="panelRow">
                    <td class="bg-light">Total by Show</td>
                    <td class="bg-light" colspan="2">
                        <form method="post">
                            <div class="btn-group">
                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Select Show</button>
                                <div class="dropdown-menu">
                                    <?php foreach ($showList as $show) : ?>
                                        <button class="dropdown-item" type="submit" name="<?php echo $show->getId() ?>" onclick="this.form.action='<?php echo FRONT_ROOT ?>User/ShowTotalByShow'" value="<?php echo ($show->getId()) ?>"><?php echo (($show->getMovie())->getMovieName() . " / " . $show->getDate() . " / " . $show->getTime()) ?></button>
                                        <div class="dropdown-divider"></div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td class="bg-light"> <?php if (isset($_SESSION["Total-Show"])) {echo $_SESSION["Total-Show"]["tickets"];} else {echo "-";} ?>
                    <td class="bg-light"> <?php if (isset($_SESSION["Total-Show"])) {echo $_SESSION["Total-Show"]["total"];} else {echo "-";} ?>
                </tr>
                <tr class="panelRow">
                    <td class="bg-light">Total by Movie</td>
                    <td class="bg-light" colspan="2">
                        <form method="post">
                            <div class="btn-group">
                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Select Movie</button>
                                <div class="dropdown-menu">
                                    <?php foreach ($movieList as $movie) : ?>
                                        <button class="dropdown-item" type="submit" name="<?php echo $movie->getIdmovie() ?>" onclick="this.form.action='<?php echo FRONT_ROOT ?>User/ShowTotalByMovie'" value="<?php echo ($movie->getIdmovie()) ?>"><?php echo ($movie->getMovieName()) ?></button>
                                        <div class="dropdown-divider"></div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td class="bg-light"> <?php if (isset($_SESSION["Total-Movie"])) {echo $_SESSION["Total-Movie"]["tickets"];} else {echo "-";} ?>
                    <td class="bg-light"> <?php if (isset($_SESSION["Total-Movie"])) {echo $_SESSION["Total-Movie"]["total"];} else {echo "-";} ?>
                </tr>
                <tr class="panelRow">
                    <form methos="post" action="<?php echo FRONT_ROOT?>User/ShowTotalByDate">
                    <td class="bg-light">Total by Dates</td>
                    <td class="bg-light">
                        <span>Start Date:</span>
                        <input type="date" class="form-control" name="startDate"><br>
                        <span>End Date:</span>
                        <input type="date" class="form-control" name="endDate">
                    </td>
                    <td class="bg-light">
                        <button class="btn btn-primary" type="submit">Calculate</button>
                    </td>
                    <td class="bg-light"> <?php if (isset($_SESSION["Total-Dates"])) {echo $_SESSION["Total-Dates"]["tickets"];} else {echo "-";} ?>
                    <td class="bg-light"> <?php if (isset($_SESSION["Total-Dates"])) {echo $_SESSION["Total-Dates"]["total"];} else {echo "-";} ?>
                    </form>
                </tr>
            </tbody>
        </table>
        <div class="accordion" id="accordion">
        </div>
    </div>
    <div class="adminRightSection">
        <img src="<?php echo IMG_PATH . "admin-image.png" ?>" alt="admin-image">
    </div>
</div>