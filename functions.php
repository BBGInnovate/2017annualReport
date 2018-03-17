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
}
add_action ('wp_enqueue_scripts', 'bbg_add_scripts');

?>
