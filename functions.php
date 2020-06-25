<?php
/**
 * HemerkenGT functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package HemerkenGT
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'hemerken_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hemerken_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on HemerkenGT, use a find and replace
		 * to change 'hemerken' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hemerken', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'hemerken' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'hemerken_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'hemerken_setup' );

function hemerken_add_editor_style() {
	add_editor_style('dist/css/editor-style.css');
}
add_action('admin_init', 'hemerken_add_editor_style');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hemerken_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hemerken_content_width', 1140 );
}
add_action( 'after_setup_theme', 'hemerken_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hemerken_gt_sidebar_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Content', 'hemerken-gt' ),
		'id'            => 'homepage',
		'description'   => esc_html__( 'Only put "Home One/Two/Three Columns" and "Advertisement" widgets here.', 'hemerken-gt' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
}
/**
 * Enqueue scripts and styles.
 */
function hemerken_scripts() {
	wp_enqueue_style('hemerken-bs-css' , get_template_directory_uri() . '/dist/css/bootstrap.min.css');

	wp_enqueue_style('hemerken-fontawesome' , get_template_directory_uri() . '/fonts/font-awesome/css/fontawesome.min.css');
	
	wp_enqueue_style( 'hemerken-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'hemerken-style', 'rtl', 'replace' );

	wp_register_script('popper', 'https://unpkg.com/@popperjs/core@2.4.2/dist/umd/popper.min.js', false, '', true);
	
	wp_enqueue_script('popper');

	wp_enqueue_script( 'hemerken-tether', get_template_directory_uri() .
	'/src/js/tether.js', array(),  _S_VERSION, true );

	wp_enqueue_script( 'hemerken-bootstrap', get_template_directory_uri() .
	'/src/js/bootstrap.min.js', array('jquery'), _S_VERSION, true );

	wp_enqueue_script( 'hemerken-bootstrap-hover', get_template_directory_uri() .
	'/src/js/bootstrap-hover.js', array('jquery'),  _S_VERSION, true );

	wp_enqueue_script( 'hemerken-nav-scroll', get_template_directory_uri() .
	'/src/js/nav-scroll.js', array('jquery'),  _S_VERSION, true );

	wp_enqueue_script( 'hemerken-skip-link-focus-fix', get_template_directory_uri() .
	'/src/js/skip-link-focus-fix.js', array(),  _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hemerken_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Widgets File.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Bootstrap Navwalker File.
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Registers custom widgets.
 */
function hemerken_gt_widgets_init() {

	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-home-block-one.php';
	register_widget( 'hemerken_gt_Block_One_Widget' );

	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-home-block-two.php';
	register_widget( 'hemerken_gt_Block_Two_Widget' );

	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-home-block-three.php';
	register_widget( 'hemerken_gt_Block_Three_Widget' );

}
add_action( 'widgets_init', 'hemerken_gt_widgets_init' );