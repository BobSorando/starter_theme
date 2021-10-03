<?php
/**
 * BS_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BS_theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'bs_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bs_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BS_theme, use a find and replace
		 * to change 'bs_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bs_theme', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'bs_theme' ),
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
				'bs_theme_custom_background_args',
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
add_action( 'after_setup_theme', 'bs_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bs_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bs_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'bs_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bs_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bs_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bs_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'bs_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bs_theme_scripts() {
	// wp_enqueue_style( 'bs_theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	// wp_style_add_data( 'bs_theme-style', 'rtl', 'replace' );

	// wp_enqueue_script( 'bs_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_style( 'lp-style-vendor', get_template_directory_uri(). '/build/css/vendor.min.css' );
	wp_enqueue_style( 'lp-style', get_template_directory_uri(). '/build/css/style.min.css' );
	wp_enqueue_script( 'lp-scripts-vendor', get_template_directory_uri() . '/build/js/scripts_vend.min.js', array(), false, true);
	wp_enqueue_script( 'lp-scripts', get_template_directory_uri() . '/build/js/custom_script.min.js', array(), false, true);

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'bs_theme_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title'   => 'Основные настройки темы',
		'menu_title'  => 'Настройки темы',
		'menu_slug'   => 'theme-general-settings',
		'capability'  => 'edit_posts',
		'redirect'    => false
	));
}

add_action( 'wp_enqueue_scripts', 'remove_styles', 20 );
function remove_styles() {
wp_dequeue_style('wp-block-library-theme' );
wp_dequeue_style('contact-form-7');
wp_dequeue_style('wp-block-library');
wp_dequeue_style('wp-block-library-theme' );
}

//compress html ------------------------------------------------------------------------------- 
function teckel_init_minify_html() {
	$minify_html_active = get_option( 'minify_html_active' );
	if ( $minify_html_active != 'no' )
	  ob_start('teckel_minify_html_output');
  }
  if ( !is_admin() )
	if ( !( defined( 'WP_CLI' ) && WP_CLI ) )
	  add_action( 'init', 'teckel_init_minify_html', 1 );
  
  function teckel_minify_html_output($buffer) {
	if ( substr( ltrim( $buffer ), 0, 5) == '<?xml' )
	  return ( $buffer );
	$minify_javascript = get_option( 'minify_javascript' );
	$minify_html_comments = get_option( 'minify_html_comments' );
	$minify_html_utf8 = get_option( 'minify_html_utf8' );
	if ( $minify_html_utf8 == 'yes' && mb_detect_encoding($buffer, 'UTF-8', true) )
	  $mod = '/u';
	else
	  $mod = '/s';
	$buffer = str_replace(array (chr(13) . chr(10), chr(9)), array (chr(10), ''), $buffer);
	$buffer = str_ireplace(array ('<script', '/script>', '<pre', '/pre>', '<textarea', '/textarea>', '<style', '/style>'), array ('M1N1FY-ST4RT<script', '/script>M1N1FY-3ND', 'M1N1FY-ST4RT<pre', '/pre>M1N1FY-3ND', 'M1N1FY-ST4RT<textarea', '/textarea>M1N1FY-3ND', 'M1N1FY-ST4RT<style', '/style>M1N1FY-3ND'), $buffer);
	$split = explode('M1N1FY-3ND', $buffer);
	$buffer = ''; 
	for ($i=0; $i<count($split); $i++) {
	  $ii = strpos($split[$i], 'M1N1FY-ST4RT');
	  if ($ii !== false) {
		$process = substr($split[$i], 0, $ii);
		$asis = substr($split[$i], $ii + 12);
		if (substr($asis, 0, 7) == '<script') {
		  $split2 = explode(chr(10), $asis);
		  $asis = '';
		  for ($iii = 0; $iii < count($split2); $iii ++) {
			if ($split2[$iii])
			  $asis .= trim($split2[$iii]) . chr(10);
			if ( $minify_javascript != 'no' )
			  if (strpos($split2[$iii], '//') !== false && substr(trim($split2[$iii]), -1) == ';' )
				$asis .= chr(10);
		  }
		  if ($asis)
			$asis = substr($asis, 0, -1);
		  if ( $minify_html_comments != 'no' )
			$asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
		  if ( $minify_javascript != 'no' )
			$asis = str_replace(array (';' . chr(10), '>' . chr(10), '{' . chr(10), '}' . chr(10), ',' . chr(10)), array(';', '>', '{', '}', ','), $asis);
		} else if (substr($asis, 0, 6) == '<style') {
		  $asis = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/(\s)+' . $mod), array('>', '<', '\\1'), $asis);
		  if ( $minify_html_comments != 'no' )
			$asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
		  $asis = str_replace(array (chr(10), ' {', '{ ', ' }', '} ', '( ', ' )', ' :', ': ', ' ;', '; ', ' ,', ', ', ';}'), array('', '{', '{', '}', '}', '(', ')', ':', ':', ';', ';', ',', ',', '}'), $asis);
		}
	  } else {
		$process = $split[$i];
		$asis = '';
	  }
	  $process = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/(\s)+' . $mod), array('>', '<', '\\1'), $process);
	  if ( $minify_html_comments != 'no' )
		$process = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->' . $mod, '', $process);
	  $buffer .= $process.$asis;
	}
	$buffer = str_replace(array (chr(10) . '<script', chr(10) . '<style', '*/' . chr(10), 'M1N1FY-ST4RT'), array('<script', '<style', '*/', ''), $buffer);
	$minify_html_xhtml = get_option( 'minify_html_xhtml' );
	$minify_html_relative = get_option( 'minify_html_relative' );
	$minify_html_scheme = get_option( 'minify_html_scheme' );
	if ( $minify_html_xhtml == 'yes' && strtolower( substr( ltrim( $buffer ), 0, 15 ) ) == '<!doctype html>' )
	  $buffer = str_replace( ' />', '>', $buffer );
	if ( $minify_html_relative == 'yes' )
	  $buffer = str_replace( array ( 'https://' . $_SERVER['HTTP_HOST'] . '/', 'http://' . $_SERVER['HTTP_HOST'] . '/', '//' . $_SERVER['HTTP_HOST'] . '/' ), array( '/', '/', '/' ), $buffer );
	if ( $minify_html_scheme == 'yes' )
	  $buffer = str_replace( array( 'http://', 'https://' ), '//', $buffer );
	return ($buffer);
  }


function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );
