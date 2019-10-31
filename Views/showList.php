<?php
  include('adminNav.php');
?>
<div class="container-fluid px-5">
<table id="tablePreview" class="table table-striped table-hover table-borderless">
  <thead>
  <form  method="post">
  <div class="btn-group pull-right px-2">
    <button class="btn btn-primary" name = showId onclick = "this.form.action = '<?php echo FRONT_ROOT ?>Show/ShowAddShowView'" value="<?php echo $this->myShow->getId(); ?>"> New Show </button>
    </div>
  </div>
  </form>
    <tr class= "my-2 rounded bg-dark text-uppercase text-light">
      <th>Date</th>
      <th>Time</th>
      <th>Movie</th>
      <th>Poster</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($this->ShowDAOPDO as $show){?>
    <tr>
      <td><?php echo $show->getDate();?></td>
      <td><?php echo $show->getTime();?></td>
      <td><?php echo $show->getMovie()->getMovieName();?></td>
      <td><img class="d-block img-fluid w-154" src="<?php echo W154_IMG.$show->getMovie()->getImage();?>"></td>
    </tr>
    <?php }?>
  </tbody>
</table>
</div>
