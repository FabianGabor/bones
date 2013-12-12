<?php get_header(); ?>

<div class="large-12 columns content-header">
	
	<h1 class="archive-title xxl" itemprop="headline">
		<?php the_title(); ?>
	</h1>
	
</div>	

<div id="main" class="large-12 medium-12 columns" role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php # post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

		<div class="row">
			<div class="large-12 medium-12 columns">
				<section class="entry-content" itemprop="articleBody">
					<?php the_content(); ?>
				</section>
			</div>
		</div>

		<footer class="article-footer">
			<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>

		</footer>

		<?php # comments_template(); ?>

	</article>

	<?php endwhile; else : ?>

			<article id="post-not-found" class="hentry">
				<header class="article-header">
					<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
				</header>
				<section class="entry-content">
					<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
				</section>
				<footer class="article-footer">
						<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
				</footer>
			</article>

	<?php endif; ?>

</div>

<?php #get_sidebar(); ?>


<?php get_footer(); ?>
