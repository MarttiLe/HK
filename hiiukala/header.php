<!doctype html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Site meta -->
		<?php // Title gets automatically loaded by wp_head(); ?>
		<meta name="Keywords" content="Hiiu, kala, Hiiukala, MTÜ">

		<!-- Mobile meta -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- Favicons and themes -->
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() . '/assets/favicons/apple-touch-icon.png'; ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() . '/assets/favicons/favicon-32x32.png'; ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() . '/assets/favicons/favicon-16x16.png'; ?>">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#008bd0">
		<meta name="theme-color" content="#ffffff">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php /*
		<!-- Facebook meta -->
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php echo get_bloginfo('name') . ' | ' . get_bloginfo('description'); ?>" />
		<meta property="og:image" content="<?php echo get_template_directory_uri() . '/assets/images/og-image.png'; ?>" />

		<!-- Twitter meta -->
		<meta name="twitter:title" content="<?php echo get_bloginfo('name') . ' | ' . get_bloginfo('description'); ?>" />
		<meta name="twitter:image:src" content="<?php echo get_template_directory_uri() . '/assets/images/og-image.png'; ?>" />
		*/ ?>

		<?php if ( function_exists('cn_cookies_accepted') && cn_cookies_accepted() ) : ?>
		<!-- Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA‌-XXXXXXXXX-X"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA‌-XXXXXXXXX-X');
		</script> 
		<?php endif; ?>

		<!-- WordPress head -->
		<?php wp_head(); ?>
	</head>


	<?php
		$socials_data = get_field('socials', 'options');
	?>


	<body <?php body_class(); ?>>

		<!-- Site header -->
		<header class="header">

			<div class="header__top top-bar">
				<div class="container">
					<div class="top-bar__inner">
						<nav class="top-bar__languages language-nav">
							<?php //echo theme_language_switcher(); ?>
							<?php
								wp_nav_menu([
									'menu' => __( 'Languages navigation', 'hiiukala-theme' ),
									'container' => false,
									'menu_class' => 'language-nav__items menu',
									'theme_location' => 'language-nav',
								]);
							?>
						</nav>

						<div class="top-bar__socials">
							<?php if(!empty($socials_data['facebook']) || !empty($socials_data['instagram']) || !empty($socials_data['youtube'])) : ?>
							<ul class="header__socials socials-list socials-list--nowrap">
								<?php if(!empty($socials_data['facebook'])) : ?>
								<li class="socials-list__item"><a href="<?php echo $socials_data['facebook']; ?>" class="socials-list__anchor" title="<?php _e( 'Facebook', 'hiiukala-theme' ); ?>" target="_blank"><?php icon_svg('socials-fb'); ?><span class="screen-reader-text"><?php _e( 'Facebook', 'hiiukala-theme' ); ?></span></a></li>
								<?php endif; ?>
								<?php if(!empty($socials_data['instagram'])) : ?>
								<li class="socials-list__item"><a href="<?php echo $socials_data['instagram']; ?>" class="socials-list__anchor" title="<?php _e( 'Instagram', 'hiiukala-theme' ); ?>" target="_blank"><?php icon_svg('socials-ig'); ?><span class="screen-reader-text"><?php _e( 'Instagram', 'hiiukala-theme' ); ?></span></a></li>
								<?php endif; ?>
								<?php if(!empty($socials_data['youtube'])) : ?>
								<li class="socials-list__item"><a href="<?php echo $socials_data['youtube']; ?>" class="socials-list__anchor" title="<?php _e( 'Youtube', 'hiiukala-theme' ); ?>" target="_blank"><?php icon_svg('socials-yt'); ?><span class="screen-reader-text"><?php _e( 'Youtube', 'hiiukala-theme' ); ?></span></a></li>
								<?php endif; ?>
								<li class="socials-list__item is-only-visible-mobile-menu"><a href="<?php echo home_url(); ?>/?s=" class="socials-list__anchor" title="<?php _e( 'Search', 'hiiukala-theme' ); ?>" target="_blank"><?php icon_svg('search'); ?><span class="screen-reader-text"><?php _e( 'Search', 'hiiukala-theme' ); ?></span></a></li>
							</ul>
							<?php endif; ?>
						</div>

						<div class="top-bar__search">
							<?php echo get_template_part('templates/components/searchform', null, ['wrapper_classes' => 'search-form--header']); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="header__main">
				<div class="container">
					<div class="header__inner">
						<div class="header__mobile">
							<div class="header__logo header-logo">
								<a href="<?php echo home_url(); ?>" class="header-logo__anchor"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" title="<?php echo __( 'Return to homepage', 'hiiukala-theme' ); ?>" alt="MTÜ Hiiukala logo" class="header-logo__img" /></a>
							</div>

							<div class="header__toggle">
								<button class="mobile-menu-toggle js-mobile-menu-toggle" title="<?php echo __( 'Open mobile menu', 'hiiukala-theme' ); ?>">&nbsp;</button>
							</div>
						</div>

						<div class="header__desktop">
							<div class="header__menu">
								<nav class="header__nav header-nav">
									<?php
										wp_nav_menu([
											'menu' => __( 'Main navigation (Left)', 'hiiukala-theme' ),
											'container' => false,
											'menu_class' => 'header-nav__items menu',
											'theme_location' => 'primary-nav-left',
										]);
									?>
								</nav>
							</div>

							<div class="header__logo header-logo">
								<a href="<?php echo home_url(); ?>" class="header-logo__anchor"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" title="<?php echo __( 'Return to homepage', 'hiiukala-theme' ); ?>" alt="MTÜ Hiiukala logo" class="header-logo__img" /></a>
							</div>

							<div class="header__menu">
								<nav class="header__nav header-nav">
									<?php
										wp_nav_menu([
											'menu' => __( 'Main navigation (Right)', 'hiiukala-theme' ),
											'container' => false,
											'menu_class' => 'header-nav__items menu',
											'theme_location' => 'primary-nav-right',
										]);
									?>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>

		</header>

		<!-- Site content -->
		<main class="main">