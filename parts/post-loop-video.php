<article id="post-<?php the_ID(); ?>" class="row" <?php post_class('clearfix'); ?> role="article">
		
		<div class="col-sm-4 col-md-3 video-thumb">
			<div class="archive-thumbnail">
				<?php
					// Retrieve the first speaker and show the thumbnail
					$speaker = get_field('speakers')[0]; 
					echo get_the_post_thumbnail($speaker->ID, 'uu-thumbnail', array('class' => 'img-responsive')); 
				?>
			</div>
		</div>

		<div class="col-sm-8 col-md-9 video-content">
			<header class="article-header">
				<div class="video-date">
				<?php 
					$date = DateTime::createFromFormat('d/m/Y', get_field('date'));
					echo $date->format(get_option('date_format'));
				?>
				</div>
				<h4><?php the_title(); ?></h4>
				<div class="video-speaker">
				<?php 
					foreach (get_field('speakers') as $speaker)
					{
						echo '<a href="' . get_the_permalink($speaker) . '">' . get_the_title($speaker) . '</a>';
						echo '<br>';
					}
				?>
				</div>
			</header>

			<section class="entry-content clearfix">
				<div class="video-description"><!-- TODO --></div>
				<a class="button icon alignleft" href="<?php echo get_the_permalink(); ?>">Watch video</a>
				<?php wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'uu2014' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) ); ?>
			</section>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>
		</div>
</article>
