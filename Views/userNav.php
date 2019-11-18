
<?php  ?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH . "/generalStyles.css" ?>">
  <link rel="stylesheet" href="<?php echo CSS_PATH . "/movieListStyle.css" ?>" type="text/css">
  <script>
    $('#myModal').on('shown.bs.modal', function() {
      $('#myInput').trigger('focus')
    })
  </script>
</head>

<body>
  <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
    <div class="container"> <a class="navbar-brand" href="<?php echo FRONT_ROOT ?>Home/Index">
        <i class="fa d-inline fa-lg fa-stop-circle"></i>
        <b>MoviePass</b>
      </a> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar10">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar10">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Show/ShowListingView">Movie Listing</a> </li>
          <?php if (isset($_SESSION["loggedUser"])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowProfileView">Perfil</a>
            </li>
          <?php endif; ?>
          <ul>
            <div class="btn-group">
              <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Menu</button>
              <div class="dropdown-menu">
                <?php if (!isset($_SESSION["loggedUser"])) : ?>
                  <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/ShowNewUserFormView">Sign In</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/ShowLoginFormView">Log in</a>
                <?php else : ?>
                  <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/LogOut">Log out</a>
                <?php endif; ?>
              </div>
            </div>
          </ul>
      </div>
    </div>
  </nav>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>