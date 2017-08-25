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
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <link rel="stylesheet" href="assets/css/horizontal.css">
  <link href="assets/css/owl.carousel.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">
  <link href="assets/css/responsive.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Amatic+SC:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Dosis:400,500,600,700' rel='stylesheet' type='text/css'>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="assets/js/jquery-1.9.1.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
  jQuery('#myModal').on('shown.bs.modal', function () {
  jQuery('#myInput').focus()
})

</script> 


    </head>
    <body style="background-image:url(assets/images/bg.jpg);">
    

<section>
  <div class="container" style="margin-top:5%;">
    <div class="faq_bx">
    <h1 class="text-center" style="font-weight:bold;color:#fff">Radiance Public School</h1>
      <div class="card card-container panel" style="max-width: 350px;background-color: #F7F7F7;padding: 40px 25px 30px;margin: 0 auto 25px;">
        <img id="profile-img" src="assets/images/logo.png" style="width:40%;margin: 0 auto 10px;display: block;">
        <p id="profile-name" class="" style="font-size: 16px;font-weight: bold;text-align: center;margin: 10px 0 0;min-height: 1em;">Login Here</p>
        <?php if($this->session->flashdata('fail')): ?>
        <p id="profile-name" class="" style="font-size: 20px;font-weight: normal;text-align: center;margin: 10px 0 0;min-height: 1em; color: red;"><?= $this->session->flashdata('fail'); ?></p>
      <?php endif; ?>

        <form method="post" action="<?= base_url('page/do_login'); ?>" roll="form">
            <span id="reauth-email" style=" display: block;color: #404040;line-height: 2;margin-bottom: 10px;font-size: 14px;text-align: center;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"></span>
            <input type="email" name="username" class="form-control" id="inputEmail" placeholder="Enter email" required="required" autofocus="" style="direction: ltr;height: 44px;font-size: 16px;width: 100%;display: block;margin-bottom: 10px;z-index: 1;position: relative;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;border-color: rgb(104, 145, 162);outline: 0;">
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required="reqired" autofocus="" style="direction: ltr;height: 44px;font-size: 16px;width: 100%;display: block;margin-bottom: 10px;z-index: 1;position: relative;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;border-color: rgb(104, 145, 162);outline: 0;">
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me" name="rememberme"> Remember me
                </label>
            </div>
            <button class="btn btn-success pull-right" type="submit">Sign in</button><br><hr>
            <a href="http://client.clumpmail.com/pwreset.php" class="text-right">Forgot the password?</a>
           
        </form><!-- /form -->
    </div><!-- /card-container -->
    </div>
  </div>
</section>

    




<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript">

jQuery('.owl-carousel').owlCarousel({
  loop:true,
  margin:30,
  nav:false,
  autoplay: true,
  responsive:{
    0:{
      items:1
    },
    600:{
      items:3
    },
    1000:{
      items:4
    }
  }
});
/* copy loaded thumbnails into carousel */
jQuery('.row .thumbnail').on('load', function() {

}).each(function(i) {
  if(this.complete) {
    var item = jQuery('<div class="item"></div>');
    var itemDiv = jQuery(this).parents('div');
    var title = jQuery(this).parent('a').attr("title");
    
    item.attr("title",title);
    jQuery(itemDiv.html()).appendTo(item);
    item.appendTo('.carousel-inner'); 
    if (i==0){ // set first item active
     item.addClass('active');
   }
 }
});

/* activate the carousel */
jQuery('#modalCarousel').carousel({interval:false});

/* change modal title when slide changes */
jQuery('#modalCarousel').on('slid.bs.carousel', function () {
  jQuery('.modal-title').html(jQuery(this).find('.active').attr("title"));
})

/* when clicking a thumbnail */
$('.row .thumbnail').click(function(){
  var idx = jQuery(this).parents('div').index();
  var id = parseInt(idx);
    jQuery('#myModal').modal('show'); // show the modal
   jQuery('#modalCarousel').carousel(id); // slide carousel to selected

 });
</script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/sly.js"></script>
<script src="assets/js/horizontal.js"></script>
<script type="text/javascript" src="assets/js/jssor.core.js"></script>
<script type="text/javascript" src="assets/js/jssor.utils.js"></script>
<script type="text/javascript" src="assets/js/jssor.slider.js"></script>

</body>
</html>