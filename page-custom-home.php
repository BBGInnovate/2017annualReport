<?php
/**
 * @package WordPress
 * @subpackage Highend
 * Template name: Page Custom Home
 */

require 'shortcodes/related_profiles.php';
require 'shortcodes/related_stories.php';

get_header();
?>

<?php
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

<div class="video-wrapper coverImgBg">
	<video class="video-tag" autoplay loop poster="<?php echo content_url(); ?>/uploads/2018/03/Street-Pulse.jpg">
		<source src="<?php echo get_stylesheet_directory_uri(); ?>/videos/463476424.mp4" type="video/mp4">
	</video>
</div>


<!-- BEGIN #main-content -->
<div id="main-content">
	<div class="container">
		<img id="top-logo" src="<?php echo content_url(); ?>/uploads/2018/03/BBG-AR_Logo_Default.png">
		<div class="page-content">
			<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div id="wp-content" class="grid-contents">
					<?php
						echo '<h2>' . $page_title . '</h2>';
						echo $page_content;
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>