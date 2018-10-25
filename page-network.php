<?php
/**
 * @package WordPress
 * @subpackage Highend
 * Template name: Network Page
 */

require 'includes/shortcodes.php';
require 'includes/custom_field_data.php';
get_header();
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php
$main_content_style = "";
if ( vp_metabox('background_settings.hb_content_background_color') ){
	$main_content_style = ' style="background-color: ' . vp_metabox('background_settings.hb_content_background_color') . ';"';
	echo "<style type=\"text/css\">#pre-footer-area:after{border-top-color:" . vp_metabox('background_settings.hb_content_background_color') . "}</style>";
}
?>

<?php
if (has_post_thumbnail()) {
	echo '<div class="full-feature-image">';
	echo 	get_the_post_thumbnail();
	echo '</div>';
}
?>

<!-- BEGIN #main-content -->
<div id="main-content"<?php echo $main_content_style; ?>>
	<div class="container">
	
		<?php 
			$sidebar_layout = vp_metabox('layout_settings.hb_page_layout_sidebar'); 
			$sidebar_name = vp_metabox('layout_settings.hb_choose_sidebar');

			if ( $sidebar_layout == "default" || $sidebar_layout == "" ) 
			{
				$sidebar_layout = hb_options('hb_page_layout_sidebar');
				$sidebar_name = hb_options('hb_choose_sidebar');
			}

			if ( vp_metabox('misc_settings.hb_onepage') ){
				$sidebar_layout = 'fullwidth';
			}

			if ( class_exists('bbPress') ) {
			     if ( is_bbpress() ) {
					$sidebar_layout = 'fullwidth';
			     }
			}
		?>

		<div class="row">
			<div class="col-12">
				<h1><?php echo get_the_title(); ?></h1>
			</div>
		</div>

		<div class="row <?php echo $sidebar_layout; ?> main-row">
			<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!-- BEGIN .hb-main-content -->
				<?php
					if ( $sidebar_layout != 'fullwidth' ) {
						echo '<div class="col-9 hb-equal-col-height hb-main-content">';
					} else {
						echo '<div class="col-12 hb-main-content">';
					}
					the_content();
					wp_link_pages('before=<div id="hb-page-links">'.__('Pages:', 'hbthemes').'&after=</div>');
					if ( comments_open() && hb_options('hb_disable_page_comments') ) comments_template();
					echo '</div>' // ends 9 or 12 col;
				?>
				<!-- END .hb-main-content -->
				<!-- BEGIN .hb-sidebar -->
				<?php
					if ( $sidebar_layout != 'fullwidth' ) {
						echo '<div class="col-3  hb-equal-col-height hb-sidebar">';
						if ( $sidebar_name && function_exists('dynamic_sidebar') ) {
							dynamic_sidebar($sidebar_name);
						}
						echo '</div>';
					}
				?>
				<!-- END .hb-sidebar -->
			
			</div><!-- END #page-ID -->
		</div><!-- END .row -->
	</div><!-- END .container -->
	<?php
		$fw_ess_grid = full_width_essential_grid();
		if (!empty($fw_ess_grid)) {
			echo $fw_ess_grid;
		}
	?>
</div><!-- END #main-content -->

<?php endwhile; endif;?>
<?php get_footer(); ?>