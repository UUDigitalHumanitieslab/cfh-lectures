<?php
/**
 * The template for displaying the page with the slug "events".
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); ?> 

<div class="keywords clearfix">
	<?php wp_tag_cloud(array('taxonomy' => 'event', 'smallest' => 12, 'largest' => 12, 'format' => 'list')); ?>
</div>

<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();
