<?php
/**
 * The template for displaying Tag pages.
 * Since all tags are on videos, we can link to the video post loop here.
 */

get_header(); ?>

<?php get_template_part('parts/page-header-2col'); ?> 

	<?php if ( have_posts() ) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part('parts/post-loop-video'); ?> 

		<?php endwhile; ?>

			<?php get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

	<?php else : ?>

		<?php get_template_part('includes/template','error'); //wordpress template error message ?>

	<?php endif; ?>

<?php get_template_part('parts/page-footer-2col'); ?> 

<?php get_footer();