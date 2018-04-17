<?php
/**
 * @package WordPress
 * @subpackage Highend
 * Template name: BG Scroll Test
 */
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<!-- BEGIN #main-content -->
<div id="main-content">
	<div class="container bg_scroll">
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