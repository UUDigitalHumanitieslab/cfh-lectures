<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
		
			<section class="entry-content clearfix" itemprop="articleBody">
				<div class="video-display">
					<?php 
						$video = get_field('video'); 
						$embed_code = wp_oembed_get($video);
						if ($embed_code) 
						{
							echo $embed_code;
						}
						else 
						{
							// We're probably dealing with a lecturenet video here...
							echo lecturenet_shortcode(array('url' => $video)); 
						}
					?>
				</div>
				<div class="col-sm-6 video-single">
					<div class="video-current">
					<?php
						echo get_template_part('parts/post-loop-video');
					?>
					</div>
					<?php if (get_field('related_videos')) { ?>
						<div class="video-related">
							<h5>Related videos</h5>
							<?php 
								$current = $post; // Save current post TODO: is there a better way?
								foreach (get_field('related_videos') as $post)
								{
									get_template_part('parts/post-loop-video');
								}
								$post = $current;
							?>
						</div>
					<?php } ?>
					<?php if (get_field('links')) { ?>
						<div class="video-external-links">
							<h5>External links</h5>
							<?php 
								foreach (get_field('links') as $link)
								{
									echo '<a href="' . $link['link'] . '" target="_blank" class="button icon">' . $link['description'] . '</a>';
								}
							?>
						</div>
					<?php } ?>
					<div class="video-keywords"><h5>Keywords</h5><?php the_tags(''); ?></div>
					<div class="video-events"><h5>Events</h5><?php the_terms(get_the_id(), 'event'); ?></div>
				</div>
				<div class="col-sm-6">
					<?php the_content(); ?>

					<?php uu_sharebuttons(); ?>
				</div>
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
