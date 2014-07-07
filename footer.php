<?php
/**
 * The template for displaying the footer
 */
?>
<div class="container">
	<div class="row">
  		<div class="col-sm-9 col-md-9 col-lg-9">
  			<div class="row">
  				<div class="col-lg-9 footerNav"><?php $footer_text = get_option('demanes_options'); echo $footer_text['footer_text']; ?></div>
  			</div>
  			<div class="row">
  				<div class="col-lg-9 footerNav">
  					<nav class="navbar navbar-default footerNav hidden-xs hidden-sm" role="navigation"> 
<!-- Brand and toggle get grouped for better mobile display --> 
  <div class="navbar-header"> 
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> 
      <span class="sr-only">Toggle navigation</span> 
      <span class="icon-bar"></span> 
      <span class="icon-bar"></span> 
      <span class="icon-bar"></span> 
    </button> 
    <!-- <a class="navbar-brand" href="javascript:void(0);">Menu</a> -->
  </div> 
  <!-- Collect the nav links, forms, and other content for toggling --> 
  <div class="collapse footerNav navbar-collapse navbar-ex1-collapse"> 
    <?php /* Primary navigation */
wp_nav_menu( array(
  'menu' => 'secondary',
  'depth' => 0,
  'container' => false,
  'menu_class' => 'nav navbar-nav footerNav',
  //Process nav menu using our custom nav walker
  'walker' => new wp_bootstrap_navwalker())
);
?>
  </div>
</nav>
  				</div>
  			</div>
  		</div>
  		<div id="footerWebLogo" class="col-sm-3 col-md-3 col-lg-3"><a href="http://www.webdesign309.com"><img src="wp-content/themes/demanes/images/webdesignbylogo.png" /></a></div>
  	</div>
</div>
</div> <!-- close wrapper -->
    <?php if(is_front_page()){?>
    <script>
    var staticHeight = 0;
            
        jQuery( document ).ready(function() {
        setTimeout(function(){
        if ($('.active').length > 0) { 
            staticHeight = $('.active').height();
            //alert(staticHeight);
            staticHeight = staticHeight/2;
            staticHeight = staticHeight - 155;
            $('#redButtons').css('margin-top', staticHeight + 'px');
            clearTimeout();
        }
        
        }
        , 200);
        
            
            
            $('#myCarousel').on('slid.bs.carousel', function() {
                var staticHeight = 0;
                staticHeight = $('.active').height();
                staticHeight = staticHeight/2;
                staticHeight = staticHeight - 155;
                //alert(staticHeight);
                $('#redButtons').css('margin-top', staticHeight + 'px');
            });
    
        });
    </script>
    <?php } ?>
	<?php wp_footer(); ?>
</body>
</html>