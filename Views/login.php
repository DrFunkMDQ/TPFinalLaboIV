<?php include('adminNav.php')?>

  <div class="py-5 bg-dark text-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form class=" col-md-8" mehtod="POST" action="<?php echo FRONT_ROOT?>User/UserLogin">
            <div class="form-group"> <label>Email address</label> <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required="required"> <small class="form-text text-muted">We'll never share your email with anyone else.</small> </div>
            <div class="form-group"> <label>Password</label> <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required"> </div>            
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>