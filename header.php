<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>		
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?>>
	

		<?php
		$category = get_the_category();
		$category_id = $category[0]->cat_ID;
		$category_parent = $category[0]->category_parent;
		?>
		
		
		
		<?php echo '<!--' . basename( get_page_template() ) . '-->'; ?>
		
		
		
		
		<header id="header-wrap" class="header sidenav <?php if ( basename( get_page_template() ) == 'page-fullscreen-gallery.php' ) echo 'auto-hide'; ?>" role="banner" data-menutimeout="3">
			<div class="logo">				
				
				<?php if ( get_theme_mod( 'bones_logo' ) ) : ?>				
					<a class="logo-img" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
						<img src='<?php echo esc_url( get_theme_mod( 'bones_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
					</a>
					
					<h2 class='site-description h6'><?php bloginfo( 'description' ); ?></h2>
					
				<?php else : ?>
					<hgroup>
						<h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class='site-description'><?php bloginfo( 'description' ); ?></h2>
					</hgroup>
				<?php endif; ?>
				
				<?php // if you'd like to use the site description you can un-comment it below ?>
				<?php // bloginfo('description'); ?>
			</div>
			
			<nav role="navigation">
				<?php bones_side_nav(); ?>
			</nav>

		</header>
		
		<div id="container" class="row left">
			<?php
			#var_dump( $category );
			?>