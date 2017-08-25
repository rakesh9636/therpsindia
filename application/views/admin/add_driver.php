<section>
  <div class="slider_bx">
    <div class="cms_title">
      <h1>Add Driver</h1>
      <span>Create New Driver Account</span> </div>
  </div>
</section>
<section>
  <div class="container">
    <h2 class="title_h2">Add a Driver </h2>
    <div class="faq_bx">
      <div class="col-md-12 panel">
        <form class="form-cantrol" action="<?= base_url('admin/addd_driver'); ?>" method="post">
          <span>Personal Information :</span><hr>
          <div class="form-group">
            <label class="form-group col-md-2 text-right"> Driver Name</label>
            <div class="form-group col-md-4">
              <input type="text" name="name" class="form-cantrol" title="Enter Driver Name" required="" style="width: 100%;">
            </div>
          </div>
          <div class="form-group">
            <label class="form-group col-md-2 text-right">Father's Name</label>
            <div class="form-group col-md-4">
              <input type="text" name="f_name" class="form-cantrol" title="Enter Father's Name" required="" style="width: 100%;">
            </div>
          </div>

          <div class="form-group">
            <label class="form-group col-md-2 text-right">Driving Exprience</label>
            <div class="form-group col-md-4">
              <input type="text" name="exprience" class="form-cantrol" title="Enter Total Driving Exprience" required="" style="width: 100%;">
            </div>
          </div>
          <div class="form-group">
            <label class="form-group col-md-2 text-right">Worked Before:</label>
            <div class="form-group col-md-4">
              <input type="text" name="last" class="form-cantrol" title="if Worked Before, Please Enter Information" style="width: 100%;">
            </div>
          </div>

          <span>Contact Information :</span><hr>
          <div class="form-group">
            <label class="form-group col-md-2 text-right">Address</label>
            <div class="form-group col-md-10">
              <textarea name="address" class="form-cantrol" title="Enter House No./Village etc." required="" style="width: 100%;height:100px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="form-group col-md-2 text-right">Mobile No.</label>
            <div class="form-group col-md-4">
              <input type="text" name="m_no" class="form-cantrol" title="Enter Mobile No. Here" required="" style="width: 100%;">
            </div>
          </div>
          <div class="form-group">
            <label class="form-group col-md-2 text-right">Alternet No.</label>
            <div class="form-group col-md-4">
              <input type="text" name="alt_no" class="form-cantrol" title="Enter Alternet Contact No. here" style="width: 100%;">
            </div>
          </div>
          
          <span>Vehicle Information :</span><hr>
          <div class="form-group">
            <label class="form-group col-md-2 text-right">Vehicle</label>
            <div class="form-group col-md-4">
              <select class="form-cantrol" name="vehicle_id" required title="Select Vehicle" required="" style="width:100%;">
                <option value="">Select Vehicle</option>
                <?php foreach($vehicle as $vehicle): ?>
                <option value="<?= $vehicle->vehicle_id; ?>"><?= $vehicle->reg_no; ?></option>
              <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            
            <div class="form-group col-md-6">
              <button type="submit" class="btn read_more pull-right">Submit</button>
              <a href="" class="btn read_more pink pull-right">Cancle</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>