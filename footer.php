		<div class=" c-footer">

			<div class="c-footer__wrapper">

				<div class="c-footer__content">

					<a href="/" class="c-footer__logo">
						<img src="<?php echo get_template_directory_uri() ?>/dist/images/apac-logo.svg" alt="<?php echo bloginfo('name'); ?>">
					</a> <!-- .logo -->

					<div class="c-footer__nav">
						<?php wp_nav_menu(array(
								'container' => false, 
								'menu' => 'Footer Nav', 
								'theme_location' => 'footer-nav'
						)); ?>
					</div> <!-- .c-footer__nav -->	

					<div class="c-footer__info">

						<?php wp_nav_menu(array(
									'container' => false, 
									'menu' => 'Footer Info Nav', 
									'theme_location' => 'footer-info-nav'
						)); ?>

						<div class="c-footer__social">
							<?php if (get_field('so_li', 'option')) : ?>
							<a href="<?php the_field('so_li', 'option'); ?>"><i class="icon-linkedin"></i></a>
							<?php endif; ?>	
							<?php if (get_field('so_tt', 'option')) : ?>
							<a href="<?php the_field('so_tt', 'option'); ?>"><i class="icon-twitter"></i></a>
							<?php endif; ?>			
							<?php if (get_field('so_fb', 'option')) : ?>
							<a href="<?php the_field('so_fb', 'option'); ?>"><i class="icon-facebook"></i></a>
							<?php endif; ?>	
							<?php if (get_field('so_ig', 'option')) : ?>
							<a href="<?php the_field('so_ig', 'option'); ?>"><i class="icon-instagram"></i></a>
							<?php endif; ?>			
						</div> <!-- .c-footer__social -->

					</div>

					<div class="c-footer__mobile-nav">
						<?php wp_nav_menu(array(
								'container' => false, 
								'menu' => 'Footer Mobile Nav'
						)); ?>
					</div> <!-- .c-footer__nav -->	

					<div class="c-footer__copy mobile">
						<?php echo str_replace('{YEAR}', date('Y'), get_field('copyright','option')) ?>
					</div>

				</div> <!-- .c-footer__content -->


				<div class="c-footer__cta">
					
					<div class="c-footer__title h4"><?php the_field('footer_cta_title', 'option'); ?></div>
					<a href="<?php the_field('footer_cta_link', 'option'); ?>" class="btn btn-primary"><?php the_field('footer_cta_label', 'option'); ?></a>

					<div class="c-footer__copy desktop">
						<?php echo str_replace('{YEAR}', date('Y'), get_field('copyright','option')) ?>
					</div>

				</div> <!-- .c-footer-cta -->

			</div>

		</div> <!-- .c-footer -->



		<?php wp_footer(); ?>
		</div> <!-- #main -->

	</body>
</html> 