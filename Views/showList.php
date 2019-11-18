<?php require_once('VerifySessionAdmin.php'); ?>  

<head>
  <link rel="stylesheet" href="<?php echo CSS_PATH . "/showsListStyle.css" ?>" type="text/css">
</head>

<div class="container-fluid px-5">
  <div class="pageHeader">
    <div class="pageHeaderTitle">
      <h2>Cinema shows </h2>
    </div>
    <div class="pageHeaderFilter">
      <form method="post">
        <button class="btn btn-primary pull-right" name=showId onclick="this.form.action = '<?php echo FRONT_ROOT ?>Show/ShowAddShowView'" value="<?php echo $this->myShowRoom->getId(); ?>"> New Show </button>
      </form>
    </div>
  </div>
  <table id="tablePreview" class="table table-striped table-hover table-borderless table-light">
    <thead>
      <tr class="my-2 rounded bg-dark text-uppercase text-light">
        <th>Date</th>
        <th>Time</th>
        <th>Movie</th>
        <th colspan="2">Poster</th>
      </tr>
    </thead>
    <tbody>
      <form method="post">
        <?php foreach ($this->ShowDAOPDO as $show) { ?>
          <tr>
            <td><?php echo $show->getDate(); ?></td>
            <td><?php echo $show->getTime(); ?></td>
            <td><?php echo $show->getMovie()->getMovieName(); ?></td>
            <td>
              <img class="d-block img-fluid w-154" src="<?php echo W154_IMG . $show->getMovie()->getImage(); ?>"></td>
            <td>
              <div class="col-md-1 py-1"> <button class="btn btn-dark" type="submit" name="ShowRoomUpdate" onclick="this.form.action = '<?php echo FRONT_ROOT ?>Show/Explode'" value="<?php echo $show->getId() . "/" . $idShowroom; ?>">Modify</button></div>
              <div class="col-md-1 py-1"> <button class="btn btn-dark" type="submit" name="ShowRoomRemove" onclick="this.form.action = '<?php echo FRONT_ROOT ?>Show/Explode'" value="<?php echo $show->getId() . "/" . $idShowroom; ?>">Delete</button></div>
            </td>
          </tr>
        <?php } ?>
      </form>
    </tbody>
  </table>
</div>