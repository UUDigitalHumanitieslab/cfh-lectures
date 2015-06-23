<?php
/**
 * The template for displaying Speaker Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); ?> 

<div class="speakers clearfix">

	<div class="speaker-navigation">
		<?php 
		// Retrieve current character from GET parameters
		$current_character = isset($_GET["character"]) ? $_GET["character"] : 'A'; 

		foreach (range('A', 'Z') as $letter ) 
		{
			if ($letter == $current_character) 
			{
				echo '<span class="current-character">' . $letter . '</span> ';
			}
			else 
			{
				echo '<a href="/category/speaker/?character=' . $letter . '">' . $letter . '</a> ';
			}
		} 
		?>
	</div>

	<?php 
	
	// Find posts with category speaker that have a last_name starting with $current_character; and order by the last name
	// TODO: pagination?
	$args = array(
		'post_type'			=> 'post',
		'category_name'		=> 'speaker',
		'orderby'			=> 'title',
		'order'				=> 'ASC',
		'meta_query'		=> array(
			array( 
				'key'		=> 'last_name', 
				'value'		=> '^' . $current_character, 
				'compare'	=> 'REGEXP', 
			)
		)
	);

	// The Query
	$query = new WP_Query($args);
	if ($query->have_posts()) : ?>

		<?php while ($query->have_posts()) : $query->the_post(); ?>

			<?php get_template_part('parts/post-loop-speaker'); ?> 

		<?php endwhile; ?>

		<?php get_template_part('includes/template', 'pager'); //wordpress template pager/pagination ?>

	<?php else :  ?>
	<div class="no-speakers">
		<?php _e('No speakers available', 'uu2014') ?>
	</div>
	<?php endif; ?> 
</div>


<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();