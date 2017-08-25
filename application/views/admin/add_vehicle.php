<section>
  <div class="slider_bx">
    <div class="cms_title">
      <h1>Add Driver</h1>
      <span>Create New Driver Account</span> </div>
  </div>
</section>
<section>
  <div class="container">
    <h2 class="title_h2">Add a Vehicle</h2>
    <div class="faq_bx">
      <div class="col-md-12 panel">
        <form class="form-cantrol" action="<?= base_url('admin/addd_vehicle'); ?>" method="post">
          <span>Basic Information :</span><hr>
          <div class="row">
          <div class="">
            <label class="form-group col-md-2 text-right">Vehicle Name</label>
            <div class="form-group col-md-4">
              <input type="text" name="model" class="form-cantrol" title="Enter Vehicle Name" required="" style="width: 100%;">
            </div>
          </div>
          <div class="">
            <label class="form-group col-md-2 text-right">Special ID/Name</label>
            <div class="form-group col-md-4">
              <input type="text" name="name" class="form-cantrol" title="Enter Special Id/Nmae of Vehicle" style="width: 100%;">
            </div>
          </div>

          <div class="form-group">
            <label class="form-group col-md-2 text-right">Registration No.</label>
            <div class="form-group col-md-4">
              <input type="text" name="reg_no" class="form-cantrol" title="Enter Vehicle Registration No." required="" style="width: 100%;">
            </div>
          </div>
          <div class="form-group">
            <label class="form-group col-md-2 text-right">Onwer Name</label>
            <div class="form-group col-md-4">
              <input type="text" name="own_name" class="form-cantrol" title="Onwer Name" required="" style="width: 100%;">
            </div>
          </div>
          <div class="form-group">
            <label class="form-group col-md-2 text-right">Onwer Contact No.</label>
            <div class="form-group col-md-4">
              <input type="text" name="own_cont" class="form-cantrol" title="Onwer Contact No." required="" style="width: 100%;">
            </div>
          </div>
          <div class="form-group">
            <label class="form-group col-md-2 text-right">Vehicle Type</label>
            <div class="form-group col-md-4">
              <select name="type" class="form-cantrol" title="Select Vehicle Type" required="required" style="width: 100%;">
                <option value="">Select Vehicle Type</option>
                <option value="Tempo">Tempo</option>
                <option value="Bus (NonAC)">Bus (NonAC)</option>
                <option value="Bus (AC)">Bus (AC)</option>
                <option value="Mini Bus">Mini Bus</option>
                <option value="Auto">Auto</option>
              </select>
            </div>
          </div>

          <div class="col-md-12">
          <div class="form-group">
            <label class="form-group col-md-2 text-right">Route</label>
            <div class="form-group col-md-4">
              <select name="rl_id" class="form-cantrol" title="Select Vehicle Type" required="required" style="width: 100%;">
                <option value="">Select Route</option>
                <?php foreach($route as $route): ?>
                  <?php if($route->rl_name != 'School'): ?>
                  <option value="<?= $route->rl_id; ?>"><?= $route->rl_name; ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="form-group col-md-6">
              <button type="submit" class="btn read_more pull-right">Submit</button>
              <a href="view_Vehicle.html" class="btn read_more pink pull-right">Cancle</a>
            </div>
          </div>
          </div>

          </div>
          
        </form>
      </div>
    </div>
  </div>
</section>