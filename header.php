<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(' | '); ?></title>

		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/apple-touch-icon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicon.ico">
		<![endif]-->
		<?php wp_head(); ?>
	
	</head>

	<?php 
		$classes = [];
		$classes[] = sanitize_title('page-' . get_the_title());
		$classes[] = get_field('site_enabled', 'option') ? 'has-notice' : 'no-notice';

		// Check if it has page hero
		$foundHero = false;
		if (!is_front_page() && is_home()) {
		} else {
			$blocks = parse_blocks( get_the_content() );
			foreach ( $blocks as $block ) {
				if ( 'acf/programs' == $block['blockName'] || 'acf/page-intro' == $block['blockName'] || 'acf/page-hero' == $block['blockName'] || 'acf/home-hero' == $block['blockName'] ) $foundHero = true;
			}	
			$classes[]  = $foundHero ? 'has-hero' : 'no-hero';
		}

	?>
	<body <?php body_class(implode(' ', $classes)); ?> itemscope itemtype="http://schema.org/WebPage">

	<div id="main">

		<div class="c-header-placeholder"></div>
		<div class="c-header">

				<?php if (get_field('site_enabled', 'option')) : ?>
				<div class="c-topbar">
					<div class="c-topbar__wrapper">
						<div class="c-topbar__notice">
							<i class="icon-info"></i> <?php the_field('site_text', 'option'); ?>
							<?php if (get_field('site_button_link', 'option')) : ?>
							<a href="<?php the_field('site_button_link', 'option'); ?>"><?php the_field('site_button_label', 'option'); ?></a>
							<?php endif; ?>
						</div>
					</div>				
				</div> <!-- .c-topbar -->
				<?php endif; ?>	

				<div class="c-nav-desktop">

					<a href="/" class="c-header__logo">
						<img class="v" src="<?php echo get_template_directory_uri() ?>/dist/images/apac-logo.svg" alt="<?php echo bloginfo('name'); ?>">
					</a> <!-- .logo -->

					<a class="c-nav-desktop__menu-toggle">
						<span class="bar t"></span>
						<span class="bar m"></span>
						<span class="bar b"></span>
					</a>

					<a href="#" class="c-nav-desktop__search js-search">
						Search
					</a>

					<div class="c-nav-desktop__menu">
						
						<?php wp_nav_menu(array(
									'container' => false, 
									'menu' => 'Main nav', 
									'menu_class' => 'c-nav__menu', 
									'theme_location' => 'main-nav',
									'walker' => new Walker_Mega_Menu()
						)); ?>

						<div class="c-nav-mobile">

							<div class="c-nav-mobile__nav-wrapper">
								<?php wp_nav_menu(array(
									'container' => false, 
									'menu' => 'Mobile Sub Nav', 
									'menu_class' => 'c-nav-mobile__nav', 
								)); ?>
							</div>
							
							<div class="c-nav-mobile__social">
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
							</div>
						</div>

					</div> <!-- .c-nav-desktop__menu -->

					<div class="c-nav-desktop__buttons">
							<a href="#" class="btn btn-search js-search">
								<i class="icon-search">
									<svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M13.5896 10.9797L17.5896 13.6552" stroke="#00D3B0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke/>
									<path fill-rule="evenodd" clip-rule="evenodd" d="M8.19789 14.1723C11.7847 13.8585 14.4204 10.7174 14.1066 7.13057C13.7928 3.54378 10.6517 0.908014 7.06487 1.22182C3.47808 1.53562 0.845086 4.70855 1.15611 8.2636C1.46992 11.8504 4.6111 14.4862 8.19789 14.1723Z" stroke="#00D3B0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</i>
								Search
							</a>
					</div>

				</div> <!-- .c-nav -->

	</div> <!-- .c-header -->


	<div class="c-search">
		<div class="c-search__close js-search-close">Close 
		<svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle opacity=".1" cx="16.25" cy="16" r="16" fill="#003D35"/><path d="M22.9874 9.26318L9.51367 22.7369M9.51367 9.26313L22.9874 22.7368" stroke="#003D35" stroke-width="2"/></svg>
		</div>

		<div class="container-fluid">
			<div class="c-search-form u-mb-64">
				<form action="/">
						<div class="c-search-form__row">
							<input type="text" name="s" placeholder="Search for a topic or keyword..." required>
							<button class="btn btn-primary">Search</button>
						</div>
				</form>
			</div>
			<div class="c-topics">
				<div class="c-topics__title h5"><?php the_field('search_title', 'option'); ?></div>
				<div class="c-topics__list">
				<?php if ( have_rows('search_topics', 'option') ) : ?>
				
					<?php while( have_rows('search_topics', 'option') ) : the_row(); ?>
				
				
					<a href="<?php the_sub_field('page'); ?>" class="btn btn-secondary"><?php the_sub_field('label'); ?></a>
						
				
					<?php endwhile; ?>
				
				<?php endif; ?>
				</div>
			</div>
		</div>
	</div> <!-- .c-search -->