<?php get_header(); ?>
<div class="container homeCenter">
<div class="container" style="position:absolute;z-index:1;">
	<div id="redButtons" class="row" style="padding-left:15px;padding-right:15px;">    
		    <div class="hidden-xs" style="float:left;"><div id="homeLeftCircle"><a href="<?php $left_button_url = get_option('demanes_options'); echo $left_button_url['home_page_button_left_url']; ?>"><?php $left_button_text = get_option('demanes_options'); echo $left_button_text['home_page_button_left_text']; ?></a></div></div>
		    
		    <div class="hidden-xs" style="float:right;margin-right:-45px;"><div id="homeRightCirle"><a href="<?php $right_button_url = get_option('demanes_options'); echo $right_button_url['home_page_button_right_url']; ?>"><?php $right_button_text = get_option('demanes_options'); echo $right_button_text['home_page_button_right_text']; ?></a></div></div>
		</div>
	    </div>
		    
		    <?php 
          $the_query = new WP_Query(  
      array(
        'post_type' => 'slider'
      ) 
    );
    if($the_query->have_posts() ){
      $uniqueIdent = get_the_id();
      echo '<div id="myCarousel" class="carousel slide" style="height:auto;margin-left:-15px;margin-right:-15px" data-ride="carousel">';
      echo '<div class="carousel-inner">';      
      $numPosts = 0;
      while ( $the_query->have_posts() ) :
        $the_query->the_post();
          
          if(has_post_thumbnail()){
            $thumbUrl = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full');
            $height = $thumbUrl[2];
            $width = $thumbUrl[1];
            //echo $thumbUrl[0];
            echo '<div id ="slider_'. $post->ID . '" class="container-fluid item '. ($numPosts == 0 ? "active" : "").'" > ';
            echo '<img src="';
            echo $thumbUrl[0];
            echo '" style="width:' . $width . 'px; height: auto;margin:auto;" />';
            echo '</div>';
          $numPosts++;
        }
      endwhile;
      echo '</div>';//end inner
      echo '</div>';//end outer 
    }	 
		 ?>   
		    
	
</div>
<div class="container">
	<div class="row widgetBox">
		<div>
		<?php if ( is_active_sidebar( 'homepage-sidebar' ) )?>
		<?php dynamic_sidebar( 'homepage-sidebar' ); ?>
	</div>
</div>
<?php get_footer(); ?>