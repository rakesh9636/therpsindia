<section>
  <div class="slider_bx">
    <div class="cms_title">
      <h1>View Vehicles</h1>
      <span>View All School's Vehicles Here</span> </div>
  </div>
</section>
<section>
  <div class="container">
    <h2 class="title_h2">View Vehicles</h2>
    <div class="faq_bx">
      <div class="col-md-12 panel">
        <div align="right" style="margin-bottom:15px;">
          <a href="<?= base_url('admin/add_vehicle'); ?>" class="btn btn-info">Add Vehicle</a>
        </div>
        <div>
        <table class="table table-striped table-bordered table-hover table-responsive" style="border-top:1px solid #ddd;">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Vehicle Model</th>
              <th>Reg. No.</th>
              <th>Nickname</th>
              <th>Driver</th>
              <th>Root</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($vehicle as $vehicle): ?>
            <tr>
              <td><?= @++$count; ?></td>
              <td><?= $vehicle->model; ?></td>
              <td><?= $vehicle->reg_no; ?></td>
              <td><?= $vehicle->name; ?></td>
              <td>
              <?php $v_id = $vehicle->vehicle_id;
                $driver = $this->admin_m->get_driver($v_id);
                if($driver)
                {
                  echo $driver[0]->name;
                }
                else
                {
                  echo "No Driver";
                }
                
               ?>
              </td>
              <td>
              <?php $rl_id = $vehicle->rl_id;
                    $route = $this->admin_m->get_rl_id($rl_id);
                    echo $route[0]->rl_name;
               ?>
              </td>
              <td>
                <a href="vehicle_details.html" class="text-success" title="View" target="_blank" style="margin-right:10px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="edit_vehicle.html" class="text-info" title="Edit" style="margin-right:10px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a href="" class="text-danger" title="Delete" style="margin-right:10px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>

          </tbody>
        </table></div>
      </div>
    </div>
  </div>
</section>