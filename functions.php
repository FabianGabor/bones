<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
function add_menuclass( $ulclass ) {
  return preg_replace( '/<ul>/', '<ul id="nav" class="side-nav">', $ulclass, 1 );
}
add_filter( 'wp_page_menu', 'add_menuclass' );

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-author">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar left" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time class="xs" datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content">
				<?php comment_text() ?>
				
				<p class="left h6"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
				<p class="right h6"><?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?></p>
			</section>
			
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!


?>



<?php
add_filter('comment_reply_link', 'replace_reply_link_class');
add_filter('edit_comment_link', 'replace_edit_link_class');


function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='button tiny round", $class);
    return $class;
}






function replace_edit_link_class($class){
    $class = str_replace("class='comment-edit-link", "class='button tiny radius", $class);
    return $class;
}

?>


<?php

function bones_theme_customizer( $wp_customize ) {
/*
    $wp_customize->add_setting( 'debut_link_color', array(
        'default' => '#ff0000',
        'transport' => 'postMessage',
    ) );
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'debut_link_color', array(
        'label'         => 'Link and Highlight Color',
        'section' => 'colors',
        'settings' => 'debut_link_color',
    ) ) );
*/
    // Logo upload
    $wp_customize->add_section( 'bones_logo_section' , array(
         'title' => __( 'Logo', 'bones' ),
         'priority' => 30,
         'description' => 'Upload a logo to replace the default site name and description in the header',
        ) );
        $wp_customize->add_setting( 'bones_logo' );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bones_logo', array(
                'label' => __( 'Logo', 'bones' ),
                'section' => 'bones_logo_section',
                'settings' => 'bones_logo',
        ) ) );
/*
    // Choose excerpt or full content on blog
    $wp_customize->add_section( 'debut_layout_section' , array(
         'title' => __( 'Layout', 'debut' ),
         'priority' => 30,
         'description' => 'Change how Debut displays posts',
        ) );
        $wp_customize->add_setting( 'debut_post_content', array(
                'default'        => 'option1',
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'debut_post_content', array(
                'label'                => __( 'Post content', 'debut' ),
                'section'        => 'debut_layout_section',
                'settings'        => 'debut_post_content',
                'type'                => 'radio',
                'choices'        => array(
                        'option1'        => 'Excerpts',
                        'option2'        => 'Full content',
                        ),
        ) ) );

        // Set site name and description to be previewed in real-time
        $wp_customize->get_setting('blogname')->transport='postMessage';
        $wp_customize->get_setting('blogdescription')->transport='postMessage';

        // Enqueue scripts for real-time preview
        wp_enqueue_script( 'debut-customizer', get_template_directory_uri() . '/js/debut-customizer.js', array( 'jquery' ) );
*/

}
add_action('customize_register', 'bones_theme_customizer');

?>
