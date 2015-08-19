<?php
/**
 * The template for displaying Video Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); ?> 


<div class="speakers clearfix">
		<?php 
		// WP_Query arguments
		$args = array (
			'category_name'          => 'video',
			'pagination'             => true,
			'posts_per_page'         => '10',
			'order'                  => 'DESC',
			'meta_key'				 => 'date',
			'orderby' 			     => 'meta_value'
		);

		// The Query
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) : ?>

			<?php while ($query->have_posts()) : $query->the_post(); ?>

				<?php get_template_part('parts/post-loop-video'); ?> 

			<?php endwhile; ?>

				<?php get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

		<?php else : ?>
		<div class="no-speakers">
			<?php _e('No speakers available', 'uu2014') ?>
		</div>
		<?php endif; ?>
</div>


<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();