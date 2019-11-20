<?php require_once('VerifySessionUser.php'); //var_dump($showList)?>

<div class="container-fluid px-5">
    <div class="profileLeftSection">
        <div>
            <h2>Admin Panel</h2>
        </div>
        <table class="table table-borderless table-light">
            <thead>
                <tr class="bg-dark text-light">
                    <td colspan="2">Options</td>
                    <td>Results</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bg-light" colspan="2">Total Earnings</td>
                    <td class="bg-light">Resultado</td>
                </tr>
                <tr>
                    <td class="bg-light">Total by Cinema</td>
                    <td class="bg-light">
                        <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Select Cinema</button>
                            <div class="dropdown-menu">
                                <?php foreach ($cinemaList as $cinema) : ?>
                                    <a class="dropdown-item" href=""><?php echo ($cinema->getCinemaName()) ?></a>
                                    <div class="dropdown-divider"></div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </td>
                    <td class="bg-light">Resultado</td>
                </tr>
                <tr>
                    <td class="bg-light">Total by ShowRoom</td>
                    <td class="bg-light">
                        <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Select ShowRoom</button>
                            <div class="dropdown-menu">
                                <?php foreach ($showRoomsList as $showRoom) : ?>
                                    <a class="dropdown-item" href=""><?php echo ($showRoom->getName()) ?></a>
                                    <div class="dropdown-divider"></div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </td>
                    <td class="bg-light">Resultado</td>
                </tr>
                <tr>
                    <td class="bg-light">Total by Show</td>
                    <td class="bg-light">
                        <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Select Show</button>
                            <div class="dropdown-menu">
                                <?php foreach ($showList as $show) : ?>
                                    <a class="dropdown-item" href=""><?php echo (($show->getMovie())->getMovieName() ." / ".$show->getDate()." / ". $show->getTime()) ?></a>
                                    <div class="dropdown-divider"></div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </td>
                    <td class="bg-light">Resultado</td>
                </tr>
                <tr>
                    <td class="bg-light">Total by Movie</td>
                    <td class="bg-light">
                        <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Select Movie</button>
                            <div class="dropdown-menu">
                                <?php foreach ($movieList as $movie) : ?>
                                    <a class="dropdown-item" href=""><?php echo ($movie->getMovieName()) ?></a>
                                    <div class="dropdown-divider"></div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </td>
                    <td class="bg-light">Resultado</td>
                </tr>
                <tr>
                    <td class="bg-light">Total by Dates</td>
                    <td class="bg-light"></td>
                    <td class="bg-light">Resultado</td>
                </tr>
            </tbody>
        </table>
        <div class="accordion" id="accordion">
        </div>
    </div>
    <div class="profileRightSection">
    <img src="<?php echo IMG_PATH."admin-image.png"?>" alt="admin-image">
    </div>
</div>