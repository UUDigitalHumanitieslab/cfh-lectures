<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">		
			<section class="entry-content clearfix" itemprop="articleBody">
				<div class="speaker-thumbnail">
				<?php 
					if ( has_post_thumbnail() ) 
					{
						the_post_thumbnail('medium', array( 'class' => 'img-responsive alignleft' )); 
					} 
				?>
				</div>
				<h1>
					<?php the_title(); ?>
					<a class="button icon alignright" href="<?php echo get_field('link'); ?>" target="_blank">Website</a>
				</h1>
				<?php the_content(); ?>

				<?php uu_sharebuttons(); ?>

				<?php wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'uu2014' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) ); ?>
				
				<h2>Videos</h2>
				<?php
				// Hack to find videos for a speaker, found on http://support.advancedcustomfields.com/forums/topic/meta-query-for-post-object/
				$args = array (
					'category_name'     => 'video',
					'meta_query'        => array(
						array(
							'key'       => 'speakers',
							'value'     => '"' . get_the_ID() . '"',
							'compare'   => 'LIKE',
						),
					),
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) : ?>

					<?php while ($query->have_posts()) : $query->the_post(); ?>

						<?php get_template_part( 'parts/post-loop-video'); ?> 

					<?php endwhile; ?>

						<?php get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

				<?php else : ?>
				<div class="no-videos">
					<?php _e('No videos available', 'uu2014') ?>
				</div>
				<?php endif; ?>
			</section><?php // end article section ?>

			<footer class="article-footer">

			</footer><?php // end article footer ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		</article><?php // end article ?>
	
	<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('includes/template','error'); // WordPress template error message ?>

	<?php endif; ?>

<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer(); ?>
