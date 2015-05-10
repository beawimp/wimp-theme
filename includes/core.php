<?php
namespace WIMP\Core;

// Set the max width of content for oembeds and other content
if ( ! isset( $content_width ) ) {
	$content_width = 1074;
}

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @since 0.1.0
 *
 * @uses add_action()
 *
 * @return void.
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'after_setup_theme',  $n( 'theme_init' )            );
	add_action( 'wp_head',            $n( 'header_meta' )           );
	add_action( 'wp_enqueue_scripts', $n( 'scripts' )               );
	add_action( 'wp_enqueue_scripts', $n( 'styles' )                );
	add_filter( 'wp_title',           $n( '_wimp_wp_title' ), 10, 2 );
}

/**
 * Initialize the theme settings
 */
function theme_init() {
	// Load theme translations
	load_theme_textdomain( 'wimp', WIMP_PATH . '/languages' );

	// Add the default posts and comments RSS feed links
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Register our menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'wimp' ),
	) );

	// Enable HTML5 default core markup
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}

/**
 * Enqueue scripts for front-end.
 *
 * @uses wp_enqueue_script() to load front end scripts.
 *
 * @since 0.1.0
 *
 * @return void.
 */
function scripts( $debug = false ) {
	$min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'wimp',
		WIMP_TEMPLATE_URL . "/assets/js/wimp{$min}.js",
		array(),
		WIMP_VERSION,
		true
	);
}

/**
 * Enqueue styles for front-end.
 *
 * @uses wp_enqueue_style() to load front end styles.
 *
 * @since 0.1.0
 *
 * @return void.
 */
function styles( $debug = false ) {
	$min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style(
		'wimp',
		WIMP_URL . "/assets/css/wimp{$min}.css",
		array(),
		WIMP_VERSION
	);
}

/**
 * Add humans.txt to the <head> element.
 *
 * @uses apply_filters()
 *
 * @since 0.1.0
 *
 * @return void.
 */
function header_meta() {
	$meta  = '<link type="text/plain" rel="author" href="' . esc_url( WIMP_TEMPLATE_URL . '/humans.txt' ) . '" />' . "\n";
	$meta .= '<link rel="shortcut icon" href="' . esc_url( get_template_directory_uri() . '/favicon.png' ) . '" />' . "\n";
	$meta .= '<link rel="apple-touch-icon" href="' . esc_url( WIMP_TEMPLATE_URL . 'images/apple-touch-icon.png' ) . '">' . "\n";

	echo apply_filters( 'wimp_header_meta', $meta );
}

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since 0.1.0
 */
function _wimp_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() ) {
		return $title;
	}

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'wimp' ), max( $paged, $page ) );
	}

	return $title;
}