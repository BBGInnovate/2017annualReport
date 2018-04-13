<?php
/**
 * @package WordPress
 * @subpackage Highend
 * Template name: Page Custom Home
 */
?>

<?php get_header(); ?>

<div class="video-wrapper coverImgBg">
	<video class="video-tag" autoplay loop poster="<?php echo content_url(); ?>/uploads/2018/03/Street-Pulse.jpg">
		<source src="<?php echo get_stylesheet_directory_uri(); ?>/videos/463476424.mp4" type="video/mp4">
		<!-- <source src="https: //cdn.theguardian.tv/interactive/mp4/wildfires/dunalley_intro_hi.mp4" type="video/mp4"> -->
	</video>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<!-- BEGIN #main-content -->
<div id="main-content">
	<div class="container">
		<img id="top-logo" src="<?php echo content_url(); ?>/uploads/2018/03/BBG-AR_Logo_Default.png">
		<div class="page-content">
			<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div id="wp-content" class="grid-contents">
					<h2><?php echo get_the_title(); ?></h2>
					<?php the_content();?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php endwhile; endif;?>
<?php get_footer(); ?>