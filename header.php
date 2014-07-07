<?php
/**
*Header file that creates the container and base of layout 
 */
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
       <?php
        if (is_home()) {
          bloginfo('name'); echo ' - '; bloginfo('description'); 
        }
        else{
          bloginfo('name'); echo ' - '; wp_title(''); 
        }
       ?>
  </title>

    <!-- Bootstrap --

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
  </head>
  <body>
  	<div class="wrapper">
  		<div class="container">
  			<div id="headerRow" class="row">
  				<div class="col-sm-4 col-md-4 col-lg-4 demanesLogo"><a href="<?php echo home_url(); ?>"><img src="wp-content/themes/demanes/images/logo_-_Copy.jpg" /></a></div>
  				<div id="servingCustomers" class="col-sm-4 col-md-4 col-lg-4"><img src="wp-content/themes/demanes/images/Serving-Customers-Since-1919.png" /></div>
  				<div class="col-sm-4 col-md-4 col-lg-4 demanesSocial">
            <div id="headerSocialRow" class="row">
              <a href="<?php $social_pinterest = get_option('demanes_options'); echo $social_pinterest['social_pinterest_url'];?>"><img src="wp-content/themes/demanes/images/pintrest.png" /></a>
              <a class="centerSocial" href="<?php $social_facebook = get_option('demanes_options'); echo $social_facebook['social_facebook_url'];?>"><img src="wp-content/themes/demanes/images/facebook.png" /></a>
              <a href="<?php $social_h = get_option('demanes_options'); echo $social_h['social_houzz_url'];?>"><img src="wp-content/themes/demanes/images/houzz.png" /></a>
            </div>
            <div id="phoneContainer">
              <div id="phoneIcon"><img src="wp-content/themes/demanes/images/phone.png" /></div>
              <div id="phoneTextContainer">
                <div id="callUs"><?php $phone_text = get_option('demanes_options'); echo $phone_text['phone_text'];?></div>
                <div id="phoneNumber"><?php $phone_number = get_option('demanes_options'); echo $phone_number['phone_number'];?></div>
              </div>
            </div>
  			</div>
  		</div>
    </div>
    
    <div class="container-fluid" style="padding:0;">
      <nav class="navbar navbar-default" role="navigation"> 
<!-- Brand and toggle get grouped for better mobile display --> 
  <div class="navbar-header hidden-sm hidden-md hidden-lg"> 
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> 
      <span class="sr-only">Toggle navigation</span> 
      <span class="icon-bar"></span> 
      <span class="icon-bar"></span> 
      <span class="icon-bar"></span> 
    </button> 
    <a class="navbar-brand " href="javascript:void(0);">Menu</a>
  </div> 
  <!-- Collect the nav links, forms, and other content for toggling --> 
  <div class="collapse navbar-collapse navbar-ex1-collapse"> 
    <?php /* Primary navigation */
wp_nav_menu( array(
  'menu' => 'primary',
  'depth' => 0,
  'container' => false,
  'menu_class' => 'nav nav-justified',
  //Process nav menu using our custom nav walker
  'walker' => new wp_bootstrap_navwalker())
);
?>
  </div>
</nav>
   </div>

   <div class="container">

 