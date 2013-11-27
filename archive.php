<?php get_header(); ?>


	<div class="large-12 columns content-header">
	
		
			<?php if (is_category()) { ?>
				<h1 class="archive-title xxl">
					<?php single_cat_title(); ?>
				</h1>

			<?php } elseif (is_tag()) { ?>
				<h1 class="archive-title xxl">
					<?php single_tag_title(); ?>
				</h1>

			<?php } elseif (is_author()) {
				global $post;
				$author_id = $post->post_author;
			?>
			
				
			
				<h1 class="archive-title h2">

					<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

				</h1>
			<?php } elseif (is_day()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
				</h1>

			<?php } elseif (is_month()) { ?>
					<h1 class="archive-title h2">
						<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
					</h1>

			<?php } elseif (is_year()) { ?>
					<h1 class="archive-title h2">
						<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
					</h1>
			<?php } ?>
			
			<?php if ( function_exists('yoast_breadcrumb') ) {
				#yoast_breadcrumb('<nav class="breadcrumbs clean">','</nav>');
			} 
			?>
			
		
	</div>
	
<div id="main" class="large-8 columns" role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php #post_class( 'row' ); ?> role="article">
		
		<div class="row">
			<aside class="large-2 columns">
				<?php
				printf(__( '
					<time class="post-date" datetime="%1$s" pubdate>					
						<div class="month">%2$s</div>
						<div class="day h3">%3$s</div>
						<div class="year">%4$s</div>
					</time>
					', 'bonestheme' 
					), 
					get_the_time('Y-m-j'), 
					get_the_time(__( 'M', 'bonestheme' )), 
					get_the_time(__( 'j', 'bonestheme' )), 
					get_the_time(__( 'Y', 'bonestheme' )), 				
					get_the_category_list(', ')
				);
				?>
				
				<p class="comments-count">
					<a href="<?php the_permalink() ?>#comments"><i class="fa fa-comment-o fa-lg"></i><?php comments_number( ' 0', ' 1', ' %' ); ?></a>
				</p>
				
				
				<div class="h6">Categories:</div>
				<?php echo get_the_category_list( ); ?> 
				
			</aside>
			
			<div class="large-10 columns">

				<header class="article-header">
					<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>			
				</header>

				<section class="entry-content clearfix">

					<?php the_post_thumbnail( 'bones-thumb-300' ); ?>

					<?php the_excerpt(); ?>

				</section>

			</div>
		</div>
		
		<footer class="article-footer">

		</footer>
		
	</article>

	<?php endwhile; ?>

			<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
				<?php bones_page_navi(); ?>
			<?php } else { ?>
				<nav class="wp-prev-next">
					<ul class="clearfix">
						<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
						<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
					</ul>
				</nav>
			<?php } ?>

	<?php else : ?>

			<article id="post-not-found" class="hentry clearfix">
				<header class="article-header">
					<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
				</header>
				<section class="entry-content">
					<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
				</section>
				<footer class="article-footer">
						<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
				</footer>
			</article>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>


<?php get_footer(); ?>
