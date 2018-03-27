<?php
/**
 * @package WordPress
 * @subpackage Highend
 */
 ?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<?php global $theme_focus_color; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="theme-color" content="<?php echo $theme_focus_color; ?>">
<!--[if lte IE 8]>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/html5shiv.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body itemscope="itemscope">
	<!-- BEGIN #hb-wrap -->
	<div id="hb-wrap">

	<!-- BEGIN #main-wrapper -->
	<div id="main-wrapper" class="<?php if ( vp_metabox('misc_settings.hb_onepage') ) { echo 'hb-one-page '; } echo $hb_layout_class; echo $footer_separator; echo ' ' . hb_options('hb_boxed_layout_type'); echo $hb_logo_alignment; echo ' ' . $hb_shadow_class; echo $hb_logo_alignment; echo ' ' . $hb_content_width; echo $sticky_shop_button . $hb_resp; echo ' ' . hb_options('hb_header_layout_style'); ?>" data-cart-url="<?php echo $cart_url; ?>" data-cart-count="<?php echo $cart_count; ?>" <?php echo $search_in_header; ?>>

		<?php
		$additional_class = "";
		if ( hb_options('hb_header_layout_style') == "nav-type-1 nav-type-4" ) {
			$additional_class .= "special-header";
		}
		if ( !hb_options('hb_top_header_bar') ) {
			$additional_class .= " without-top-bar";	
		}
		?>

		<?php if ( !is_page_template('page-blank.php') ) {
			if ( hb_options('hb_header_layout_style') != "left-panel" ) { ?>
				<!-- BEGIN #hb-header -->
				<header id="hb-header" class="<?php echo $additional_class; ?>">
					<?php get_template_part( 'includes/header' , 'top-bar' ); ?>
					<?php get_template_part( 'includes/header' , 'navigation' ); ?>
				</header>
				<!-- END #hb-header -->
			<?php } ?>
			<?php get_template_part( 'includes/header' , 'slider-section'); ?>
		<?php } ?>