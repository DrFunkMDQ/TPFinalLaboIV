  <div class="py-1 bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4 shadow-none bg-dark text-white">New Cinema</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-2 bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-12 bg-dark text-white">
          <form id="c_form-h" class="" style="" mehtod="POST" action="<?php echo FRONT_ROOT?>Cinema/AddCinema">
            <div class="form-group row"> <label for="" class="col-2 col-form-label">Name<br></label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required"> </div>
              </div>
            <div class="form-group row"> <label for="" class="col-2 col-form-label">Address<br></label>
              <div class="col-10">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required="required"> </div>
              </div>
            <div class="form-group row"> <label for="" class="col-2 col-form-label">Capacity<br></label>
              <div class="col-10">
                <input type="number" class="form-control" id="" name="capacity" placeholder="Capacity" min="1"> </div>
              </div>
            <div class="form-group row"> <label for="" class="col-2 col-form-label">Ticket Price<br></label>
            <button type="submit" class="btn btn-light">New Cinema</button>
          </form>
        </div>
      </div>
    </div>
  </div>
