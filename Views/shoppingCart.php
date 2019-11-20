<?php require_once('VerifySessionAdmin.php'); ?>  

<?php if (empty($_SESSION["Shopping-Cart-Object"])) : ?>
  echo'<script type="text/javascript">
    alert("Empty Cart!");
    window.location.href = "http://localhost/TPFinalLaboIV/";
  </script>';
<?php else : ?>
  <div class="container-fluid px-5">
    <div class="pageHeader">
      <div class="pageHeaderTitle">
        <h2>Shopping Cart</h2>
      </div>
    </div>
    <div class="leftSection">
      <div class="leftSectionTable">
        <table class="table table-borderless table-light">
          <thead>
            <tr class="my-2 rounded bg-dark text-uppercase text-light">
              <th>Movie</th>
              <th>ShowRoom</th>
              <th>Date</th>
              <th>Time</th>
              <th>Quantity</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($showsList as $show) : ?>
              <tr>
                <td><?php echo (($show->getMovie())->getMovieName()) ?></td>
                <td><?php echo (($show->getShowRoom())->getName()) ?></td>
                <td><?php echo ($show->getDate()) ?></td>
                <td><?php echo ($show->getTime()) ?></td>
                <td>
                  <?php echo ($_SESSION["Shopping-Cart-String"][$show->getId()]) ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
      <div class="leftSectionTable">
        <table class="table table-borderless">
          <thead>
            <tr class="my-2 rounded bg-dark text-uppercase text-light">
              <th>Payment</th>
            </tr>
          </thead>
        </table>
        <div class="leftSectionTableCard">
          <div class="row">
            <div>Card Type: </div>
          </div>
          <div class="row">
            <div class="btn-group">
              <img src="<?php echo IMG_PATH ?>visa-logo.png" alt="" class="paymentLogo">
              <input type="radio" name="payment" value="visa" checked>
              <img src="<?php echo IMG_PATH ?>mastercard-logo.png" alt="" class="paymentLogo">
              <input type="radio" name="payment" value="master">
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 py-2">
              <span>Card Number:</span>
              <input type="number" class="cardNumber" maxlength="16" required>
            </div>
            <div class="col-md-4 py-2">
              <span>Security code:</span>
              <input type="number" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 py-2">
              <span>Exp. Date: </span>
              <input type="number" required>
              <input type="number" required>
            </div>
            <div class="col-md-5">
            <form action="<?php echo FRONT_ROOT?>Purchase/Add" method="post">
              <button class="btn btn-primary">Buy</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="background:url('')">
      <img src="<?php echo IMG_PATH ?>shopping-cart.png" alt="" class="rightSectionImg">
    </div>
  </div>
<?php endif ?>