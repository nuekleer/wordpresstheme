<?php get_header(); ?>
<div class="container pageContentContainer">
	<div id="pageTitle"><?php wp_title(''); ?></div>
	<div id="pageContent">
		<?php
			global $wp_query;
			if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile;
			endif; ?>
	</div>
</div>
<?php get_footer(); ?>