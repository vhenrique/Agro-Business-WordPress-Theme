<?php
// Theme prefix
	global $themePrefix;
	$themePrefix = "_vhs_";

// Define templateurl
	define('TEMPLATEURL', get_template_directory_uri());

// Make theme available for translation
	load_theme_textdomain('lang', TEMPLATEPATH . '/languages');

// Location defaults
	date_default_timezone_set('Brazil/East');
	setlocale(LC_ALL, 'pt_BR');
	define("CHARSET", "utf-8");

// Set content width
	if(!isset($content_width)) $content_width = 640;

// Register navigation menus
	add_theme_support('nav-menus');
	register_nav_menus(
		array(
			'menu'		=> 'Menu',
			'footer'	=> 'Rodapé'
		)
	);

// Register sidebar
	if(function_exists('register_sidebar')){
		register_sidebar(array(
			'name'				=> 'Sidebar',
			'id'				=> 'main-sidebar',
			'before_widget'		=> '<div class="widget">',
			'after_widget'		=> '</div>',
			'before_title'		=> '<h3>',
			'after_title'		=> '</h3>',
		));
	}

// Enqueue scripts
	add_action('wp_enqueue_scripts', 'vhs_enqueue_scripts_and_styles');
	function vhs_enqueue_scripts_and_styles(){
		wp_enqueue_script('jquery');
		wp_enqueue_script('functions', get_template_directory_uri() . '/assets/js/functions.js', array('jquery'), '', true);
		wp_enqueue_script('ajaxFunctions', get_template_directory_uri() . '/assets/js/ajaxFunctions.js', array('jquery'), '', true);
		wp_enqueue_script('whatShare', get_template_directory_uri() . '/assets/js/whatsapp-button.js', array('jquery'), '', true);
	}

// Admin extensions
	$extensions_path = dirname(__FILE__) . '/extensions/';

	if(file_exists($extensions_path . 'custom-post-types.php')) require_once($extensions_path . 'custom-post-types.php');
	if(file_exists($extensions_path . 'custom-functions.php')) require_once($extensions_path . 'custom-functions.php');
	if(file_exists($extensions_path . 'custom-wordpress-tweeks.php')) require_once($extensions_path . 'custom-wordpress-tweeks.php');
	if(file_exists($extensions_path . 'custom-shortcodes.php')) require_once($extensions_path . 'custom-shortcodes.php');
	if(file_exists($extensions_path . 'custom-roles-capabilities.php')) require_once ($extensions_path . 'custom-roles-capabilities.php');
	if(file_exists($extensions_path . 'custom-term-meta.php')) require_once($extensions_path . 'custom-term-meta.php');
	
// Register post thumbnail sizes
	add_theme_support('post-thumbnails', getAllPostTypes());
	set_post_thumbnail_size(180, 100, true);
	add_image_size('featured-post', 600, 365, true);
	// add_image_size('featured-postInternal', 600, 405, true);
	add_image_size('post-list', 154, 117, true);
	add_image_size('popular-events-list', 130, 100, true);

// Custom theme options
	if(!class_exists('ReduxFramework') && file_exists($extensions_path . 'redux/framework.php')) require_once($extensions_path . 'redux/framework.php');
	if(file_exists($extensions_path . 'custom-theme-options.php')) require_once($extensions_path . 'custom-theme-options.php');

// Custom metaboxes	
	add_action('init', 'vhs_admin_init');
	function vhs_admin_init(){
		if(file_exists($extensions_path . 'custom-metaboxes/init.php')) require_once($extensions_path . 'custom-metaboxes/init.php');
	}		
	if(file_exists($extensions_path . 'custom-post-meta.php')) require_once($extensions_path . 'custom-post-meta.php');
?>