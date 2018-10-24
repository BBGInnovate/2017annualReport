<?php
/**
 * @package WordPress
 * @subpackage Highend
 * Template name: Thematic page
 */

require 'includes/shortcodes.php';
require 'includes/custom_field_data.php';

if( is_singular ( 'clients' ) ||
 	is_singular ( 'hb_pricing_table' ) ) {
	wp_redirect(home_url()); exit;
} 

get_header();
// display_logo_home_button();
if (have_posts()) {
	while (have_posts()) {
		the_post();
		$page_title = get_the_title();
		$page_content = do_shortcode(get_the_content());
		$page_content = apply_filters('the_content', $page_content);
	}
}
?>

<div class="container">
	<div class="row main-row">

		<div class="col-12 post-header">
			<h2 class="title entry-title"><?php echo $page_title; ?></h2>
		</div>

		<div class="col-7">
			<?php echo do_shortcode($page_content); ?>
		</div>

	</div><!-- END .row -->
</div><!-- END .container -->

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/videoBG.js"></script>
<?php get_footer(); ?>