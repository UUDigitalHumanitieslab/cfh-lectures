<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
		
			<section class="entry-content clearfix" itemprop="articleBody">
				
				
				

				<div class="video-display col-md-8 col-sm-12">
					<?php 
						$video = get_field('video'); 
						$embed_code = wp_oembed_get($video, array('width' => 740, 'height' => 416));
						if ($embed_code)
						{
							echo $embed_code;
						}
						else 
						{
							// We're probably dealing with a lecturenet video here...
							echo lecturenet_shortcode(array('url' => $video, 'width' => 740, 'height' => 416)); 
						}
					?>

					<div class="video-current">
					<?php
						get_template_part('parts/post-loop-video');
					?>
					</div>
					<?php the_content(); ?>

					<?php uu_sharebuttons(); ?>
				</div>

				<div class="col-md-4 col-sm-12 video-single">
					<?php if (get_field('related_videos')) { ?>
						<div class="video-related">
							<h2>Related videos</h2>
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
							<h2>External links</h2>
							<?php 
								foreach (get_field('links') as $link)
								{
									echo '<a href="' . $link['link'] . '" target="_blank" class="button icon">' . $link['description'] . '</a>';
								}
							?>
						</div>
					<?php } ?>
					<div class="video-keywords"><h2>Keywords</h2><?php the_tags(''); ?></div>
					<div class="video-events"><h2>Events</h2><?php the_terms(get_the_id(), 'event'); ?></div>
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

<?php get_template_part( 'parts/page-footer-1col'); ?> 

<?php get_footer(); ?>
