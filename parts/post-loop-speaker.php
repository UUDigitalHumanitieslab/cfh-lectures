<article id="post-<?php the_ID(); ?>" class="row" <?php post_class('clearfix'); ?> role="article">
		
		<div class="col-sm-4 col-md-3 speaker-thumb">
			<div class="archive-thumbnail">
				<?php 
					if ( has_post_thumbnail() ) 
					{ 
						the_post_thumbnail('small', array( 'class' => 'img-responsive' )); 
					} 
					else 
					{
				?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/default-thumb.jpg" class="img-responsive" title="<?php _e('no image','uu2014'); ?>" />
				<?php } ?>
			</div>
		</div>

		<div class="col-sm-8 col-md-9 speaker-content">
			<header class="article-header">
				<h1 class="entry-header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			</header>

			<section class="entry-content clearfix">
				<?php the_excerpt(); ?>
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
