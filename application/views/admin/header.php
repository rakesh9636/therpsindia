<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Radiance</title>

  <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/magnific-popup.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/horizontal.css">
  <link href="<?= base_url(); ?>assets/css/owl.carousel.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/css/custom.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/css/responsive.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Amatic+SC:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Dosis:400,500,600,700' rel='stylesheet' type='text/css'>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="<?= base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
  jQuery('#myModal').on('shown.bs.modal', function () {
  jQuery('#myInput').focus()
})

</script> 


    </head>
    <body>
      <header class="main_head">
        <div class="container">
          <div class="logo_area col-md-2">
            <a href=""><img src="<?= base_url(); ?>assets/images/logo.png" alt=""/></a>
          </div>
          <div class="col-md-10 "> 
            <nav class="navigation"> 
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
               </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav"> 
                   <li ><a href="<?= base_url('admin'); ?>"><i style="color: #5fcde3; font-size: 41px" class="fa fa-tachometer"></i><span>Dashboard</span> </a></li>
                  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="javascript:void(0);"><i style="color: #e7754d; font-size: 34px" class="fa fa-bell-o"></i><span>Notification</span> </a>
                    <ul class="dropdown-menu">
                      <li><a href="notification.html">VIew Notifications</a></li>
                      <li><a href="new_notification.html">Send Notification</a></li> 
                    </ul>                    
                  </li> 
                  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="javascript:void(0);"><i style="color: #6e4692; font-size: 34px" class="fa fa-bus"></i><span>Vehicle</span> </a>
                    <ul class="dropdown-menu">
                      <li><a href="<?= base_url('admin/view_vehicle'); ?>">VIew Vehicle</a></li>
                      <li><a href="<?= base_url('admin/add_vehicle'); ?>">Add Vehicle</a></li> 
                    </ul>                    
                  </li>
                  
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i style="color: #dd6b9e; font-size: 34px" class="fa fa-wheelchair"></i><span>Driver</span></a> 
                    <ul class="dropdown-menu">
                      <li><a href="view_drivers.html">View Drivers</a></li>
                      <li><a href="<?= base_url('admin/add_driver'); ?>">Add A Driver</a></li>  
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i style="font-size: 34px" class="fa fa-map-signs text-success"></i><span>Route</span></a> 
                    <ul class="dropdown-menu">
                      <li><a href="view_routes.html">View Routes</a></li>
                      <li><a href="<?= base_url('admin/add_route'); ?>">Add A Route</a></li>  
                    </ul>
                  </li>
                  
                  <li class="">
                    <a href="<?= base_url('admin/logout'); ?>"><i style="font-size: 34px" class="fa fa-unlock-alt text-warning"></i><span>Logout</span></a>
                  </li> 
                  
      </ul> 

    </div><!-- /.navbar-collapse --> 


  </nav>


</div>

</div>
</header>