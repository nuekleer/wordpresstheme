<?php get_header(); ?>
<div class="container pageContentContainer">
	<div id="pageTitle"><?php printf( __( '%s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?></div>
	<div id="pageContent" class="col-xs-12 col-sm-9 col-md-9 cold-lg-9">
		<?php 
          global $wp_query;
$args = array_merge( $wp_query->query_vars, array( 'post_type' => 'product', 'showposts' => '20' ) );
query_posts( $args );
	?>	
		<?php if ( have_posts() ) : ?>

		<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();
					    $thumbUrl = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full');
						?>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="padding-bottom:15px;">
						<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbUrl[0];?>" style="width:100%;height:auto;border:5px solid #1F1F1F"/></a>
						<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
						</div>
						<?php 

					endwhile;
					// Previous/next post navigation.
					//twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					echo 'No results found. ';

				endif;
			?>
			<div class="nextPrevLinksContainer">
				<div class="prevLink"><?php previous_posts_link( 'Previous' ); ?></div>
				<div class="nextLink"><?php next_posts_link( 'Next' ); ?></div>
			</div>
			
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>