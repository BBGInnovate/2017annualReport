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

function charts_field() {
	register_post_type('chart', array(
		'public' => true,
		'menu_icon' => 'dashicons-chart-line',
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

function hbChild_register_menu() {
	register_nav_menu('footer-menu', __('Footer Menu', 'hbthemes'));
}
add_action('init', 'hbChild_register_menu');

function shortCodeExample($atts) {
	$atts = shortcode_atts(array(
		'src' => '',
		'title' => ''
	), $atts);

	$img  = '<img class="related-img" src="';
	$img .= $atts['src'];
	$img .= '" alt ="';
	$img .= $atts['title'];
	$img .= '">';
	return $img;
}
add_shortcode('shortEx', 'shortCodeExample');

// function add_video_mover() {
// 	$mover  = '</div><div class="video-mover"></div><div class="copy-side">';
// 	echo $mover;
// }
// add_shortcode('move_video', 'add_video_mover');

?>