<?php
/**
 * @package WordPress
 * @subpackage Highend
 * Template name: Video Background
 */

require 'includes/shortcodes.php';

get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		$id = get_the_id();
		$page_title = get_the_title();
		$page_content = do_shortcode(get_the_content());
		$page_content = apply_filters('the_content', $page_content);
	}
}
?>

<!-- <source src="https://cdn.theguardian.tv/interactive/mp4/wildfires/dunalley_intro_hi.mp4" type="video/mp4"> -->

<div class="outer-container">
	<div class="left-content-container">
		<?php
			$header_logo  = '<img id="top-logo" src="';
			$header_logo .= 	content_url() . '/uploads/2018/03/BBG-AR_Logo_Default.png" ';
			$header_logo .= 	'title="" alt="BBG Annual Report 2017"';
			$header_logo .= '>';
			echo $header_logo;
		?>
	</div>
</div>

<div class="outer-container">
	<div class="grid-container page-title">
		<?php echo '<h2>' . $page_title . '</h2>'; ?>
	</div>
</div>

<div class="outer-container">
	<div class="left-content-container">
		<?php echo $page_content; ?>
	</div>
</div>

<?php get_footer(); ?>