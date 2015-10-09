<?php if(is_active_sidebar( 'colofon' )) : ?>

			<footer id="colophon" class="footer hidden-print" role="contentinfo">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<?php dynamic_sidebar( 'colofon' ); ?>
						</div>
					</div>	
				</div>	
			</footer>

		<?php else : ?>
			
			<footer id="colophon" class="footer hidden-print" role="contentinfo">

				<div id="inner-footer" class="container clearfix">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<img alt="<?php _e('Logo Utrecht University', 'uu2014'); ?>" src="<?php echo get_template_directory_uri() ?>/images/uu-logo-footer.svg">
							<!-- <nav role="navigation">
								<?php uu2014_footer_nav(); ?>
							</nav> -->
						</div>
						<div class="col-md-4 col-sm-6">
							<a href="http://digitalhumanities.wp.hum.uu.nl/" target="_blank">
								<img id="dhlab_image" class="aligncenter" alt="Digital Humanities Lab" src="http://cfh-lectures.wp.hum.uu.nl/files/2015/08/dhlab.jpg">
							</a>
						</div>
						<div class="col-md-4 col-sm-6">
							<p class="source-org copyright pull-right">
								&copy; <?php echo date('Y'); ?> 
								<a href="http://digitalhumanities.wp.hum.uu.nl/" target="_blank">Digital Humanities Lab</a><br/>
								Universiteit Utrecht, <a href="
								<?php $mylocale = get_bloginfo('language');
										if($mylocale == 'en-US') {
										echo 'http://www.uu.nl/en/organisation/contact/disclaimer';
										} else {
										echo 'http://www.uu.nl/organisatie/contact/disclaimer';
										} ?>"><?php _e('disclaimer', 'uu2014'); ?></a></p>
						</div>
					</div>
					

					

				</div>

			

		<?php endif; ?>	
