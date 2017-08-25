<footer style="position:relative;right: 0;bottom: 0;left: 0;padding: 2rem;margin-top:50px;">
  <h6 class="text-center" style="margin:0;">All Rights Reservied @ Radiance Public School</h6>
</footer>
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