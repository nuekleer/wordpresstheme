<?php get_header(); ?>
<div class="container pageContentContainer">
	<div id="pageTitle"><?php wp_title(''); ?></div>
	<div id="pageContent" class="col-xs-12 col-sm-9 col-md-9 cold-lg-9">
		<?php
			global $wp_query;
			$ID = 0;
			if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php
				$thumbUrl = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full');
				$gallery = get_post_gallery();
				$cat = get_the_category();
				$catlist = $cat[0]->cat_ID;
				$ID = $post->ID;
				$productTitle = get_the_title();
				$exclude_id = array($ID);
				?>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-bottom:15px;">
				    <p><?php echo get_category_parents( $catlist, true, ' / ' ); ?><?php the_title();?></p>
				    <img src="<?php echo $thumbUrl[0]; ?>" style="width:100%;height:auto;" />
				    <p style="padding-top:10px;">More views</p>
				    <?php echo $gallery; ?>
				</div>
				<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" style="padding-bottom:15px;">
				    <?php the_title();?>
				    <?php
				    $content = strip_shortcode_gallery( get_the_content() );                                        
        $content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) ); 
        echo $content;?>
        
        <?php echo do_shortcode('[contactFormProduct product="'. $productTitle . '"]');?>
				</div>
				
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="padding-bottom:15px;">
				    <p>OTHER ITEMS YOU MAY LIKE</p>
				    <?php
				    //loop through categories
				    $the_query = new WP_Query( array( 'post__not_in' => $exclude_id, 'cat' => $catlist, 'post_type' => 'product', 'showposts' => '5' ) );

                    // The Loop
                    if ( $the_query->have_posts() ) {
	                while ( $the_query->have_posts() ) {
		            $the_query->the_post();
		            echo '<a href="';
		            echo the_permalink();
		            echo '"><img src="';
		            $thumbUrlOther = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full');
		            echo $thumbUrlOther[0];
		            echo '" style="width:100%;height:auto;" /></a>';
		            echo '<p><a href="';
		            echo the_permalink();
		            echo '">';
		            echo the_title();
		            echo '</a></p>';
	                }
                    } else {
	                    echo 'No other posts found';
                    }
                        /* Restore original Post Data */
                        wp_reset_postdata();
				    
				   ?> 
				    
				    
				    
                    
                    
				</div>
				<div style="clear:both;"></div>
				<div class="nextPrevLinksContainer">
					<div class="prevLink"><?php previous_post_link();?></div>
					<div class="nextLink"><?php next_post_link();?></div>
				</div>
				
				
				
			<?php endwhile;
			endif; ?>
			<?php wp_reset_postdata(); ?>
			
			
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>