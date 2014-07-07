<?php get_header(); ?>
<div class="container pageContentContainer">
	<div id="pageTitle"><?php wp_title(''); ?></div>
	<div id="pageContent" class="col-xs-12 col-sm-9 col-md-9 cold-lg-9">
		<?php
			global $wp_query;
			if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php the_content(); ?>
				<div class="nextPrevLinksContainer">
					<div class="prevLink"><?php previous_post_link();?></div>
					<div class="nextLink"><?php next_post_link();?></div>
				</div>
			<?php endwhile;
			endif; ?>
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>