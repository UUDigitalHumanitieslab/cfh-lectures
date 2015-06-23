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

				$today = date('Ymd');
				$agenda_amount = get_field('uu_options_agenda_amount', 'option');
				$args2 = array(
					'post_type'				=> 'post',
					'category_name' 		=> 'video',
					'posts_per_page'		=> $agenda_amount,
					'post__in'  			=> get_option( 'sticky_posts' ),
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
			<?php wp_tag_cloud(array('taxonomy' => 'post_tag')); ?> 
			<a href="/keywords" class="button icon alignright">View all</a>
		</div>
		<div class="col-sm-4 home-events"> 
			<h2>Events</h2>
			<?php wp_tag_cloud(array('taxonomy' => 'event')); ?> 
			<a href="/events" class="button icon alignright">View all</a>
		</div>
		<div class="col-sm-4 home-speakers"> 
			<h2>Speakers</h2>
			TODO: wat tonen we hier? 
			<a href="/category/speaker" class="button icon alignright">View all</a>
		</div>
	</div>
<?php get_template_part( 'parts/page-footer-1col'); ?> 

<?php get_footer();