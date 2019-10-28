<?php include('adminNav.php')?>

  <div class="py-5 bg-dark text-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form class=" col-md-8">
            <div class="form-group"> <label>Email address</label> <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required="required"> <small class="form-text text-muted">We'll never share your email with anyone else.</small> </div>
            <div class="form-group"> <label>Password</label> <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required"> </div>
            <div class="form-group"> <label>Confirm&nbsp;Password</label> <input type="password" class="form-control" name="password_verification" id="password_verification" placeholder="Password" required="required"> </div>
            <div class="form-group"> <label>First Name<br></label> <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" required="required"> </div>
            <div class="form-group"> <label>Last Name<br></label> <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required="required"> </div>
            <div class="form-group"> <label>Birthday<br></label> <input type="date" class="form-control col-md-3" name="birthday" id="birthday" required="required"> </div> <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
