<?php
/**
 * @package WordPress
 * @subpackage Highend
 Template Name: Custom AR Home X
 */
?>
<?php get_header(); ?>

<?php 
// if ( have_posts() ) : while ( have_posts() ) : the_post();
?> 
<!-- BEGIN #main-content -->
<div id="main-content"<?php echo $main_content_style; ?>>
	<?php putRevSlider("homepage-slider-1"); ?>
	<div id="newID" class="usa-grid">
<?php
if ( have_posts() ) {
	while ( have_posts() ) { 
		the_post();
		$pageContent = get_the_content();
		echo $pageContent;
	}
}
?>
	</div>
</div>

<?php //endwhile; endif;?>
<?php get_footer(); ?>