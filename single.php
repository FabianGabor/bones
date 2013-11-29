<?php get_header(); ?>

			

<div id="main" class="large-8 medium-8 columns" role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php #post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
			<div class="row">
				<aside class="large-2 medium-2 columns">
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
				
				<div class="large-10 medium-10 columns">
					<header class="article-header">
						<h1 class="entry-title single-title h2" itemprop="headline"><?php the_title(); ?></h1>
					</header>

					<section class="entry-content clearfix" itemprop="articleBody">
						<?php the_content(); ?>
					</section>
				</div>
			</div>

			<footer class="article-footer">
				<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

			</footer>

			<?php comments_template(); ?>

		</article>

	<?php endwhile; ?>

	<?php else : ?>

		<article id="post-not-found" class="hentry clearfix">
				<header class="article-header">
					<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
				</header>
				<section class="entry-content">
					<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
				</section>
				<footer class="article-footer">
						<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
				</footer>
		</article>

	<?php endif; ?>

</div>

					<?php get_sidebar(); ?>

				

<?php get_footer(); ?>
