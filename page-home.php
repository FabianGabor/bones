<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="home" class="text-center">

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
			<?php bones_main_nav(); ?>
		</nav>

	</div>

<?php endwhile; else : ?>

	<article id="post-not-found" class="hentry clearfix">
			<header class="article-header">
				<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
		</header>
			<section class="entry-content">
				<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
		</section>
		<footer class="article-footer">
				<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
		</footer>
	</article>

<?php endif; ?>


<?php get_footer(); ?>
