<?php

function highend_child_theme_enqueue_styles() {
	$parent_style = 'highend-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'highend-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style )
	);
}
add_action('wp_enqueue_scripts', 'highend_child_theme_enqueue_styles');

function wpb_add_google_fonts() {
	wp_enqueue_style('add-google-fonts', 'https://fonts.googleapis.com/css?family=Alegreya+Sans:300,300i,400,400i,700,700i', false); 
}
add_action('wp_enqueue_scripts', 'wpb_add_google_fonts');

function bbg_add_scripts () {
	wp_enqueue_script('uswdsJs', get_stylesheet_directory_uri() . '/js/uswds/uswds.min.js');
	wp_enqueue_script('krCustom', get_stylesheet_directory_uri() . '/js/bbg_scripts.js');
	wp_enqueue_script('charts', get_stylesheet_directory_uri() . '/node_modules/chart.js/dist/Chart.bundle.js');
	wp_enqueue_script('videoBG', get_stylesheet_directory_uri() . '/js/videoBG.js');
}
add_action ('wp_enqueue_scripts', 'bbg_add_scripts');

// CUSTOM POST TYPES
function awards_field() {
	register_post_type('award', array(
		'public' => true,
		'menu_icon' => 'dashicons-awards',
		'menu_position' => 30,
		'labels' => array(
			'name' => 'Awards',
			'add_new_item' => 'Add New Award',
			'edit_item' => 'Edit Award',
			'all_items' => 'All Awards',
			'singular_name' => 'Award'
		),
		'taxonomies' => array('category'),
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'excerpt',
			'author',
			'revisions'
		),
	));
}
add_action('init', 'awards_field');

function profiles_field() {
	register_post_type('profile', array(
		'public' => true,
		'menu_icon' => 'dashicons-id',
		'menu_position' => 30,
		'labels' => array(
			'name' => 'Profiles',
			'add_new_item' => 'Add New Profile',
			'edit_item' => 'Edit Profile',
			'all_items' => 'All Profiles',
			'singular_name' => 'Profile'
		),
		'taxonomies' => array('category'),
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'excerpt',
			'author',
			'revisions'
		),
	));
}
add_action('init', 'profiles_field');

function threats_to_press_field() {
	register_post_type('threats_to_press', array(
		'public' => true,
		'menu_icon' => 'dashicons-shield',
		'menu_position' => 30,
		'labels' => array(
			'name' => 'Threats to Press',
			'add_new_item' => 'Add Threat',
			'edit_item' => 'Edit Threat',
			'all_items' => 'All Threats',
			'singular_name' => 'Threat to Press'
		),
		'taxonomies' => array('category'),
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'excerpt',
			'author',
			'revisions'
		),
	));
}
add_action('init', 'threats_to_press_field');

function incidents_field() {
	register_post_type('incidents', array(
		'public' => true,
		'menu_icon' => 'dashicons-warning',
		'menu_position' => 30,
		'labels' => array(
			'name' => 'Incidents',
			'add_new_item' => 'Add New incident',
			'edit_item' => 'Edit incident',
			'all_items' => 'All Incidents',
			'singular_name' => 'Incident'
		),
		'taxonomies' => array('category')
	));
}
add_action('init', 'incidents_field');

function charts_field() {
	register_post_type('chart', array(
		'public' => true,
		'menu_icon' => 'dashicons-chart-line',
		'menu_position' => 30,
		'labels' => array(
			'name' => 'Charts',
			'add_new_item' => 'Add New Chart',
			'edit_item' => 'Edit Chart',
			'all_items' => 'All Charts',
			'singular_name' => 'Chart'
		),
		'taxonomies' => array('category')
	));
}
add_action('init', 'charts_field');


// IS THIS NECESSARY WITH THE SIDE MENU?
function hbChild_register_menu() {
	register_nav_menu('footer-menu', __('Footer Menu', 'hbthemes'));
}
add_action('init', 'hbChild_register_menu');

?>