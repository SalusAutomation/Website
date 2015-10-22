<?php
/**
 * salus functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package salus
 */

if ( ! function_exists( 'salus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function salus_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on salus, use a find and replace
	 * to change 'salus' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'salus', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'salus' ),
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
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'salus_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // salus_setup
add_action( 'after_setup_theme', 'salus_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function salus_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'salus_content_width', 640 );
}
add_action( 'after_setup_theme', 'salus_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function salus_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'salus' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'salus_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function salus_scripts() {
	wp_enqueue_style( 'salus-style', get_stylesheet_uri() );

  // jQuery Easing Plugin
  wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array('jquery'), '', true);

  // Salus Custom JS
  wp_enqueue_script( 'salus-custom-js', get_template_directory_uri() . '/js/salus-ui.js', array('jquery'), '', true);

  // Theme Built-ins
	wp_enqueue_script( 'salus-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'salus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'salus_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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



//  CUSTOM POST TYPE
//  Applications
//  —·—·—·—·—·—·—·—·—·—

function custom_post_type_app() {
	$labels = array(
		'name'                => 'App',
		'singular_name'       => 'App',
		'menu_name'           => 'App',
		'parent_item_colon'   => 'Parent App:',
		'all_items'           => 'All Apps',
		'view_item'           => 'View App',
		'add_new_item'        => 'Add New App',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit App',
		'update_item'         => 'Update App',
		'search_items'        => 'Search Apps',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	
	$args = array(
		'label'               => 'app',
		'description'         => 'Individual app for the Applications section',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'custom-fields', 'page-attributes', 'thumbnail'),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	register_post_type('app', $args);
}

//  CUSTOM POST TYPE
//  Site Blocks
//  —·—·—·—·—·—·—·—·—·—

function custom_post_type_site_block() {
  $labels = array(
    'name'                => 'Site Blocks',
    'singular_name'       => 'Site Block',
    'menu_name'           => 'Site Blocks',
    'parent_item_colon'   => 'Parent Site Block:',
    'all_items'           => 'All Site Blocks',
    'view_item'           => 'View Site Block',
    'add_new_item'        => 'Add New Site Block',
    'add_new'             => 'Add New',
    'edit_item'           => 'Edit Site Block',
    'update_item'         => 'Update Site Block',
    'search_items'        => 'Search Site Block',
    'not_found'           => 'Not found',
    'not_found_in_trash'  => 'Not found in Trash',
  );
  
  $args = array(
    'label'               => 'site-block',
    'description'         => 'Content managed components located throughout the site.',
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'custom-fields', 'page-attributes' ),
    // 'taxonomies'          => array( 'category', 'post_tag' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  
  register_post_type('site-block', $args);
}



// Hook custom post types into the 'init' action
add_action('init', 'custom_post_type_app', 0);
add_action('init', 'custom_post_type_site_block', 0);

