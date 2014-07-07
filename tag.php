<?php get_header(); ?>
<div class="container pageContentContainer">
	<div id="pageTitle"><?php printf( __( 'Tag Archives: %s', 'twentyfourteen' ), single_tag_title( '', false ) ); ?></div>
	<div id="pageContent" class="col-xs-12 col-sm-9 col-md-9 cold-lg-9">
		<?php if ( have_posts() ) : ?>

		<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();
						?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php the_excerpt(); ?>
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