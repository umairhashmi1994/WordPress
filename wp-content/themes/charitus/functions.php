<?php
/**
 * charitus functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package charitus
 */

if ( ! function_exists( 'charitus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function charitus_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on charitus, use a find and replace
	 * to change 'charitus' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'charitus', get_template_directory() . '/languages' );

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

	add_image_size( 'charitus-blog-thumb', charitus_cs_get_option( 'feature_image_width', 770 ), charitus_cs_get_option( 'feature_image_height', 422 ), true );
	add_image_size( 'charitus-campaign-thumb', apply_filters( 'charitus_campaign_image_width', 770 ), apply_filters( 'charitus_campaign_image_height', 422 ), apply_filters( 'charitus_campaign_image_hard_crop', true ) );
	add_image_size( 'charitus-campaign-thumb-grid', apply_filters( 'charitus_campaign_grid_image_width', 450 ), apply_filters( 'charitus_campaign_grid_image_height', 380 ), apply_filters( 'charitus_campaign_grid_image_hard_crop', true ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' 	=> 	esc_html__( 'Primary', 'charitus' ),
		'footer'	=>	esc_html__( 'Footer', 'charitus' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	* Enable support for Custom Logo.
	* See https://codex.wordpress.org/Theme_Logo
	*/
	add_theme_support( 'custom-logo', array(
		'height'      => 46,
		'width'       => 166,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// WooCommerce
	add_theme_support( 'woocommerce' );
}
endif;
add_action( 'after_setup_theme', 'charitus_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function charitus_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'charitus_content_width', 640 );
}
add_action( 'after_setup_theme', 'charitus_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function charitus_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'charitus' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here. It will be shown to the blog pages.', 'charitus' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s shadow blog_widget">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Donation Cause Sidebar', 'charitus' ),
		'id'            => 'campaign',
		'description'   => esc_html__( 'It will be shown to the campaign pages.', 'charitus' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s shadow blog_widget">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Events Sidebar', 'charitus' ),
		'id'            => 'events',
		'description'   => esc_html__( 'It will be shown to the events pages.', 'charitus' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s shadow blog_widget">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'charitus' ),
		'id'            => 'footer-widgets',
		'description'   => esc_html__( 'Add widgets here. It will be shown to the footer area.', 'charitus' ),
		'before_widget' => '<div id="%1$s" class="col-md-'. esc_attr( charitus_cs_get_option( 'footer_widget_column', 3 ) ) .' col-sm-6 col-xs-12 ch-pages ch-widget-list widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title footer-widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'charitus_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function charitus_scripts() {
	wp_enqueue_style( 'charitus-style', get_stylesheet_uri() );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.7' );

	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/assets/css/bootstrap-rtl.css', array(), '3.3.7' );
	}

	wp_enqueue_style( 'linea', get_template_directory_uri() . '/assets/icons/linea/styles.css', array(), '1.0' );
	
	wp_enqueue_style( 'linearicons', get_template_directory_uri() . '/assets/icons/linearicons/style.css', array(), '1.0' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/icons/font-awesome-4.7.0/css/font-awesome.min.css', array(), '4.7.0' );

	wp_enqueue_style( 'charitus-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon.css', array(), '1.0' );

	wp_enqueue_style( 'lightcase', get_template_directory_uri() . '/assets/plugins/css/lightcase.css', array(), '2.4' );

	wp_register_style( 'animate', get_template_directory_uri() . '/assets/plugins/css/animate.css', array(), '1.0' );

	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/plugins/css/owl.css', array(), '2.2.1' );

	wp_enqueue_style( 'charitus-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0' );

	wp_enqueue_style( 'charitus-color', get_template_directory_uri() . '/assets/css/color.css', array(), '1.0' );

	wp_enqueue_style( 'charitus-responsive-style', get_template_directory_uri() . '/assets/css/responsive.css', array(), '1.0' );

	wp_enqueue_style( 'charitus-custom-style', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0' );


	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

	wp_enqueue_script( 'charitus-meanmenu', get_template_directory_uri() . '/assets/plugins/js/meanmenu.js', array('jquery'), '2.0.8', true );

	wp_enqueue_script( 'lightcase', get_template_directory_uri() . '/assets/plugins/js/lightcase.min.js', array('jquery'), '2.4', true );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/plugins/js/owl.carousel.js', array('jquery'), '2.2.1', true );

	wp_enqueue_script( 'charitus-main', get_template_directory_uri() . '/assets/js/init.js', array('jquery'), '1.0', true );

	wp_enqueue_script( 'charitus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'charitus-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'charitus-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'charitus_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Bootstrap Nav Walker Class
 */
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

/**
 * TGM Plugin Installer
 */
require get_template_directory() . '/admin/class-tgm-plugin-activation.php';

/**
 * CodeStar FrameWork
 */
require get_template_directory() . '/admin/codestar-framework/cs-framework.php';

/**
 * Breadcrumbs
 */
require get_template_directory() . '/inc/breadcrumbs.php';


/**
 * Charitable functions 
 */
if ( class_exists( 'Charitable' ) ){
	require get_template_directory() . '/inc/charitable-functions.php';
}

/**
 * XooTheme Core Functions
 */
require get_template_directory() . '/inc/xt-core-functions.php';


/**
 * Theme Custom Functions
 */
require get_template_directory() . '/inc/theme-functions.php';


/**
 * Aqua Image Resizer
 */
require get_template_directory() . '/inc/xt-aq-resizer.php';

/**
 * Events functions 
 */

if ( class_exists( 'Tribe__Events__Main' ) ) {
	require get_template_directory() . '/inc/event-calender-functions.php';
}

/**
 * WooCommerce functions
 */

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/ch-woocommerce-functions.php';
}