<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 
	<div class="container home-blog">

		<!-- We use the default "news" and "agenda" posts and settings for "recent videos" and "recommended" posts respectively, 
			so that settings are modifiable from the administration and stay more or less in line with the defaults. -->
		<div class="col-sm-6">
			<h2><?php if(get_field('uu_options_alternative_title_news', 'option')) { the_field('uu_options_alternative_title_news', 'option'); } else { _e('News', 'uu2014'); } ?></h2>

			<?php 
				$newsamount = get_field('uu_options_news_amount', 'option');
				$newscats = get_field('uu_options_news_frontpage_cat', 'option');
				if ($newscats) { 
					$terms = implode(', ', $newscats);	
				} else {
					$terms='';
				}
			
				$args = array(
					'post_type'	 			=> 'post',
					'pagination'    		=> true,
					'posts_per_page' 		=> $newsamount,
					'cat' 					=> $terms,
					'ignore_sticky_posts'   => false,
				);
				the_field('uu_options_alternative_title_news');
				$newsquery = new WP_Query( $args );
				if ( $newsquery->have_posts() ) {
						while ( $newsquery->have_posts() ) {
								$newsquery->the_post(); 
				
				get_template_part( 'parts/post-loop-video'); ?> 
				<hr />
			

			<?php } } else { ?>

			<?php get_template_part('includes/template','error'); // WordPress template error message ?>

			<?php } ?>
			
		</div>

		<div class="col-sm-6">
			<h2><?php if(get_field('uu_options_alternative_title_agenda', 'option')) { the_field('uu_options_alternative_title_agenda', 'option'); } else { _e('Agenda', 'uu2014'); } ?></h2>

			<div class="agenda-archive">
				<?php 

				// Show 3 random videos from the archive
				$args2 = array(
					'post_type'				=> 'post',
					'category_name' 		=> 'video',
					'posts_per_page'		=> 3,
					'orderby' 				=> 'rand',
				);

				$agenda_query = new WP_Query( $args2 );

					if ( $agenda_query->have_posts() ) : ?>

						<?php while ($agenda_query->have_posts()) : $agenda_query->the_post(); ?>

							<?php get_template_part( 'parts/post-loop-video'); ?>
							<hr />

						<?php endwhile; ?>

							

					<?php else : ?>
					<div class="no-events">
						<?php _e('No upcoming events', 'uu2014') ?>
					</div>
					<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- This part is new: three columns with links to keywords, events and speakers --> 
	<div class="container home-footer">
		<div class="col-sm-4 home-keywords">
			<h2>Keywords</h2>
			<p>
			<?php wp_tag_cloud(array('taxonomy' => 'post_tag', 'smallest' => 16, 'largest' => 30, 'number' => 25, 'order' => 'RAND', 'separator' => ' &diams; ')); ?>
			</p>
			<a href="/keywords" class="button icon alignright">View all</a>
		</div>
		<div class="col-sm-4 home-events"> 
			<h2>Events</h2>
			<p>
			<?php wp_tag_cloud(array('taxonomy' => 'event', 'smallest' => 16, 'largest' => 30, 'number' => 8, 'order' => 'RAND', 'separator' => ' &diams; ')); ?> 
			</p>
			<a href="/events" class="button icon alignright">View all</a>
		</div>
		<div class="col-sm-4 home-speakers"> 
			<h2>Speakers</h2>
			<?php 
				// Show 2 random speakers from the archive
				$args = array(
					'post_type'	 			=> 'post',
					'category_name' 		=> 'speaker',
					'posts_per_page' 		=> 2,
					'orderby' 				=> 'rand',
				);
				$q = new WP_Query( $args );
				if ( $q->have_posts() ) {
					while ( $q->have_posts() ) { 
						$q->the_post(); 
						get_template_part( 'parts/post-loop-speaker');
					}
				}
			?>
			<a href="/category/speaker" class="button icon alignright">View all</a>
		</div>
	</div>
<?php get_template_part( 'parts/page-footer-1col'); ?> 

<?php get_footer();