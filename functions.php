<?php
/**
 * Codename functions and definitions
 *
 * @package Codename
 */

/**
 * Codename only works in WordPress 5.2 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '5.2', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function codename_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'codename', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Set default Post Thumbnail size.
	set_post_thumbnail_size( 1080, 540, true );

	// Add image size for header image on single posts and pages.
	add_image_size( 'codename-featured-header-image', 1440, 600, true );

	// Add image size for header image on single posts and pages.
	add_image_size( 'codename-horizontal-list-post', 960, 720, true );

	// Register Navigation Menus.
	register_nav_menus( array(
		'primary' => esc_html__( 'Main Navigation', 'codename' ),
	) );

	// Switch default core markup for galleries and captions to output valid HTML5.
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom logo feature.
	add_theme_support( 'custom-logo', apply_filters( 'codename_custom_logo_args', array(
		'height'      => 60,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) ) );

	// Set up the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'codename_custom_header_args', array(
		'header-text' => false,
		'width'       => 1440,
		'height'      => 450,
	) ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'codename_custom_background_args', array(
		'default-color' => '353535',
	) ) );

	// Add Theme Support for Selective Refresh in Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'codename_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function codename_content_width() {

	// Default content width.
	$content_width = 800;

	// Set global variable for content width.
	$GLOBALS['content_width'] = apply_filters( 'codename_content_width', $content_width );
}
add_action( 'after_setup_theme', 'codename_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function codename_scripts() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet.
	wp_enqueue_style( 'codename-stylesheet', get_stylesheet_uri(), array(), $theme_version );

	// Register and enqueue navigation.js.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script( 'codename-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$codename_l10n = array(
			'expand'   => esc_html__( 'Expand child menu', 'codename' ),
			'collapse' => esc_html__( 'Collapse child menu', 'codename' ),
			'icon'     => codename_get_svg( 'expand' ),
		);
		wp_localize_script( 'codename-navigation', 'codenameScreenReaderText', $codename_l10n );
	}

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.4' );

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'codename_scripts' );


/**
* Enqueue theme fonts.
*/
function codename_theme_fonts() {
	wp_enqueue_style( 'codename-theme-fonts', get_template_directory_uri() . '/assets/css/theme-fonts.css', array(), '20191018' );
}
add_action( 'wp_enqueue_scripts', 'codename_theme_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'codename_theme_fonts', 1 );


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function codename_widgets_init() {
	// Register Footer Copyright widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'codename' ),
		'id'            => 'footer-copyright',
		'description'   => esc_html_x( 'Appears in the bottom footer line.', 'widget area description', 'codename' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'codename_widgets_init', 30 );


/**
 * Include Files
 */

// Include Theme Info page.
require get_template_directory() . '/inc/theme-info.php';

// Include Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include SVG Icon Functions.
require get_template_directory() . '/inc/icons.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-functions.php';

// Include Template Tags.
require get_template_directory() . '/inc/template-tags.php';

// Include Gutenberg Features.
require get_template_directory() . '/inc/gutenberg.php';

// Include support functions for Theme Addons.
require get_template_directory() . '/inc/addons.php';
